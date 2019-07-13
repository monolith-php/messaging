<?php namespace spec\Monolith\Messaging\Commands;

use Monolith\Messaging\Commands\Command;

class TestCountingCommand implements Command {

    /** @var int */
    private $number;

    public function __construct(int $number) {
        $this->number = $number;
    }

    public function execute() {

    }
}