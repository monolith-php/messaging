<?php namespace Monolith\Messaging;

interface Bus
{
    public function dispatch(Message $message): void;
}