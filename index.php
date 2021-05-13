<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Autloader;
require "app/Autloader.php";


Autloader::register();


if(isset($_GET['p'])){
    $p = $_GET['p'];
}else {
    $p = 'home';
}
ob_start();
if($p === 'posts'){
    require 'pages/posts.php';
}else {
    require 'pages/home.php';
}

$content = ob_get_clean();

require 'pages/templates/default.php';