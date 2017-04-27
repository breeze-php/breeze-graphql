<?php

namespace Breeze\GraphQL\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class DoctrineMutation
 */
class DoctrineMutation implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return mixed
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $context = $container->get($options['context']);

        return new $requestedName($context);
    }
}
