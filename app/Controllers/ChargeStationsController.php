<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface  as HttpCodes;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Controllers\BaseController;
use Vanier\Api\Models\ChargeStationsModel;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Models\BaseModel;

class ChargeStationsController extends BaseController{

private $charge_stations_model = null;

    public function __construct()
    {
        $this->charge_stations_model = new ChargeStationsModel();
    }

    public function handleGetChargeStations(Request $request, Response $response, array $uri_args){

        $filters = $request->getQueryParams();
        
        $station = $this->charge_stations_model->getAllStations($filters);

        return $this->prepareOkResponse($response, (array)$station);
    }

    public function processCreateStation(Request $request, Response $response)
    {

        $emission_data = $request->getParsedBody();
        if (empty($emission_data) && !is_array($emission_data)) {
            throw new HttpBadRequestException($request, "Invalid/malformed data...BAD REQUEST!");
        }

        foreach ($emission_data as $emission) {
            $this->validateStationsData($request, $emission);
            $this->charge_stations_model->stationsCreate($emission);
        }

        $response_data = array("code" => HttpCodes::STATUS_CREATED, "message" => "Country successfully created!");
        return $this->prepareOkResponse($response, $response_data, HttpCodes::STATUS_CREATED);
    }

}
