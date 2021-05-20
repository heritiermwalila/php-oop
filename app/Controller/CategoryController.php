<?php
namespace App\Controller;

class CategoryController extends AppController {

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Category');
    }

    public function index()
    {
        $categories  = $this->Category->findMany();
        return $this->render('posts.categories', compact('categories'));
    }
}