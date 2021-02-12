<?php namespace Monolith\Messaging\Events;

use Monolith\Messaging\Bus;
use Monolith\Messaging\Messages;

/**
 * An EventDispatcher is first loaded with listeners. Then
 * once the dispatch() method receives a collection of
 * \Monolith\Messaging\Events\Event, each event is handed
 * off to each listener.
 */
interface LazilyLoadedEventDispatcher extends Bus
{
    /**
     * add an event listener to the dispatcher
     *
     * @param string $listenerClass
     */
    public function subscribe(string $listenerClass): void;

    /**
     * dispatch domain events to listeners
     *
     * @param Messages $messages
     */
    public function dispatch(Messages $messages): void;
}