<?php
namespace App\models;

class Model {
    protected $table;
    public function __construct()
    {
        if(is_null($this->table)){
            $class_name = explode('\\', get_class($this));
            $class_name = end($class_name);
            $this->table = str_replace('model', '', strtolower($class_name));
        }
    }
}

























//namespace App\models;
//
//use App\App;
//use App\Helper;
//use http\Exception;
//use PDO;
//
//class Model
//{
//    private static $table;
//
//    public function findById($id)
//    {
//        echo $id;
//    }
//    public static function findOne(array $condition)
//    {
//        try {
//            if(is_null($condition)){
//                throw new \Exception('Invalid condition');
//            }
//            $statement = "SELECT * FROM ". self::getTable() . " WHERE " . self::getPlaceholder($condition);
//            $query = App::connection()->prepare($statement);
//            $query->setFetchMode(PDO::FETCH_CLASS, get_called_class());
//            $query->execute(self::getConditionValue($condition));
//            return $query->fetch();
//
//        }catch (\Exception $e){
//            Helper::dd($e->getMessage());
//        }
//    }
//
//    public static function create($data)
//    {
//        if(is_null($data) || count($data) === 0){
//            return null;
//        }
//        $statement = "INSERT INTO " . self::getTable() . " VALUES(null, " . self::getConditionValue($data, true) . ')';
//        echo $statement;
//        return App::connection()->execute($statement);
//    }
//
//    public static function findMany(array $condition = null)
//    {
//        $statement = "SELECT * FROM " . self::getTable();
//
//        if(!is_null($condition)){
//            $statement .= " WHERE " . self::getPlaceholder($condition);
//            $query = App::connection()->prepare($statement);
//            $query->setFetchMode(PDO::FETCH_CLASS, get_called_class());
//            $query->execute(self::getConditionValue($condition));
//
//            return $query->fetchAll();
//
//        }
//
//        $query = App::connection()->query($statement);
//        $query->setFetchMode(PDO::FETCH_CLASS, get_called_class());
//
//        return $query->fetchAll();
//
//    }
//
//    private static function getTable()
//    {
//        if(is_null(static::$table)){
//            $classname = explode('\\', get_called_class());
//            return strtolower(end($classname)) . "s";
//
//        }
//        return static::$table;
//    }
//
//    private static function getPlaceholder(array $condition = null, bool $onlyMarks = null)
//    {
//        if(is_null($condition)){
//            return '';
//        }
//        $keys = '';
//
//        if($onlyMarks){
//            foreach($condition as $key => $value){
//                $keys .= ":, ";
//            }
//
//            $pad = array_pad([], count(explode(', ', $keys)) - 1, '?');
//            $keys = implode(",", $pad);
//
//
//
//        }else {
//            foreach($condition as $key => $value){
//                $keys .= $key . "=:{$key} ";
//            }
//        }
//
//        return $keys;
//    }
//
//    private static function getConditionValue(array $condition = null, bool $onlyValues = null)
//    {
//        if(is_null($condition)){
//            return [];
//        }
//        $values = array();
//
//        foreach($condition as $key => $value){
//
//            $values[':' . $key] = $value;
//
//            // array_push($values, array($key=>$value));
//        }
//
//        if($onlyValues){
//            $values = [];
//            foreach($condition as $key => $value) {
//
//                array_push($values, '"' . $value . '"');
//            }
//
//            return implode(',', $values);
//        }
//
//
//        return $values;
//    }
//}