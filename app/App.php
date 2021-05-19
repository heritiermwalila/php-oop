<?php

use Core\Connection\Mysql;
use App\Model;
use Core\Config;
use Core\QueryBuilder\SQLQueryBuilder;
use Core\Helper;

/**
 * The bootstrap class
 * Class App
 */
class App {

    /**
     * App title
     * @var string
     */
    public $title = 'My opp course';

    /**
     * The App instance
     * @var _instance
     */
    private static $_instance;

    /**
     * Database instance
     * @var $db_instance
     */
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

    /**
     * App getter
     * @return _instance|App
     */
    public static function getInstance()
    {
        if(is_null(self::$_instance)){
            self::$_instance = new App();
        }
       
        return self::$_instance;
    }

    /**
     * factory method
     * @param $name
     * @return mixed
     */
    public function getModel($name)
    {
        $class_name = '\\App\\Model\\' . ucfirst($name) . 'Model';

        return new $class_name($this->getDb(), new SQLQueryBuilder());
    }

    /**
     * Get DB Instance
     * @return Mysql
     */
    private function getDb()
    {
        $config = Config::getInstance(ROOT . '/config/config.php');
        
        if(is_null($this->db_instance)){
            $this->db_instance = new Mysql($config->get('db_name'), $config->get('db_host'), $config->get('db_user'), $config->get('db_pass'));
        }

        return $this->db_instance;
        
    }

    /**
     * Not found method
     */
    public function notFound()
    {
        header('Location:index.php?page=notfound');
        exit();
    }
}