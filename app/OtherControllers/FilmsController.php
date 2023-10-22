<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface  as HttpCodes;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Controllers\BaseController;
use Vanier\Api\Models\FilmsModel;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class FilmsController extends BaseController
{
    private $films_model = null;


    public function __construct()
    {
        $this->films_model = new FilmsModel();
    }




    public function processAllFilms(Request $request, Response $response)
    {
        $filters = $request->getQueryParams();
        if ($this->isValidPagingParams($filters)) {
            $this->films_model->setPaginationOptions($filters["page"], $filters["page_size"]);
        }
        $filterOptions = array();
        if (isset($filters['rating'])) {
            $filterOptions['rating'] = $filters['rating'];
        }
        $films = $this->films_model->getAll($filters);
        return $this->prepareOkResponse($response, $films);
    }


    public function processCreateFilm(Request $request, Response $response)
    {

        $films_data = $request->getParsedBody();
        if (empty($films_data) || !is_array($films_data)) {
            throw new HttpBadRequestException($request, "Invalid/malformed data...BAD REQUEST!");
        }

        foreach ($films_data as $film) {
            $this->validateFilmsData($request, $film);
            $this->films_model->filmsCreate($film);
        }

        $response_data = array("code" => HttpCodes::STATUS_CREATED, "message" => "films has been successfully created!");
        return $this->prepareOkResponse($response, $response_data, HttpCodes::STATUS_CREATED);
    }

    public function processGetFilmById(Request $request, Response $response, array $url_args)
    {
        $film_id = $url_args['film_id'];
        if (!ctype_digit($film_id)) {
            throw new HttpNotFoundException($request, "Invalid film ID");
        }
        $data = $this->films_model->getFilmById((int)$film_id);
        return $this->prepareOkResponse($response, $data);
    }


    public function processFilmUpdate(Request $request, Response $response)
    {
        $filmData = $request->getParsedBody();

        if (empty($filmData) || !is_array($filmData)) {
            throw new HttpBadRequestException($request, 'Invalid data provided. Bad Request!');
        }

        foreach ($filmData as $filmDetails) {
            $this->validateFilmsData($request, $filmDetails);

            $filmId = $filmDetails['film_id'];
            unset($filmDetails['film_id']);

            $this->films_model->FilmUpdate($filmDetails, ["film_id" => $filmId]);
        }

        $responseData = [
            'status_code' => HttpCodes::STATUS_CREATED,
            'message'     => 'Data successfully updated!',
        ];

        return $this->prepareOkResponse($response, $responseData, HttpCodes::STATUS_CREATED);
    }

    public function processDeleteFilm(Request $request, Response $response)
    {
        $films_data = $request->getParsedBody();
        if (empty($films_data) || !is_array($films_data)) {
            throw new HttpBadRequestException($request, 'Invalid data provided. Bad Request!');
        }

        foreach ($films_data as $data) {
            if (!$this->films_model->getFilmById($data)) {
                throw new HttpBadRequestException($request, "Film id provided does not exist. BAD REQUEST!");
            }
            $this->films_model->deleteFilm($data);
        }

        $responseData = [
            'status_code' => HttpCodes::STATUS_CREATED,
            'message'     => 'Data successfully deleted!',
        ];


        return $this->prepareOkResponse($response, $responseData, HttpCodes::STATUS_CREATED);
    }


    public function processGetCategoryFilm(Request $request, Response $response, array $uri_args)
    {
        $category_id = $uri_args["category_id"];
        $data = $this->films_model->getFilmsByCategory($category_id);
        return $this->prepareOkResponse($response, $data);
    }
}
