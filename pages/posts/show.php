<?php 
    $app = App::getInstance();
    $post = $app->getModel('post');

    $post = $post->findById($_GET['id']);


    if(!$post){

        $app->notFound();
    }

?>

<h1><?= $post->title; ?></h1>
<p>Categpry: <?= $post->category_id ?></p>
<em><?= $post->description; ?></em>
<p><?= $post->content; ?></p>


