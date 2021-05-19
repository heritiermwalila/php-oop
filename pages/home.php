<?php

use Core\Helper;

$app = App::getInstance();


$posts = $app->getModel('post');
$categories = $app->getModel('category');
// Helper::dd($categories->findMany());

?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>List of blogs</h1>
            <div class="posts">
                <?php foreach($posts->findMany() as $post) : ?>
                    <h2><?= $post->title; ?></h2>
                    <p>category: <?= $post->category_id; ?></p>
                    <p><?= $post->description; ?>...</p>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-md-4">
        <ul>
            <?php foreach($categories->findMany() as $category): ?>
                <li>
                    <a href="<?= $category->url; ?>"><?= ucfirst($category->name); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
            
        </div>
    </div>
</div>

