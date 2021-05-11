<?php
namespace App;

class Autloader
{
    private static function autoload($classname) {
        $classname = str_replace(__NAMESPACE__, '', $classname);
        $classname = str_replace('\\', '/', $classname);
        require __DIR__ . $classname . '.php';
    }

    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));

    }
}