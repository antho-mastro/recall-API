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

        /*$validation = new Input();

        foreach ($emission as $key => $value) {
            switch ($key) {
                case "title":
                    if (!$validation->isOnlyAlpha($value) || empty($value)) {
                        throw new HttpBadRequestException($request, "Invalid title. BAD REQUEST!");
                    }
                    break;
                case "release_year":
                case "language_id":
                case "rental_duration":
                case "length":
                    if (!$validation->isInt($value) || empty($value)) {
                        throw new HttpBadRequestException($request, "release_year or language_id or rental_duration or length is wrong. BAD REQUEST!");
                    }
                    break;
                case "rental_rate":
                case "replacement_cost":
                    if (!$validation->isInDecimal($value) || empty($value)) {
                        throw new HttpBadRequestException($request, "rental_rate or replacement_cost is wrong. BAD REQUEST!");
                    }
                    break;
                default:
                    break;
            }
        }*/
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

    public function validateStationsData(Request $request, array $station)
    {
        /*$validation = new Input();

        foreach ($station as $key => $value) {
            if ($key == "first_name" || $key == "last_name") {
                if (!$validation->isAlpha($value)) {
                    throw new HttpBadRequestException($request, "first name or last name is wrong. BAD REQUEST!");
                }
            }
        }*/
    }

    public function validateCountriesData($request, array $emission)
    {

        /*$validation = new Input();

        foreach ($emission as $key => $value) {
            switch ($key) {
                case "title":
                    if (!$validation->isOnlyAlpha($value) || empty($value)) {
                        throw new HttpBadRequestException($request, "Invalid title. BAD REQUEST!");
                    }
                    break;
                case "release_year":
                case "language_id":
                case "rental_duration":
                case "length":
                    if (!$validation->isInt($value) || empty($value)) {
                        throw new HttpBadRequestException($request, "release_year or language_id or rental_duration or length is wrong. BAD REQUEST!");
                    }
                    break;
                case "rental_rate":
                case "replacement_cost":
                    if (!$validation->isInDecimal($value) || empty($value)) {
                        throw new HttpBadRequestException($request, "rental_rate or replacement_cost is wrong. BAD REQUEST!");
                    }
                    break;
                default:
                    break;
            }
        }*/
    }
}
