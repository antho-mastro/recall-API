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

    public function processDeleteRecall(Request $request, Response $response)
    {
        $emissions_data = $request->getParsedBody();
        if (empty($emissions_data) || !is_array($emissions_data)) {
            throw new HttpBadRequestException($request, 'Invalid data provided. Bad Request!');
        }

        foreach ($emissions_data as $data) {
            if (!$this->recall_model->getRecallById($data)) {
                throw new HttpBadRequestException($request, "Emission id provided does not exist. BAD REQUEST!");
            }
            $this->recall_model->deleteRecall($data);
        }

        $responseData = [
            'status_code' => HttpCodes::STATUS_CREATED,
            'message'     => 'Data successfully deleted!',
        ];


        return $this->prepareOkResponse($response, $responseData, HttpCodes::STATUS_CREATED);
    }

}