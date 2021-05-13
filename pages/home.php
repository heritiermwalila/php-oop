<?php

use App\models\Article;

// Article::findMany();
Article::create([
    'title'=>'First articles',
    'description'=> 'This is my description',
    "content"=>'This is my first article content',
]);