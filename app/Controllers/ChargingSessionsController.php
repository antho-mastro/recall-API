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

    public function processDeleteSessions(Request $request, Response $response)
    {
        $specs_data = $request->getParsedBody();
        if (empty($specs_data) || !is_array($specs_data)) {
            throw new HttpBadRequestException($request, 'Invalid data provided. Bad Request!');
        }

        foreach ($specs_data as $data) {
            if (!$this->charging_sessions_model->getSessionById($data)) {
                throw new HttpBadRequestException($request, "Station id provided does not exist. BAD REQUEST!");
            }
            $this->charging_sessions_model->deleteSession($data);
        }

        $responseData = [
            'status_code' => HttpCodes::STATUS_CREATED,
            'message'     => 'Data successfully deleted!',
        ];


        return $this->prepareOkResponse($response, $responseData, HttpCodes::STATUS_CREATED);
    }

    public function processCreateSession(Request $request, Response $response)
    {

        $emission_data = $request->getParsedBody();
        if (empty($emission_data) && !is_array($emission_data)) {
            throw new HttpBadRequestException($request, "Invalid/malformed data...BAD REQUEST!");
        }

        foreach ($emission_data as $emission) {
            $this->validateSessionsData($request, $emission);
            $this->charging_sessions_model->sessionsCreate($emission);
        }

        $response_data = array("code" => HttpCodes::STATUS_CREATED, "message" => "Country successfully created!");
        return $this->prepareOkResponse($response, $response_data, HttpCodes::STATUS_CREATED);
    }
}
