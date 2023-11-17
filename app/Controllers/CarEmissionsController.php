<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface  as HttpCodes;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Controllers\BaseController;
use Vanier\Api\Models\CarEmissionsModel;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class CarEmissionsController extends BaseController
{
    private $emissions_model = null;


    public function __construct()
    {
        $this->emissions_model = new CarEmissionsModel();
    }

    public function processAllEmissions(Request $request, Response $response)
    {
        $filters = $request->getQueryParams();
        if ($this->isValidPagingParams($filters)) {
            $this->emissions_model->setPaginationOptions($filters["page"], $filters["page_size"]);
        }
        /*$filterOptions = array();
        if (isset($filters['rating'])) {
            $filterOptions['rating'] = $filters['rating'];
        }*/
        $emissions = $this->emissions_model->getAllEmissions($filters);
        return $this->prepareOkResponse($response, $emissions);
    }


    public function processCreateEmission(Request $request, Response $response)
    {

        $emission_data = $request->getParsedBody();
        if (empty($emission_data) || !is_array($emission_data)) {
            throw new HttpBadRequestException($request, "Invalid/malformed data...BAD REQUEST!");
        }

        foreach ($emission_data as $emission) {
            $this->validateCarEmissionsData($request, $emission);
            $this->emissions_model->EmissionsCreate($emission);
        }

        $response_data = array("code" => HttpCodes::STATUS_CREATED, "message" => "emissions successfully created!");
        return $this->prepareOkResponse($response, $response_data, HttpCodes::STATUS_CREATED);
    }

    public function processGetEmissionById(Request $request, Response $response, array $url_args)
    {
        $emission_id = $url_args['CarEmissionID'];
        if (!ctype_digit($emission_id)) {
            throw new HttpNotFoundException($request, "Invalid emission ID");
        }
        $data = $this->emissions_model->getEmissionById((int)$emission_id);
        return $this->prepareOkResponse($response, $data);
    }

    public function processEmissionUpdate(Request $request, Response $response)
    {
        $emissionData = $request->getParsedBody();

        if (empty($emissionData) || !is_array($emissionData)) {
            throw new HttpBadRequestException($request, 'Invalid data provided. Bad Request!');
        }

        foreach ($emissionData as $emissionDetails) {
            $this->validateCarEmissionsData($request, $emissionDetails);

            $emissionId = $emissionDetails['CarEmissionID'];
            unset($emissionDetails['CarEmissionID']);

            $this->emissions_model->EmissionUpdate($emissionDetails, ["CarEmissionID" => $emissionId]);
        }

        $responseData = [
            'status_code' => HttpCodes::STATUS_CREATED,
            'message'     => 'Data successfully updated!',
        ];

        return $this->prepareOkResponse($response, $responseData, HttpCodes::STATUS_CREATED);
    }

    public function processDeleteEmission(Request $request, Response $response)
    {
        $emissions_data = $request->getParsedBody();
        if (empty($emissions_data) || !is_array($emissions_data)) {
            throw new HttpBadRequestException($request, 'Invalid data provided. Bad Request!');
        }

        foreach ($emissions_data as $data) {
            if (!$this->emissions_model->getEmissionById($data)) {
                throw new HttpBadRequestException($request, "Emission id provided does not exist. BAD REQUEST!");
            }
            $this->emissions_model->deleteEmission($data);
        }

        $responseData = [
            'status_code' => HttpCodes::STATUS_CREATED,
            'message'     => 'Data successfully deleted!',
        ];


        return $this->prepareOkResponse($response, $responseData, HttpCodes::STATUS_CREATED);
    }

    public function processGetEmissionsById(Request $request, Response $response, array $uri_args)
    {
        $customer_id = $uri_args["CarEmissionID"];


        if (empty($customer_id) || is_null($customer_id)) {
            throw new HttpBadRequestException($request, "Invalid/malformed data...BAD REQUEST!");
        }


        if (!$this->emissions_model->getEmissionById($customer_id)) {
            throw new HttpBadRequestException($request, "Emission id provided does not exist. BAD REQUEST!");
        }

        $data = $this->emissions_model->getEmissionById($customer_id);


        return $this->prepareOkResponse($response, $data);
    }
}
