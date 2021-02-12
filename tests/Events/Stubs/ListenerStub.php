<?php namespace Tests\Events\Stubs;

use Monolith\Collections\Collection;
use Monolith\Messaging\Events\Event;
use Monolith\Messaging\Events\Listener;

final class ListenerStub implements Listener
{
    public static function subscribeTo(): Collection
    {
        return Collection::list(
            NumberWasAdded::class
        );
    }
    
    public function handle(Event $event): void
    {
        throw new ListenerReceivedEvent($event->number);
    }
}