<?php namespace Monolith\Messaging\Events;

use Monolith\Messaging\Messages;
use Monolith\Collections\MutableCollection;
use Monolith\Collections\MutableDictionary;
use Psr\Container\ContainerInterface as Container;

final class ContainerAwareLazilyLoadedEventDispatcher implements LazilyLoadedEventDispatcher
{
    private MutableDictionary $eventListeners;
    private MutableDictionary $resolvedListeners;

    public function __construct(
        private Container $container
    ) {
        $this->eventListeners = MutableDictionary::empty();
        $this->resolvedListeners = MutableDictionary::empty();
    }

    public function subscribe(string $listenerClass): void
    {
        if ( ! is_subclass_of($listenerClass, Listener::class)) {
            throw CanNotSubscribeListener::mustImplementListenerInterface($listenerClass);
        }

        $listenerClass::subscribeTo()->each(
            function (string $event) use ($listenerClass) {
                $this->subscribeListenerToEvent($listenerClass, $event);
            }
        );
    }

    public function dispatch(Messages $messages): void
    {
        $messages->each(
            function (Event $event) {
                $eventClass = get_class($event);

                // no listeners = can stop now
                if ( ! $this->eventListeners->has($eventClass)) {
                    return;
                }

                $this->eventListeners
                    ->get($eventClass)
                    ->each(
                        function (string $listenerClass) use ($event) {
                            // first check for resolved listeners
                            if ( ! $this->resolvedListeners->has($listenerClass)) {
                                $this->resolvedListeners->add(
                                    $listenerClass,
                                    $this->container->get($listenerClass)
                                );
                            }

                            // resolve the listener and go
                            $this->resolvedListeners->get($listenerClass)->handle($event);
                        }
                    );
            }
        );
    }

    private function subscribeListenerToEvent(string $listenerClass, string $event)
    {
        if ($this->eventListeners->has($event)) {
            $this->eventListeners
                ->get($event)
                ->add($listenerClass);
            return;
        }

        $this->eventListeners->add($event, MutableCollection::list($listenerClass));
    }
}