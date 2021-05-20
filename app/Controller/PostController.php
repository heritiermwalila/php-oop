<?php
namespace App\Controller;

use App;

class PostController extends AppController {

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Post');
        $this->loadModel('Category');
    }

    /**
     * List all posts
     */
    public function index()
    {
        $posts = $this->Post->findMany();
        $categories = $this->Category->findMany();

        return $this->render('posts.index', compact('posts', 'categories'));

    }

    /**
     * Show a single post
     * @param $id post id
     * @returm view
     */
    public function show($id)
    {
        $post = $this->Post->findById($id);
        return $this->render('posts.show', compact('post'));
    }

    public function showByCategory($id)
    {
        $posts = $this->Post->findByCategory($id);
        return $this->render('posts.category', compact('posts'));
    }

    /**
     * 
     */
    public function edit($id)
    {

    }

    /**
     * 
     */
    public function update($id, $data)
    {

    }

    /**
     * 
     */
    public function delete($id)
    {

    }
}