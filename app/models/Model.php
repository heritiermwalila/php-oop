<?php
namespace App\models;

use App\App;
use App\Helper;
use PDO;

class Model
{
    private static $table;

    public function findById($id)
    {
        echo $id;
    }
    public function findOne($instance)
    {
        echo $instance;
    }

    public static function create($data)
    {
        if(is_null($data) || count($data) === 0){
            return null;
        }
        $statement = "INSERT INTO " . self::getTable() . " VALUES(" . self::getConditionValue($data, true) . ')';
        echo $statement;
        $query = App::connection()->execute($statement);
        echo $query;
        // $query->execute(self::getConditionValue($data, true));

        // // $response = $query->fetchAll();

        // return $query->execute(self::getConditionValue($data));
    }

    public static function findMany(array $condition = null)
    {
        $statement = "SELECT * FROM " . self::getTable();

        if(!is_null($condition)){
            $statement .= " WHERE " . self::getPlaceholder($condition);
            $query = App::connection()->prepare($statement);
            $query->setFetchMode(PDO::FETCH_CLASS);
            $query->execute(self::getConditionValue($condition));

            $response = $query->fetchAll();

            return $response;
           
        }

        $query = App::connection()->query($statement)->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        return $query;
        
    }

    private static function getTable()
    {
        if(is_null(static::$table)){
            $classname = explode('\\', get_called_class());
            $classname = strtolower(end($classname)) . "s";

            return $classname;

        }
        return static::$table;
    }

    private static function getPlaceholder(array $condition = null, bool $onlyMarks = false)
    {
        if(is_null($condition)){
            return '';
        }
        $keys = '';

        if($onlyMarks){
            foreach($condition as $key => $value){
                $keys .= "?, ";
            }

            $pad = array_pad([], count(explode(', ', $keys)) - 1, '?');
            $keys = implode(",", $pad);
            

           
        }else {
            foreach($condition as $key => $value){
                $keys .= $key . "=?,";
            }
        }

        return $keys;
    }

    private static function getConditionValue(array $condition = null, bool $onlyValues = false)
    {
        if(is_null($condition)){
            return [];
        }
        $values = array();

        foreach($condition as $key => $value){

            $values[$key] = $value;
           
            // array_push($values, array($key=>$value));
        }

        if($onlyValues){
            $values = [];
            foreach($condition as $key => $value) {
               
                array_push($values, $value);
            }

            return implode('","', $values);
        }

       Helper::dd($values);
        

    

        return $values;
    }
}