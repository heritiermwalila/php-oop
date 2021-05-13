<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Autloader;
use App\core\Config;
use App\App;
require "app/Autloader.php";


Autloader::register();
$app = App::getInstance();

var_dump($app->getModel('article'));
var_dump($app->getModel('category'));