<?php namespace Tests\Events;

use PHPUnit\Framework\TestCase;
use Monolith\Messaging\Messages;
use Tests\Events\Stubs\ListenerStub;
use Tests\Events\Stubs\NumberWasAdded;
use Tests\Commands\Stubs\ContainerStub;
use Tests\Events\Stubs\ListenerReceivedEvent;
use Monolith\Messaging\Events\CanNotSubscribeListener;
use Tests\Events\Stubs\ListenerReceivedEventThisManyTimes;
use Tests\Events\Stubs\ThrowsWhenHandlingMultipleEventsListener;
use Monolith\Messaging\Events\ContainerAwareLazilyLoadedEventDispatcher;

class ContainerAwareLazilyLoadedEventDispatcherTest extends TestCase
{
    function testCanNotSubscribeNonListeners()
    {
        // NumberWasAdded is not a valid listener, it's an event
        $this->expectException(
            CanNotSubscribeListener::class
        );

        $container = new ContainerStub();

        $dispatcher = new ContainerAwareLazilyLoadedEventDispatcher($container);

        // NumberWasAdded is not a valid listener, it's an event
        $dispatcher->subscribe(NumberWasAdded::class);
    }

    function testDistributesDispatchedEventToAllSubscribers()
    {
        $container = new ContainerStub();
        $container->bind(ListenerStub::class, new ListenerStub());

        $dispatcher = new ContainerAwareLazilyLoadedEventDispatcher($container);

        $dispatcher->subscribe(ListenerStub::class);

        $this->expectException(ListenerReceivedEvent::class);
        $this->expectExceptionMessage(3);

        $dispatcher->dispatch(Messages::list(new NumberWasAdded(3)));
    }

    function testResolvedEventListenersAreCached()
    {
        $container = new ContainerStub();
        $container->bind(ThrowsWhenHandlingMultipleEventsListener::class, ThrowsWhenHandlingMultipleEventsListener::class);

        $dispatcher = new ContainerAwareLazilyLoadedEventDispatcher($container);

        $dispatcher->subscribe(ThrowsWhenHandlingMultipleEventsListener::class);

        $dispatcher->dispatch(Messages::list(new NumberWasAdded(3)));

        $this->expectException(ListenerReceivedEventThisManyTimes::class);
        $this->expectExceptionMessage(2);

        $dispatcher->dispatch(Messages::list(new NumberWasAdded(3)));
    }
}
