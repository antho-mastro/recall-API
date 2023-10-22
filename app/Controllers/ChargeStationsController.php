<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface  as HttpCodes;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Controllers\BaseController;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Models\ChargeStationsModel;

class ChargingSationsController extends BaseController{

private $charging_stations_model = null;

    public function __construct()
    {
        $this->charging_stations_model = new ChargeStationsModel();
    }

    public function handleGetChargingStations(Request $request, Response $response, array $uri_args){

        $filters = $request->getQueryParams();
    
    
        $station = $this->charging_stations_model->getAllStations($filters);

    
        return $this->prepareOkResponse($response, (array)$station);
    }


}
