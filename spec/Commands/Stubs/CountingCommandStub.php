<?php namespace spec\Monolith\Messaging\Commands\Stubs;

use Monolith\Messaging\Commands\Command;

class CountingCommandStub implements Command {

    /** @var int */
    private $number;

    public function __construct(int $number) {
        $this->number = $number;
    }

    public function execute() {

    }
}