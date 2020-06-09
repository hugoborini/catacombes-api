<?php

namespace Hash\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Handlers\Strategies\RequestResponseArgs;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as resMid; 

// Composer autoloader
require __DIR__ . '/vendor/autoload.php';
require "class/middleWare.php";
require "controller/controller.php";



// Instanciation de l'application Slim
$app = AppFactory::create();

$app->setBasePath("/catacombes-api");

$app->getRouteCollector()
    ->setDefaultInvocationStrategy(new RequestResponseArgs());

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

$app->get('/', function(Request $request, Response $response){
    $response->getBody()->write("API ON WIP"); 
    return $response;
});

$app->group('/room', function(RouteCollectorProxy $group){
    $group->get("/", function(Request $request, Response $response){
        $response->getBody();
        header('Content-Type: application/json');
        echo getAllRoomToJson();
        return $response;
    });

    $group->get('/{room}' ,function(Request $request, Response $response, $room){
        $response->getBody();
        header('Content-Type: application/json');
        echo getRoomToJson($room);
        return $response;
    });
});

$app->run();