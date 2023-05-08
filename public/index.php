<?php

require_once __DIR__."/../vendor/autoload.php";



use app\config\Application;
use app\controllers\AddController;
use app\controllers\TestController;
use app\controllers\AuthController;

$app = new Application(dirname(__DIR__));



$app->route->get("/","World");
$app->route->get("/test",[TestController::class,"index"]);
$app->route->post("/test",[TestController::class,"index"]);

$app->route->get("/add",[AddController::class,"index"]);
$app->route->post("/add",[AddController::class,"index"]);

$app->route->get("/login",[AuthController::class,"login"]);
$app->route->post("/login",[AuthController::class,"login"]);

$app->route->post("/logout",[AuthController::class,"logout"]);





$app->run();