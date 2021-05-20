<?php
namespace Core\Controller;

class Controller {

    protected $template;
    protected $viewPath;

    protected function render($name, $args)
    {
        
        $view = $this->viewPath . '/' . str_replace('.', '/', $name) . '.php';
        extract($args);
        ob_start();

        require($view);

        $content = ob_get_clean();

        require($this->viewPath . '/' . 'templates/' . $this->template . '.php');
    }


    /**
     * Not found method
     */
    public function notFound()
    {
        header('Location:index.php?page=notfound');
        exit();
    }

    public function forbidden()
    {
        header('HTTP/1.0 403 Forbidden');
        die('Access denied');
    }
}