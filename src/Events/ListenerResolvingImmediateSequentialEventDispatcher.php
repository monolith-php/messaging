<?php namespace Monolith\Messaging\Events;

use Monolith\Collections\Collection;
use Monolith\Collections\MutableCollection;
use Monolith\Collections\MutableDict;
use Monolith\DependencyInjection\Container;
use function spec\Monolith\Messaging\dd;

final class ListenerResolvingImmediateSequentialEventDispatcher implements EventDispatcher
{
    /** @var Container */
    private $container;
    /** @var MutableDict */
    private $eventListeners;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->eventListeners = new MutableDict();
    }

    /**
     * add an event listener to the dispatcher
     * @param string $listenerClass
     */
    public function subscribe(string $listenerClass): void
    {
        if ( ! is_subclass_of($listenerClass, Listener::class)) {
            throw CanNotSubscribeListener::mustImplementListenerInterface($listenerClass);
        }

        /** @var Collection $bob */
        $events = $listenerClass::subscribeTo();
        $events->each(function (string $event) use ($listenerClass) {
            $this->subscribeListenerToEvent($listenerClass, $event);
        });
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

    /**
     * dispatch domain events to listeners
     *
     * @param Events $events
     */
    public function dispatch(Events $events): void
    {
        $events->each(function (Event $event) {
            $eventClass = get_class($event);

            if ( ! $this->eventListeners->has($eventClass)) {
                return;
            }

            $this->eventListeners
                ->get($eventClass)
                ->each(function(string $listenerClass) use ($event) {
                    $listener = $this->container->get($listenerClass);
                    $listener->handle($event);
                });
        });
    }
}