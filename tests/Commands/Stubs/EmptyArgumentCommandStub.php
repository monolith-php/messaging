<?php namespace Tests\Commands\Stubs;

use Monolith\Messaging\Commands\Command;

class EmptyArgumentCommandStub implements Command
{
    private $a;
    private $b;
    private bool $wasExecuted = false;

    public function __construct($a, $b)
    {
        $this->a = $a;
        $this->b = $b;
    }

    public function hasBeenExecuted(): bool
    {
        return $this->wasExecuted;
    }

    public function execute()
    {
        $this->wasExecuted = true;
    }
}