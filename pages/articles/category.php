<?php
use Core\Helper;
$app = App::getInstance();
$category = $app->getModel('category');

$category = $category->findById(1);
$posts = $app->getModel('post');

$posts = $posts->findMany('id=' . $category->id)

?>

