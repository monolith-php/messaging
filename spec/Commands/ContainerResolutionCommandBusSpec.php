<?php namespace spec\Monolith\Messaging\Commands;

use PhpSpec\ObjectBehavior;
use function spec\Monolith\Messaging\expect;

class ContainerResolutionCommandBusSpec extends ObjectBehavior {

    private $container;

    function let() {
        $this->container = new ContainerStub();
        $this->beConstructedWith($this->container);
    }

    function it_dispatches_with_no_arguments() {
        $this->container->set(ResolutionTargetStub::class, new ResolutionTargetStub(666));
        $this->dispatch(new EmptyArgumentCommandStub('abc', 123))->shouldReturn(null);
    }

    function it_dispatches_with_argument_resolution() {
        $this->container->set(ResolutionTargetStub::class, new ResolutionTargetStub(666));
        $command = new ArgumentCommandStub('abc', 123);
        $this->dispatch($command)->shouldReturn(null);

        expect($command->getResolved())
            ->shouldHaveType(ResolutionTargetStub::class);
    }
}
