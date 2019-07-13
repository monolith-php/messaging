<?php namespace Monolith\Messaging\Events;

/**
 * An EventDispatcher is first loaded with listeners. Then
 * once the dispatch() method receives a collection of
 * \Monolith\Messaging\Events\Event, each event is handed
 * off to each listener.
 */
interface EventDispatcher
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
     * @param Events $events
     */
    public function dispatch(Events $events): void;
}