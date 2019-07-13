<?php namespace spec\Monolith\Messaging\Commands\Stubs;

use Monolith\Messaging\Commands\Command;

class EmptyArgumentCommandStub implements Command {

    private $a;
    private $b;

    public function __construct($a, $b) {
        $this->a = $a;
        $this->b = $b;
    }

    public function execute() {

    }
}