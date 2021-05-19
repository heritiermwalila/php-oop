<?php
use Core\Helper;
$app = App::getInstance();
$category = $app->getModel('category');

$category = $category->findById($_GET['id']);

if(is_null($category))
{
    $app->notFound();
}

$app->title = $category->name;
$posts = $app->getModel('post');

$emptyPost = false;
$posts = $posts->findByCategory($category->id);

if(empty($posts)){
    $emptyPost = true;
}


?>

<div class="post">
    <?php if($emptyPost): ?>
        <h1>No blog post found for this category</h1>
    <?php else : ?>
        <?php foreach ($posts as $post): ?>
            <h2><?= $post->title; ?></h2>
            <p><?= $post->description; ?></p>
            <a href="<?= $post->url; ?>" class="btn btn-primary">Read more...</a>
        <?php endforeach; ?>
    <?php endif; ?>

</div>

