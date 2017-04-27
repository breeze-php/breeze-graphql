<?php

namespace Breeze\GraphQL;

use Breeze\GraphQL\Controller\Factory\Index as IndexControllerFactory;
use Breeze\GraphQL\Controller\Index as IndexController;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'home'        => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
            IndexController::class => IndexControllerFactory::class
        ],
    ],

    'service_manager' => [
        'factories' => [
            Schema\Schema::class => Schema\Factory\Schema::class,
        ],
    ],
];
