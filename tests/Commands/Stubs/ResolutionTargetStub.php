<?php namespace Tests\Commands\Stubs;

class ResolutionTargetStub
{
    private int $number;

    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public function number(): int
    {
        return $this->number;
    }
}