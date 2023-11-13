<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Controllers\AboutController;
use Vanier\Api\Controllers\CarEmissionsController;
use Vanier\Api\Controllers\CarSpecsController;
use Vanier\Api\Controllers\ChargingSessionsController;
use Vanier\Api\Controllers\CountriesController;
use Vanier\Api\Controllers\ElectricVehiclesController;
use Vanier\Api\Controllers\RecallCarsController;
use Vanier\Api\Controllers\ChargeStationsController;

global $app;

$app->get('/', [AboutController::class, 'handleAboutApi']); 

//!App Route for carEmissions
$app->get('/emissions', [CarEmissionsController::class, 'processAllEmissions']);
$app->delete('/emissions', [CarEmissionsController::class, 'processDeleteEmission']);
$app->put('/emissions', [CarEmissionsController::class, 'processEmissionUpdate']);

//!App Route for carspecs
$app->get('/specs', [CarSpecsController::class, 'processAllSpecs']);
$app->delete('/specs', [CarSpecsController::class, 'processDeleteSpec']);

//!App Route for charging stations
$app->get('/stations', [ChargeStationsController::class, 'handleGetChargeStations']);
$app->post('/stations', [ChargeStationsController::class, 'processCreateStation']);
$app->put('/stations', [ChargeStationsController::class, 'processUpdateStation']);

//!App Route for charging sessions
$app->get('/sessions', [ChargingSessionsController::class, 'handleGetChargingSessions']);
$app->delete('/sessions', [ChargingSessionsController::class, 'processDeleteSessions']);
$app->post('/sessions', [ChargingSessionsController::class, 'processCreateSession']);

//!App Route for countries
$app->get('/countries', [CountriesController::class, 'handleGetCountries']);
$app->post('/countries', [CountriesController::class, 'processCreateCountry']);

//!App Route for electric vehicles
$app->get('/evs', [ElectricVehiclesController::class, 'handleGetEvs']);
$app->post('/evs', [ElectricVehiclesController::class, 'processCreateEvs']);
$app->put('/evs', [ElectricVehiclesController::class, 'processEvsUpdate']);

//!App Route for recallCars
$app->get('/recalls', [RecallCarsController::class, 'handleGetRecallCars']);
$app->delete('/recalls', [RecallCarsController::class, 'processDeleteRecall']);
$app->put('/recalls', [RecallCarsController::class, 'processUpdateRecall']);




