<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Controllers\AboutController;
use Vanier\Api\Controllers\CustomersController;
use Vanier\Api\Controllers\ActorsController;
use Vanier\Api\Controllers\CountriesController;
use Vanier\Api\Controllers\ElectricVehiclesController;
use Vanier\Api\Controllers\FilmsController;
use Vanier\Api\Controllers\RecallCarsController;
use Vanier\Api\Models\ElectricVehiclesModel;

global $app;

$app->get('/', [AboutController::class, 'handleAboutApi']); 
//!App Route for countries
$app->get('/', [CountriesController::class, 'handleGetCountries']);
//!App Route for electric vehicles
$app->get('/', [ElectricVehiclesController::class, 'handleGetEvs']);
//!App Route for recallCars
$app->get('/', [RecallCarsController::class, 'handleGetRecallCars']);

$app->get('/films', [FilmsController::class,'processAllFilms']);
$app->post('/films', [FilmsController::class, 'processCreateFilm']); 
$app->put('/films', [FilmsController::class, 'processFilmUpdate']);
$app->delete('/films', [FilmsController::class, 'processDeleteFilm']);
$app->get('/films/{film_id}', [FilmsController::class,'processGetFilmById']);

$app->get('/actors', [ActorsController::class,'processAllActors']);
$app->get('/actors/{actor_id}/films', [ActorsController::class,'processActorFilmsById']);
$app->post('/actors', [ActorsController::class, 'processCreateActors']);


$app->get('/customers', [CustomersController::class,'processAllCustomers']);
$app->get('/customers/{customer_id}/films', [CustomersController::class,'processGetCustomersById']);
$app->put('/customers', [CustomersController::class, 'processCustomersUpdate']);
$app->delete('/customers/{customer_id}', [CustomersController::class, 'processDeleteCustomers']);


$app->get('/categories/{category_id}/films', [FilmsController::class, 'processGetCategoryFilm']);


