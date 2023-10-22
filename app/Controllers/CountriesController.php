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
    
        /*
        $validation_response = $this->isValidPagingParams($filters);
        if($validation_response === true){
    
            $this->countries_model->setPaginationOptions(
                $filters['page'],
                $filters['page_size']
            );
        
        }else{
            //httpbadrequestexception
        }
        */
    
        $countries = $this->countries_model->getAllCountries($filters);
    
        //$shows = $this->getTVMazeShows();
    
        
        
    
        return $this->prepareOkResponse($response, (array)$countries);
    }


}
