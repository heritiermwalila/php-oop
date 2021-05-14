<?php 
    $app = App::getInstance();
    $post = $app->getModel('articles');

    $post = $post->findOne()

?>

<h1><?= $post->title; ?></h1>
<p>Categpry: <?= $post->category_id ?></p>
<em><?= $post->description; ?></em>
<p><?= $post->content; ?></p>


