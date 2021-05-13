<?php
namespace App;

class Helper {

    static function dd($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }
}