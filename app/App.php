<?php

use Core\Connection\Mysql;
use App\Model;
use Core\Config;
use Core\QueryBuilder\SQLQueryBuilder;
use Core\Helper;

class App {

    public $title = 'My opp course';

    private static $_instance;
    private $db_instance;

    /**
     * Load the application
     */
    public static function load()
    {
        session_start();

        require ROOT . '/Autloader.php';
        App\Autloader::register();

        // include ROOT . '/core/Autloader.php';
        // Core\Autloader::register();
    }

    public static function getInstance()
    {
        if(is_null(self::$_instance)){
            self::$_instance = new App();
        }
       
        return self::$_instance;
    }

    public function getModel($name)
    {
        
        $class_name = '\\App\\Model\\' . ucfirst($name) . 'Model';
        // Helper::dd(new $class_name($this->getDb(), new SQLQueryBuilder()));
        return new $class_name($this->getDb(), new SQLQueryBuilder());
    }

    private function getDb()
    {
        $config = Config::getInstance(ROOT . '/config/config.php');
        
        if(is_null($this->db_instance)){
            $this->db_instance = new Mysql($config->get('db_name'), $config->get('db_host'), $config->get('db_user'), $config->get('db_pass'));
        }

        return $this->db_instance;
        
    }
}