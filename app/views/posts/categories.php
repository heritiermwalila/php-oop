<div class="post">
    <ul>
        <?php foreach ($categories as $category) : ?>
            <li>
                <a href="<?= $category->name; ?>"><?= $category->name; ?></a>
            </li>

        <?php endforeach; ?>
    </ul>


</div>