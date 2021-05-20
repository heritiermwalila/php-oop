<div class="posts">
    <?php foreach ($posts as $post) : ?>
        <h2><?= $post->title; ?></h2>
        <p>category: <?= $post->category_id; ?></p>
        <p><?= $post->description; ?>...</p>
        <a href="<?= $post->url; ?>" class="btn btn-primary">Read more</a>
    <?php endforeach; ?>
</div>