<?php
namespace App\Controller;

use App;
use Core\Controller\Controller;

class AppController extends Controller {

    protected $template = 'default';

    public function __construct()
    {
        $this->viewPath = ROOT . '/app/views';
    }

    protected function loadModel($name)
    {
        return $this->$name = App::getInstance()->getModel($name);
    }

}