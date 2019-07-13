<?php namespace Monolith\Messaging\Events;

use Monolith\Collections\Collection;

/**
 * A listener is an object that is notified when domain events
 * are raised and persisted. Listener implementations include
 * any type of object that responds to events in any way,
 * including process managers and projections.
 *
 * Interface Listener
 * @package Monolith\EventDispatcher
 */
interface Listener
{
    /**
     * subscribeTo() returns a Collection of event class names
     * when an event of one of the types in the array is
     * dispatched, this listener will be instantiated and
     * will receive the event via the handle() method.
     */
    public static function subscribeTo(): Collection;

    /**
     * handle() is called when an event is received from the
     * dispatcher
     *
     * @param Event $event
     */
    public function handle(Event $event): void;
}