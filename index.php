<?php

use App\Controller\AppController;
use App\Controller\AuthController;
use App\Controller\CategoryController;
use App\Controller\PostController;
use Core\Helper;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('ROOT', __DIR__);


require ROOT . '/app/App.php';


App::load();


if(isset($_GET['page'])){
    $page = $_GET['page'];
}else {
    $page = "home";
}

if($page === 'posts'){
    $view = new PostController();
    $view->index();
}else if($page === 'posts.show'){
    $view = new PostController();
    $view->show($_GET['id']);
}else if($page === 'posts.categories') {
    $view = new CategoryController();
    $view->index();
}elseif($page === 'posts.category'){
    $view = new PostController();
    $view->showByCategory($_GET['id']);
}elseif ($page === 'notfound'){
    $view = new AppController();
    $view->notFound();
}elseif($page === 'login'){
    $view = new AuthController();
    $view->login();
}else {
    $view = new PostController();
    $view->index();
}