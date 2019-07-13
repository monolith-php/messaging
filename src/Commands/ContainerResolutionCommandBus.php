<?php namespace Monolith\Messaging\Commands;

use Monolith\Messaging\Bus;
use Monolith\Messaging\Message;
use Psr\Container\ContainerInterface as Container;
use ReflectionClass;

final class ContainerResolutionCommandBus implements Bus
{
    /** @var Container */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /** This cleans up with php 7.4 */
    public function dispatch(Message $message): void
    {
        $message->execute(...$this->instantiateParameters($message));
    }

    /**
     * instantiate the parameters for the command's execution method
     * using the constructor injected container.
     *
     * @param Command $command
     * @return array
     * @throws \ReflectionException
     */
    private function instantiateParameters(Command $command)
    {
        return array_map(function (\ReflectionParameter $param) {
            return $this->container->get($param->getType()->getName());
        }, (new ReflectionClass(get_class($command)))->getMethod('execute')->getParameters());
    }
}