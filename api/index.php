<?php

ob_start();

require __DIR__ . "/../vendor/autoload.php";

use CoffeeCode\Router\Router;

$route = new Router(url(), ":");

$route->namespace("Source\App");

/* GET ROUTES */

$route->get("/users", "Api:getUsers"); // http://www.localhost/nutrichapeco/api/users

/* POST ROUTES */

//$route->post("/user/post", "Api:insertUser");

/* PUT ROUTES */


$route->dispatch();

/* Error Redirect */

if ($route->error()) {
    header('Content-Type: application/json; charset=UTF-8');
    http_response_code(404);

    echo json_encode([
        "errors" => [
            "type " => "endpoint_not_found",
            "message" => "Não foi possível processar a requisição"
        ]
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

ob_end_flush();