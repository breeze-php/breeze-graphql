<?php

namespace Breeze\GraphQL\Controller\Factory;

use Breeze\GraphQL\Schema\Schema;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Breeze\GraphQL\Controller\Index as IndexController;

/**
 * Class Index
 */
class Index implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return IndexController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): IndexController
    {
        /** @var Schema $schema */
        $schema = $container->get(Schema::class);

        return new IndexController($schema);
    }
}
