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

class ElectricVehiclesController extends BaseController{

private $electric_vehicle_model = null;

    public function __construct()
    {
        $this->electric_vehicle_model = new ElectricVehiclesModel();
    }

    public function handleGetEvs(Request $request, Response $response, array $uri_args){

        $filters = $request->getQueryParams();
    
        $evs = $this->electric_vehicle_model->getAllEvs($filters);
    
        return $this->prepareOkResponse($response, (array)$evs);
    }

    public function processCreateEvs(Request $request, Response $response)
    {

        $emission_data = $request->getParsedBody();
        if (empty($emission_data) && !is_array($emission_data)) {
            throw new HttpBadRequestException($request, "Invalid/malformed data...BAD REQUEST!");
        }

        foreach ($emission_data as $emission) {
            $this->validateEvsData($request, $emission);
            $this->electric_vehicle_model->VehicleCreate($emission);
        }

        $response_data = array("code" => HttpCodes::STATUS_CREATED, "message" => "Vehicle successfully created!");
        return $this->prepareOkResponse($response, $response_data, HttpCodes::STATUS_CREATED);
    }

}