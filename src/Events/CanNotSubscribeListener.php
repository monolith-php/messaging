<?php namespace Monolith\Messaging\Events;

use Monolith\Messaging\MessagingException;

final class CanNotSubscribeListener extends MessagingException
{
    public static function mustImplementListenerInterface(string $listenerClass)
    {
        return new static("Listener class {$listenerClass} must implement the Listener interface to be subscribed to the event dispatecher.");
    }
}