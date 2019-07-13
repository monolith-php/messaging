<?php namespace spec\Monolith\Messaging\Events\Stubs;

use Monolith\Collections\Collection;
use Monolith\Messaging\Events\Event;
use Monolith\Messaging\Events\Listener;

final class ListenerStub implements Listener
{
    /**
     * subscribeTo() returns a collection of event class names
     * when an event of one of the types in the array is
     * dispatched, this listener will be instantiated and
     * will receive the event via the handle() method.
     */
    public static function subscribeTo(): Collection
    {
        return Collection::list(
            NumberWasAdded::class
        );
    }

    /**
     * handle() is called when an event is received from the
     * dispatcher
     *
     * @param Event $event
     */
    public function handle(Event $event): void
    {

    }
}