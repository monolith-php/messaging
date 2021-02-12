<?php namespace Monolith\Messaging\Commands;

use ReflectionClass;
use Psr\Container\ContainerInterface as Container;

final class ContainerResolutionCommandBus implements CommandBus
{
    public function __construct(
        private Container $container
    ) {
    }

    public function execute(Command $command): void
    {
        $command->execute(
            ...$this->instantiateParameters($command)
        );
    }

    /**
     * instantiate the parameters for the command's execution method
     * using the constructor injected container.
     *
     * @param Command $command
     * @return array
     * @throws \ReflectionException
     */
    private function instantiateParameters(Command $command): array
    {
        return array_map(
            function (\ReflectionParameter $param) {
                return $this->container->get($param->getType()->getName());
            },
            (new ReflectionClass(get_class($command)))->getMethod('execute')->getParameters()
        );
    }
}