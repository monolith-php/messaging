<?php namespace Monolith\Messaging;

use Monolith\Collections\TypedCollection;

final class Messages extends TypedCollection
{
    protected string $collectionType = Message::class;
}