<?php namespace Tests\Commands\Stubs;

use Monolith\Messaging\Commands\Command;

class ArgumentCommandStub implements Command
{
    private ResolutionTargetStub $resolved;

    public function execute(ResolutionTargetStub $dependency)
    {
        $this->resolved = $dependency;
    }

    public function getResolved(): ResolutionTargetStub
    {
        return $this->resolved;
    }
}