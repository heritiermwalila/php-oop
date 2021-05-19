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
    require ROOT . '/pages/admin/posts/index.php';
}else if($page === 'posts.show'){
    require ROOT . '/pages/admin/posts/show.php';
}else if($page === 'posts.category') {
    require ROOT . '/pages/admin/posts/category.php';
}elseif ($page === 'notfound'){
    require ROOT . '/pages/notfound.php';
}else {
    require ROOT . '/pages/admin/index.php';
}

$content = ob_get_clean();


require ROOT . '/pages/templates/default.php';