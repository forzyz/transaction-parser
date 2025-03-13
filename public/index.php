<?php

use App\App;
use App\Config;
use App\Controllers\HomeController;
use App\Router;
use Dotenv\Dotenv;

require __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define("STORAGE_PATH", __DIR__ . "/../storage");
define("VIEW_PATH", __DIR__ . "/../views");

$router = new Router();

$router->get("/", [HomeController::class, "index"]);

(new App($router,
    ["url" => $_SERVER["REQUEST_URI"], "method" => $_SERVER["REQUEST_METHOD"]],
    new Config($_ENV)))->run();
