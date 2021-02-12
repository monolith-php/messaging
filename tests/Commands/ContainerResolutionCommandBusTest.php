<?php namespace Tests\Commands;

use Tests\Commands\Stubs\ContainerStub;
use PHPUnit\Framework\TestCase;
use Tests\Commands\Stubs\ArgumentCommandStub;
use Tests\Commands\Stubs\ResolutionTargetStub;
use Tests\Commands\Stubs\EmptyArgumentCommandStub;
use Monolith\Messaging\Commands\ContainerResolutionCommandBus;

class ContainerResolutionCommandBusTest extends TestCase
{
    function testCommandsAreMatchedToHandlers()
    {
        $container = new ContainerStub();
        $bus = new ContainerResolutionCommandBus($container);

        $command = new EmptyArgumentCommandStub(1, 2);

        $bus->execute($command);

        self::assertTrue($command->hasBeenExecuted());
    }

    function testExecutionArgumentsAreResolvedThroughTheContainer()
    {
        $container = new ContainerStub();
        $container->bind(ResolutionTargetStub::class, new ResolutionTargetStub(2));

        $bus = new ContainerResolutionCommandBus($container);

        $command = new ArgumentCommandStub();

        $bus->execute($command);

        self::assertSame(2, $command->getResolved()->number());
    }
}
