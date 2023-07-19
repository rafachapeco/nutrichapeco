<?php

ob_start();

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$route = new Router(CONF_URL_BASE, ":");

$route->namespace("Source\App");

/* GET */
$route->get("/", "Web:home");
$route->get("/sobre", "Web:about");
$route->get("/contato","Web:contact");
$route->get("/faq","Web:faq");
$route->get("/login","Web:login");
$route->post("/login","Web:loginPost");
$route->get("/cadastro","Web:signUp");
$route->post("/cadastro","Web:signUpPost");

/* POST */
//$route->post("/login", "ApiUsers:login");
//$route->post("/cadastro","ApiUsers:signUp");

/* App Routs */

 $route->group("/app"); 
 $route->get("/", "App:home");

 $route->get("/sobre", "App:about");
 $route->get("/contato","App:contact");
 $route->get("/faq","App:faq");

 $route->get("/receitas", "App:recipes");
 $route->get("/perfil", "App:profile");
 $route->post("/perfil", "App:profilePost");
 $route->get("/logout", "App:logout");



$route->get("/ops/{errcode}", "Web:error");

$route->dispatch();

if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();