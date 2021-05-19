<?php
namespace App;

class Autloader
{
    private static function autoload($classname) {
        // echo $classname . '<br />';
        // $classname = str_replace(__NAMESPACE__ . '\\', '', $classname);
        $classname = str_replace('\\', '/', $classname);

        // echo $classname . '<br />';
              
        require __DIR__ . '/' .  lcfirst($classname) . '.php';
    }

    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));

    }
}