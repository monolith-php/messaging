<?php namespace Monolith\Messaging;

/**
 * A bus is a pathway through which messages travel.
 * They can be composed into a pipeline.
 * 
 * Interface Bus
 * @package Monolith\Messaging
 */
interface Bus
{
    public function dispatch(Messages $messages): void;
}