<?php namespace Tests\Events\Stubs;

use Monolith\Messaging\Events\Event;

final class NumberWasAdded implements Event
{
    public function __construct(
        public int $number
    ) {
    }
}