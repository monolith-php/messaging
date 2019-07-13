<?php namespace spec\Monolith\Messaging\Commands;

use Monolith\Messaging\Commands\Command;

class ArgumentCommandStub implements Command {

    public function execute(ResolutionTargetStub $dependency) {
        $this->resolved = $dependency;
    }

    public function getResolved() {
        return $this->resolved;
    }
}