<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface  as HttpCodes;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Controllers\BaseController;
use Vanier\Api\Models\CarSpecsModel;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class CarSpecsController extends BaseController
{
    private $specs_model = null;


    public function __construct()
    {
        $this->specs_model = new CarSpecsModel();
    }

    public function processAllSpecs(Request $request, Response $response)
    {
        $filters = $request->getQueryParams();
        if ($this->isValidPagingParams($filters)) {
            $this->specs_model->setPaginationOptions($filters["page"], $filters["page_size"]);
        }
        /*$filterOptions = array();
        if (isset($filters['rating'])) {
            $filterOptions['rating'] = $filters['rating'];
        }*/
        $specs = $this->specs_model->getAllSpecs($filters);
        return $this->prepareOkResponse($response, $specs);
    }


    public function processCreateSpec(Request $request, Response $response)
    {

        $specs_data = $request->getParsedBody();
        if (empty($specs_data) || !is_array($specs_data)) {
            throw new HttpBadRequestException($request, "Invalid/malformed data...BAD REQUEST!");
        }

        foreach ($specs_data as $spec) {
            $this->validateSpecsData($request, $spec);
            $this->specs_model->specsCreate($spec);
        }

        $response_data = array("code" => HttpCodes::STATUS_CREATED, "message" => "Spec has been successfully created!");
        return $this->prepareOkResponse($response, $response_data, HttpCodes::STATUS_CREATED);
    }

    public function processGetSpecById(Request $request, Response $response, array $url_args)
    {
        $spec_id = $url_args['SpecsID'];
        if (!ctype_digit($spec_id)) {
            throw new HttpNotFoundException($request, "Invalid spec ID");
        }
        $data = $this->specs_model->getSpecById((int)$spec_id);
        return $this->prepareOkResponse($response, $data);
    }


    public function processSpecUpdate(Request $request, Response $response)
    {
        $specData = $request->getParsedBody();

        if (empty($specData) || !is_array($specData)) {
            throw new HttpBadRequestException($request, 'Invalid data provided. Bad Request!');
        }

        foreach ($specData as $specDetails) {
            $this->validateSpecsData($request, $specDetails);

            $specId = $specDetails['SpecsID'];
            unset($filmDetails['SpecsID']);

            $this->specs_model->SpecsUpdate($specDetails, ["SpecsID" => $specId]);
        }

        $responseData = [
            'status_code' => HttpCodes::STATUS_CREATED,
            'message'     => 'Data successfully updated!',
        ];

        return $this->prepareOkResponse($response, $responseData, HttpCodes::STATUS_CREATED);
    }

    public function processDeleteSpec(Request $request, Response $response)
    {
        $specs_data = $request->getParsedBody();
        if (empty($specs_data) || !is_array($specs_data)) {
            throw new HttpBadRequestException($request, 'Invalid data provided. Bad Request!');
        }

        foreach ($specs_data as $data) {
            if (!$this->specs_model->getSpecById($data)) {
                throw new HttpBadRequestException($request, "Spec id provided does not exist. BAD REQUEST!");
            }
            $this->specs_model->deleteSpecs($data);
        }

        $responseData = [
            'status_code' => HttpCodes::STATUS_CREATED,
            'message'     => 'Data successfully deleted!',
        ];


        return $this->prepareOkResponse($response, $responseData, HttpCodes::STATUS_CREATED);
    }

    public function processGetSpecsById(Request $request, Response $response, array $uri_args)
    {
        $customer_id = $uri_args["SpecsID"];


        if (empty($customer_id) || is_null($customer_id)) {
            throw new HttpBadRequestException($request, "Invalid/malformed data...BAD REQUEST!");
        }


        if (!$this->specs_model->getSpecById($customer_id)) {
            throw new HttpBadRequestException($request, "Spec id provided does not exist. BAD REQUEST!");
        }

        $data = $this->specs_model->getSpecById($customer_id);


        return $this->prepareOkResponse($response, $data);
    }
}
