<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface  as HttpCodes;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Controllers\BaseController;
use Vanier\Api\Models\ElectricVehiclesModel;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Models\BaseModel;

class CountriesController extends BaseController{

private $electric_vehicle_model = null;

    public function __construct()
    {
        $this->electric_vehicle_model = new ElectricVehiclesModel();
    }

    public function handleGetEvs(Request $request, Response $response, array $uri_args){

        $filters = $request->getQueryParams();
    
    
    
        $evs = $this->electric_vehicle_model->getAllEvs($filters);
    
        //$shows = $this->getTVMazeShows();
    
        
        
    
        return $this->prepareOkResponse($response, (array)$evs);
    }

}