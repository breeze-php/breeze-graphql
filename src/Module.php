<?php

namespace Breeze\GraphQL;

use Exception;
use Zend\EventManager\EventManager;
use Zend\Mvc\MvcEvent;

/**
 * Class Module
 */
class Module
{
    /**
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__ . '../config/module.config.php';
    }

    /**
     * @param MvcEvent $event
     *
     * @return void
     */
    public function onBootstrap(MvcEvent $event)
    {
        /** @var EventManager $events */
        $events = $event->getTarget()->getEventManager();

        $events->attach(MvcEvent::EVENT_RENDER, [$this, 'onRenderError']);
    }

    /**
     * @param MvcEvent $event
     */
    public function onRenderError(MvcEvent $event)
    {
        $currentModel = $event->getResult();

        /** @var Exception $exception */
        $exception = $currentModel->getVariable('exception');

        sd($exception);
    }
}
