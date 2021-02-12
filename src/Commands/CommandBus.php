<?php namespace Monolith\Messaging\Commands;

interface CommandBus
{
    public function execute(Command $command): void;
}