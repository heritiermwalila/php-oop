<?php use App\models\Article;

$post = Article::findOne(array('id'=>$_GET['id']));
?>

<h1><?= $post->title; ?></h1>
<p>Categpry: <?= $post->category_id ?></p>
<em><?= $post->description; ?></em>
<p><?= $post->content; ?></p>


