<?php

use App\App;
use App\Config;
use Dotenv\Dotenv;

require __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define("STORAGE_PATH", __DIR__ . "/../storage");
define("VIEW_PATH",  __DIR__ . "/../views");

$app = new App(new Config($_ENV));

var_dump($app::db());