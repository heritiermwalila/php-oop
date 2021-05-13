<?php
namespace App;
use App\interfaces\Singleton;

class App implements Singleton {

    public $title = 'My opp course';

    private static $_instance = null;

//    private static $connection;
//
//    public static function connection()
//    {
//        if(is_null(self::$connection)){
//            self::$connection = new Database(self::DB_NAME, self::DB_HOST, self::DB_USER, self::DB_PASS);
//        }
//        return self::$connection;
//    }

    public static function getInstance()
    {
        if(is_null(self::$_instance)){
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    public function getModel($name)
    {
        $class_name = '\\App\\models\\' . ucfirst($name) . 'Model';
        return new $class_name();
    }
}