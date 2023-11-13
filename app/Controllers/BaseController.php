<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Helpers\Validator;

class BaseController
{


    protected   function isValidPagingParams($data)
    {
        $rules = array(
            'page' => [
                'required',
                'numeric',
                ['min', 1]
            ],
            'page_size' => [
                'required',
                'integer',
                ['min', 5],
                ['max', 50]
            ]
        );

        $validator = new Validator($data);

        $validator->mapFieldsRules($rules);
        return $validator->validate();
    }

    protected function prepareOkResponse(Response $response, array $data, int $status_code = 200)
    {
        $json_data = json_encode($data);
        $response->getBody()->write($json_data);
        return $response->withStatus($status_code)->withAddedHeader(HEADERS_CONTENT_TYPE, APP_MEDIA_TYPE_JSON);
    }


    public function validateCarEmissionsData($request, array $emission)
    {
        $validation = new Input();
        foreach ($emission as $key => $value) {
            switch ($key) {
                case "CO2Emission":
                case "NOxEmission":
                case "ParticularEmission":
                    if (!$validation->isOnlyAlpha($value) && empty($value)) {
                        throw new HttpBadRequestException($request, "Emissions data invalid!");
                    }
                    break;
                default:
                    break;
            }
        }
    }

    public function validateSpecsData($request, array $specs)
    {
        /*$validation = new Input();

        foreach ($specs as $key => $value) {
            switch ($key) {
                case "store_id":
                case "address_id":
                    if ($validation->isAlpha($value)) {
                        throw new HttpBadRequestException($request, "store_id, address_id  data is malformed...BAD REQUEST!");
                    }
                    break;
                case "active":
                    if (!$validation->isIntInRange($value, 0, 1)) {
                        throw new HttpBadRequestException($request, "active is not correct...BAD REQUEST!");
                    }
                    break;
                case "language_id":
                case "rental_duration":
                case "length":
                    if ($validation->isAlpha($value)) {
                        throw new HttpBadRequestException($request, "language_id, rental_duration or length is malformed...BAD REQUEST!");
                    }
                    break;
                case "first_name":
                case "last_name":

                    if (!$validation->isAlpha($value)) {
                        throw new HttpBadRequestException($request, "first_name, last_name, or email data is malformed...BAD REQUEST!");
                    }
                    break;
                default:
                    break;
            }
        }*/
    }

    public function validateStationsData(Request $request, array $emission)
    {
        $validation = new Input();
        foreach ($emission as $key => $value) {
            switch ($key) {
                case "Name":
                case "Location":
                case "OperatorName":
                    if (!$validation->isOnlyAlpha($value) && empty($value)) {
                        throw new HttpBadRequestException($request, "Name, location and operator invalid!");
                    }
                    break;
                    case "NumberOfPorts":
                    if (!$validation->isOnlyAlpha($value) && empty($value)) {
                        throw new HttpBadRequestException($request, "Number of ports invalid!");
                    }
                default:
                    break;
            }
        }
    }

    public function validateCountriesData($request, array $emission)
    {
        $validation = new Input();
        foreach ($emission as $key => $value) {
            switch ($key) {
                case "CountryID":
                    if (!$validation->isAlpha($value)) {
                        throw new HttpBadRequestException($request, "CountryID is not to be declared! BAD REQUEST!");
                    }
                    break;
                case "City":
                case "PostalCode":
                    if (!$validation->isOnlyAlpha($value) && empty($value)) {
                        throw new HttpBadRequestException($request, "City and postal codes invalid!");
                    }
                    break;
                default:
                    break;
            }
        }
    }

    public function validateEvsData($request, array $emission)
    {
        $validation = new Input();
        foreach ($emission as $key => $value) {
            switch ($key) {
                case "VIN":
                case "Maker":
                case "Model":
                    if (!$validation->isAlpha($value) && empty($value)) {
                        throw new HttpBadRequestException($request, "VIN, Maker and Model invalid!");
                    }
                    break;
                case "Year":
                case "Price":
                    if (!$validation->isAlpha($value) && empty($value)) {
                        throw new HttpBadRequestException($request, "Year and price invalid!");
                    }
                default:
                    break;
            }
        }
    }

    public function validateSessionsData($request, array $emission)
    {
        $validation = new Input();
        foreach ($emission as $key => $value) {
            switch ($key) {
                case "ChargingSessionID":
                    if (!$validation->isAlpha($value)) {
                        throw new HttpBadRequestException($request, "Session ID is not to be declared! BAD REQUEST!");
                    }
                    break;
                case "ChargingStartTime":
                case "ChargingEndTime":
                    if (!$validation->isAlpha($value) && empty($value)) {
                        throw new HttpBadRequestException($request, "Timeframes invalid!");
                    }
                    break;
                case "EnergyConsumed":
                    if (!$validation->isAlpha($value) && empty($value)) {
                        throw new HttpBadRequestException($request, "Energy entered invalid!");
                    }
                default:
                    break;
            }
        }
    }

    public function validateRecallData($request, array $emission)
    {
        $validation = new Input();
        foreach ($emission as $key => $value) {
            switch ($key) {
                case "RecallNumber":
                case "MakeModel":
                    if (!$validation->isAlpha($value) && empty($value)) {
                        throw new HttpBadRequestException($request, "VIN, Maker and Model invalid!");
                    }
                    break;
                case "RecallYear":
                case "RecallDate":
                    if (!$validation->isAlpha($value) && empty($value)) {
                        throw new HttpBadRequestException($request, "Year and price invalid!");
                    }
                default:
                    break;
            }
        }
    }
}
