<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('ROOT', __DIR__);
use Core\Auth\BasicAuth;
use Core\QueryBuilder\SQLQueryBuilder;


require ROOT . '/app/App.php';


App::load();

/**
 * Authentication
 */
$app = App::getInstance();
$auth = new BasicAuth($app->getDb(), new SQLQueryBuilder);

if(!$auth->logged()){

    $app->forbidden();

}else {
    header('Location:admin.php?page=login');
}


if(isset($_GET['page'])){
    $page = $_GET['page'];
}else {
    $page = "home";
}

ob_start();

if($page === 'posts'){
    require ROOT . '/pages/admin/posts/index.php';
}else if($page === 'posts.show'){
    require ROOT . '/pages/admin/posts/show.php';
}else if($page === 'posts.category') {
    require ROOT . '/pages/admin/posts/category.php';
}elseif ($page === 'notfound'){
    require ROOT . '/pages/notfound.php';
}elseif ($page === 'login'){
    require ROOT . '/pages/auth/login.php';
}else {
    require ROOT . '/pages/admin/index.php';
}

$content = ob_get_clean();


require ROOT . '/pages/templates/default.php';