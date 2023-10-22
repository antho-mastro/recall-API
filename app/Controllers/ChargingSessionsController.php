<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface  as HttpCodes;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Controllers\BaseController;



use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Models\ChargingSessionsModel;

class ChargingSessionsController extends BaseController{

private $charging_sessions_model = null;

    public function __construct()
    {
        $this->charging_sessions_model = new ChargingSessionsModel();
    }

    public function handleGetChargingSessions(Request $request, Response $response, array $uri_args){

        $filters = $request->getQueryParams();

    
        $session = $this->charging_sessions_model->getAllSessions($filters);
    
    
        return $this->prepareOkResponse($response, (array)$session);
    }
}
