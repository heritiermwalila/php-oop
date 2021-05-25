<?php
namespace Core\Model;

use Core\Database\Mysql;
use Core\QueryBuilder\SQLQueryBuilder;
use Core\QueryBuilder\SQLQueryInterface;
use Core\Helper;
use PDO;

class Model {
    protected $table;
    protected $db;
    protected $sql;

    public function __construct(Mysql $db, SQLQueryInterface $sql)
    {
        
        $this->db = $db;
        $this->sql = $sql;
        
        if(is_null($this->table)){
            $class_name = explode('\\', get_class($this));
            $class_name = end($class_name);
            $this->table = str_replace('model', '', strtolower($class_name));
           
        }
    }


    public function updateOne(array $fields, array $condition=null)
    {
        $statement = $this->sql->update($this->table, $fields)->get();

        echo $statement;

        
        
    }

    public function findById($id)
    {
        $statement = $this->sql->prepare($this->table, ['id'])->get();

        return $this->db->prepare($statement, [':id' => $id], \str_replace('Model', 'Entity', \get_class($this)), true);
    }

    public function findMany($attributes= null)
    {
        $statement = $this->sql
            ->select($this->table)
            ->get();
        if(!is_null($attributes)){
            $statement = $this->sql
                ->select($this->table, $attributes)
                ->get();
        }
        $query = $this->db->query($statement, \str_replace('Model', 'Entity', \get_class($this)));


        return $query->fetchAll();

    }

    private function getPlaceholder(array $condition = null, bool $onlyMarks = null)
    {
        if(is_null($condition)){
            return '';
        }
        $keys = '';

        if($onlyMarks){
            foreach($condition as $key => $value){
                $keys .= ":, ";
            }

            $pad = array_pad([], count(explode(', ', $keys)) - 1, '?');
            $keys = implode(",", $pad);



        }else {
            foreach($condition as $key => $value){
                $keys .= $key . "=:{$key} ";
            }
        }

        return $keys;
    }

    private function getConditionValue(array $condition = null, bool $onlyValues = null)
    {
        if(is_null($condition)){
            return [];
        }
        $values = array();

        foreach($condition as $key => $value){

            $values[':' . $key] = $value;

        }

        if($onlyValues){
            $values = [];
            foreach($condition as $key => $value) {

                array_push($values, '"' . $value . '"');
            }

            return implode(',', $values);
        }


        return $values;
    }

    private function getFormatedCondition(array $condition)
    {
        //where(
    }


}

