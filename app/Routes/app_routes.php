<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Controllers\AboutController;
use Vanier\Api\Controllers\CustomersController;
use Vanier\Api\Controllers\ActorsController;
use Vanier\Api\Controllers\FilmsController;

global $app;

$app->get('/', [AboutController::class, 'handleAboutApi']); 

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


