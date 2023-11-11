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

    public function processDeleteStations(Request $request, Response $response)
    {
        $specs_data = $request->getParsedBody();
        if (empty($specs_data) || !is_array($specs_data)) {
            throw new HttpBadRequestException($request, 'Invalid data provided. Bad Request!');
        }

        foreach ($specs_data as $data) {
            if (!$this->charge_stations_model->getStationById($data)) {
                throw new HttpBadRequestException($request, "Station id provided does not exist. BAD REQUEST!");
            }
            $this->charge_stations_model->deleteStation($data);
        }

        $responseData = [
            'status_code' => HttpCodes::STATUS_CREATED,
            'message'     => 'Data successfully deleted!',
        ];


        return $this->prepareOkResponse($response, $responseData, HttpCodes::STATUS_CREATED);
    }


}
