<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface  as HttpCodes;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Controllers\BaseController;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Models\ActorsModel;

class ActorsController extends BaseController
{
    private $actors_model = null;


    public function __construct()
    {
        $this->actors_model = new ActorsModel();
    }




    public function processAllActors(Request $request, Response $response)
    {
        $filters = $request->getQueryParams();
        if ($this->isValidPagingParams($filters)) {
            $this->actors_model->setPaginationOptions($filters["page"], $filters["page_size"]);
        }

        $actors = $this->actors_model->getAll($filters);
        return $this->prepareOkResponse($response, $actors);
    }


    public function processCreateActors(Request $request, Response $response)
    {

        $actors_data = $request->getParsedBody();
        if (empty($actors_data) || !is_array($actors_data)) {
            throw new HttpBadRequestException($request, "malformed data. BAD REQUEST!");
        }

        foreach ($actors_data as $actor) {
            $this->validateActorsData($request, $actor);
            $this->actors_model->actorsCreate($actor);
        }

        $response_data = array("code" => HttpCodes::STATUS_CREATED, "message" => "Actors has been successfully created!");
        return $this->prepareOkResponse($response, $response_data, HttpCodes::STATUS_CREATED);
    }


    public function processActorFilmsById(Request $request, Response $response, array $uri_args)
    {
        $actor_model = new ActorsModel();
        $actor_id = $uri_args["actor_id"];
        $data = $actor_model->getFilmsByActorId($actor_id);
        return $this->prepareOkResponse($response, $data);
    }
}
