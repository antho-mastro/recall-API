<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Controllers\AboutController;
use Vanier\Api\Controllers\CustomersController;
use Vanier\Api\Controllers\ActorsController;
use Vanier\Api\Controllers\CarEmissionsController;
use Vanier\Api\Controllers\CarSpecsController;
use Vanier\Api\Controllers\ChargingSationsController;
use Vanier\Api\Controllers\ChargingSessionsController;
use Vanier\Api\Controllers\CountriesController;
use Vanier\Api\Controllers\ElectricVehiclesController;
use Vanier\Api\Controllers\FilmsController;
use Vanier\Api\Controllers\RecallCarsController;

global $app;

$app->get('/', [AboutController::class, 'handleAboutApi']); 

//!App Route for carEmissions
$app->get('/emissions', [CarEmissionsController::class, 'processAllEmissions']);
//!App Route for carspecs
$app->get('/specs', [CarSpecsController::class, 'processAllSpecs']);
//!App Route for charging stations
$app->get('/stations', [ChargingSationsController::class, 'handleGetChargingStations']);
//!App Route for charging sessions
$app->get('/sessions', [ChargingSessionsController::class, 'handleGetChargingSessions']);
//!App Route for countries
$app->get('/countries', [CountriesController::class, 'handleGetCountries']);
//!App Route for electric vehicles

$app->get('/evs', [ElectricVehiclesController::class, 'handleGetEvs']);
//!App Route for recallCars
$app->get('/recalls', [RecallCarsController::class, 'handleGetRecallCars']);




