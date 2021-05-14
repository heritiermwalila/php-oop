<?php
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

ob_start();

if($page === 'posts'){
    require ROOT . '/pages/articles/posts.php';
}else if($page === 'post'){
    require ROOT . '/pages/articles/post.php';
}else {
    require ROOT . '/pages/home.php';
}

$content = ob_get_clean();


require ROOT . '/pages/templates/default.php';