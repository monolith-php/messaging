<?php namespace spec\Monolith\Messaging\Commands\Stubs;

class ResolutionTargetStub {

    private $number;

    public function __construct($number) {
        $this->number = $number;
    }

    public function number() {
        return $this->number;
    }
}