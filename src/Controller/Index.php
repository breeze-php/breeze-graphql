<?php

namespace Breeze\GraphQL\Controller;

use Breeze\GraphQL\Schema\Schema;
use Youshido\GraphQL\Execution\Processor;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class Index
 */
class Index extends AbstractActionController
{
    /** @var Schema */
    private $schema;

    /**
     * Index constructor.
     * @param Schema $schema
     */
    public function __construct(Schema $schema)
    {
        $this->schema = $schema;
    }

    /**
     * @return void
     */
    public function indexAction()
    {
        header('Access-Control-Allow-Credentials: false', true);
        header('Access-Control-Allow-Origin: *');

        //if ($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
        //    return;
        //}

        if (isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
            $rawBody     = file_get_contents('php://input');
            $requestData = json_decode($rawBody ?: '', true);
        } else {
            $requestData = $_POST;
        }

        $payload   = isset($requestData['query']) ? $requestData['query'] : null;
        $variables = isset($requestData['variables']) ? $requestData['variables'] : null;

        $processor = new Processor($this->schema);

        $response = $processor->processPayload($payload, $variables)->getResponseData();

        header('Content-Type: application/json');

        echo json_encode($response);

        exit;
    }
}
