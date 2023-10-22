<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface  as HttpCodes;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Controllers\BaseController;
use Vanier\Api\Models\RecallCarsModel;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Models\BaseModel;

class RecallCarsController extends BaseController{

private $recall_model = null;

    public function __construct()
    {
        $this->recall_model = new RecallCarsModel();
    }

    public function handleGetRecallCars(Request $request, Response $response, array $uri_args){

        $filters = $request->getQueryParams();
    
    
        $recallCars = $this->recall_model->getAllRecalls($filters);
    
    
        return $this->prepareOkResponse($response, (array)$recallCars);
    }

}