<?php namespace spec\Monolith\Messaging\Events;

use Monolith\Messaging\Events\Event;

final class NumberWasAdded implements Event
{
    private $number;

    public function __construct($number)
    {
        $this->number = $number;
    }
}