<?php

namespace Breeze\GraphQL\Schema;

use Youshido\GraphQL\Config\Schema\SchemaConfig;
use Youshido\GraphQL\Schema\AbstractSchema;

/**
 * Class Schema
 */
class Schema extends AbstractSchema
{
    /** @var array */
    private $queries;

    /** @var array */
    private $mutations;

    /**
     * Schema constructor.
     * @param array $queries
     * @param array $mutations
     */
    public function __construct(array $queries, array $mutations)
    {
        $this->queries   = $queries;
        $this->mutations = $mutations;

        parent::__construct();
    }

    /**
     * @param SchemaConfig $config
     * @return void
     */
    public function build(SchemaConfig $config)
    {
        $config->getQuery()->addFields($this->queries);
        $config->getMutation()->addFields($this->mutations);
    }
}
