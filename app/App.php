<?php
namespace App;

class App {

    const DB_NAME = 'opp_db';
    const DB_USER = 'root';
    const DB_PASS = '';
    const DB_HOST = 'localhost';

    private static $connection;

    public static function connection()
    {
        if(is_null(self::$connection)){
            self::$connection = new Database(self::DB_NAME, self::DB_HOST, self::DB_USER, self::DB_PASS);
        }
        return self::$connection;
    }
}