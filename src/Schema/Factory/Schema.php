<?php

namespace Breeze\GraphQL\Schema\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Breeze\GraphQL\Schema\Schema as GraphQLSchema;

/**
 * Class Schema
 */
class Schema implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return GraphQLSchema
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): GraphQLSchema
    {
        $config = $container->get('config')['schema'];

        $queries   = $this->buildQueries($container, $config);
        $mutations = $this->buildMutations($container, $config);

        return new GraphQLSchema($queries, $mutations);
    }

    /**
     * @param ContainerInterface $container
     * @param array $config
     * @return array
     */
    private function buildQueries(ContainerInterface $container, array $config): array
    {
        $queries = [];

        foreach ($config['queries'] as $key => $value) {
            if (is_array($value)) {
                if (array_key_exists('options', $value) && array_key_exists('context', $value['options'])) {
                    $queries[] = $container->get($value['options']);
                }
            } else {

            }
        }

        return $queries;
    }

    /**
     * @param ContainerInterface $container
     * @param array $config
     * @return array
     */
    private function buildMutations(ContainerInterface $container, array $config): array
    {
        $mutations = [];

        foreach ($config['mutations'] as $key => $mutation) {
            $mutations[$name] = $container->get($mutation);
        }

        return $mutations;
    }
}
