<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AboutController extends BaseController
{
    public function handleAboutApi(Request $request, Response $response, array $uri_args)
    {
        $data = array(
            'about' => 'Welcome to assignment 1 of web services it is a films api which provides data about films',
            'resources' => array(
                'films' => array(
                    'GET /films' => 'Get all films', 
                    'GET /films/{film_id}' => 'Get a film by ID',
                    'POST /films' => 'Create a new film',
                    'PUT /films' => 'Update films (specify details)',
                    'DELETE /films' => 'Delete films (specify details)'
                ),
                'actors' => array(
                    'GET /actors' => 'Get all actors',
                    'GET /actors/{actor_id}/films' => 'Get films of a specific actor',
                    'POST /actors' => 'Create a new actor'
                ),
                'customers' => array(
                    'GET /customers' => 'Get all customers',
                    'GET /customers/{customer_id}/films' => 'Get films rented by a customer',
                    'PUT /customers' => 'Update customer details (specify details)',
                    'DELETE /customers/{customer_id}' => 'Delete a customer by ID'
                ),
                'categories' => array(
                    'GET /categories/{category_id}/films' => 'Get films in a specific category'
                )
            )
        );                
        return $this->prepareOkResponse($response, $data);
    }
}
