<?php
namespace Core\Facades;

use Core\Database\QueryBuilder;

/**
 * 
 */
class Query {

    /**
     * 
     */
    static public function __callStatic($name, $arguments)
    {
        $query = new QueryBuilder();
        return call_user_func_array([$query, $name], $arguments);
    }
}