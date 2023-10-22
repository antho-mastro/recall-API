<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Fig\Http\Message\StatusCodeInterface  as HttpCodes;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Models\CustomersModel;


class CustomersController extends BaseController
{
    private $customer_model;
    private $validation;

    public function __construct()
    {
        $this->customer_model = new CustomersModel();
        $this->validation = new Input();
    }


    public function processAllCustomers(Request $request, Response $response)
    {
        $filters = $request->getQueryParams();
        if ($this->isValidPagingParams($filters)) {
            $this->customer_model->setPaginationOptions($filters["page"], $filters["page_size"]);
        }

        $films = $this->customer_model->getAllCustomers($filters);
        return $this->prepareOkResponse($response, $films);
    }

    public function processGetCustomersById(Request $request, Response $response, array $uri_args)
    {
        $customer_id = $uri_args["customer_id"];


        if (empty($customer_id) || is_null($customer_id)) {
            throw new HttpBadRequestException($request, "Invalid/malformed data...BAD REQUEST!");
        }


        if (!$this->customer_model->getCustomerById($customer_id)) {
            throw new HttpBadRequestException($request, "Customer id provided does not exist. BAD REQUEST!");
        }

        $data = $this->customer_model->getCustomerById($customer_id);


        return $this->prepareOkResponse($response, $data);
    }


    public function processDeleteCustomers(Request $request, Response $response, array $uri_args)
    {
        $customer_id = $uri_args["customer_id"];


        if (empty($customer_id) || is_null($customer_id)) {
            throw new HttpBadRequestException($request, "Invalid/malformed data...BAD REQUEST!");
        }

        if (!$this->customer_model->getCustomerById($customer_id)) {
            throw new HttpBadRequestException($request, "Customer id provided does not exist. BAD REQUEST!");
        }

        $this->customer_model->deleteCustomer($customer_id);


        $responseData = [
            'status_code' => HttpCodes::STATUS_CREATED,
            'message'     => 'Data successfully deleted!',
        ];


        return $this->prepareOkResponse($response, $responseData, HttpCodes::STATUS_CREATED);
    }






    public function processCustomersUpdate(Request $request, Response $response)
    {
        $customer_data = $request->getParsedBody();

        if (empty($customer_data) || !is_array($customer_data)) {
            throw new HttpBadRequestException($request, 'Invalid data provided. Bad Request!');
        }

        foreach ($customer_data as $customerDetails) {
            $this->validateCustomersData($request, $customerDetails);

            $customer_id = $customerDetails['customer_id'];
            unset($customerDetails['customer_id']);

            $this->customer_model->updateCustomer($customerDetails, ["customer_id" => $customer_id]);
        }

        $responseData = [
            'status_code' => HttpCodes::STATUS_CREATED,
            'message'     => 'Data successfully updated!',
        ];

        return $this->prepareOkResponse($response, $responseData, HttpCodes::STATUS_CREATED);
    }
}
