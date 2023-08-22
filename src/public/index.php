<?php

use App\Controllers\ArrayToExcelController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

// use App\Controllers\ArrayToExcelController;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("JSON Excel 1.0");
    return $response;
});

$app->get('/ok', [ArrayToExcelController::class, 'index']);

$app->run();
