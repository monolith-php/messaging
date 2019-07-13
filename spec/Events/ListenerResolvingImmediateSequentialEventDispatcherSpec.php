<?php namespace spec\Monolith\Messaging\Events;

use Monolith\DependencyInjection\Container;
use PhpSpec\ObjectBehavior;
use spec\Monolith\Messaging\Events\Stubs\ListenerStub;

class ListenerResolvingImmediateSequentialEventDispatcherSpec extends ObjectBehavior
{
    private $container;

    function let()
    {
        $this->container = new Container();
        $this->beConstructedWith($this->container);
    }

    function it_subscribes_listeners_by_class()
    {
        $this->subscribe(ListenerStub::class);
    }

    function it_throws_if_invalid_listeners_are_subscribed()
    {
    }

    function it_dispatches_events_to_a_single_listener()
    {
    }

    function it_dispatches_events_to_multiple_listener()
    {
    }
}