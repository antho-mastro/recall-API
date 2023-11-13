<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface  as HttpCodes;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Controllers\BaseController;
use Vanier\Api\Models\CountriesModel;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Models\BaseModel;

class CountriesController extends BaseController{

private $countries_model = null;

    public function __construct()
    {
        $this->countries_model = new CountriesModel();
    }

    public function handleGetCountries(Request $request, Response $response, array $uri_args){

        $filters = $request->getQueryParams();
    
        $countries = $this->countries_model->getAllCountries($filters);
        
        return $this->prepareOkResponse($response, (array)$countries);
    }

    public function processCreateCountry(Request $request, Response $response)
    {

        $emission_data = $request->getParsedBody();
        if (empty($emission_data) && !is_array($emission_data)) {
            throw new HttpBadRequestException($request, "Invalid/malformed data...BAD REQUEST!");
        }

        foreach ($emission_data as $emission) {
            $this->validateCountriesData($request, $emission);
            $this->countries_model->countryCreate($emission);
        }

        $response_data = array("code" => HttpCodes::STATUS_CREATED, "message" => "Country successfully created!");
        return $this->prepareOkResponse($response, $response_data, HttpCodes::STATUS_CREATED);
    }

}
