<?php namespace Tests\Commands\Stubs;

use Psr\Container\ContainerInterface as Container;

class ContainerStub implements Container
{
    private array $objects = [];

    public function bind($id, $object)
    {
        $this->objects[$id] = $object;
    }

    public function get($id)
    {
        if ( ! isset($this->objects[$id])) {
            throw new \Exception('No resolution target set for ' . $id);
        }
        
        // if the fqcn is bound then return a new instance
        // maybe kinda hacky, if requirements increase then we'll
        // deal with it then
        if (is_string($this->objects[$id])) {
            return new $this->objects[$id];
        }
        
        return $this->objects[$id];
    }

    public function has($id): bool
    {
        return isset($this->objects[$id]);
    }
}