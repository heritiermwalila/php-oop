<?php

use Core\Helper;

$app = App::getInstance();



$posts = $app->getModel('article');
$categories = $app->getModel('category');

Helper::dd($posts->findMany());
Helper::dd($categories->findMany());
?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>List of blogs</h1>
        </div>
    </div>
</div>

