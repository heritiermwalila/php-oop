<?php

use App\models\Article;
use App\models\CategoryModel;
?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php foreach (Article::findMany() as $post): ?>
                <h2><?= $post->title; ?></h2>
                <p><em><?= $post->description; ?></em></p>
                <p><?= $post->content; ?></p>
                <a href="<?= $post->url; ?>">Read more</a>
            <?php endforeach; ?>
        </div>
        <div class="col-md-4">
            <ul>
                <?php foreach (CategoryModel::findMany() as $category): ?>
                    <li><?= $category->title; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

