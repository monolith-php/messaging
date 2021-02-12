<?php namespace Tests\Events\Stubs;

use Monolith\Messaging\Events\Event;
use Monolith\Collections\Collection;
use Monolith\Messaging\Events\Listener;

final class ThrowsWhenHandlingMultipleEventsListener implements Listener
{

    private int $timesCalled = 0;

    public function handle(Event $event): void
    {
        $this->timesCalled += 1;

        if ($this->timesCalled >= 2) {
            throw new ListenerReceivedEventThisManyTimes($this->timesCalled);
        }
    }

    public static function subscribeTo(): Collection
    {
        return Collection::list(NumberWasAdded::class);
    }
}