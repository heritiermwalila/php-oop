<?php
namespace Core\Model;

use Core\Connection\Mysql;
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


    private function getQuery(): SQLQueryInterface
    {
    

        return new SQLQueryBuilder();
    }

    public function updateOne(array $fields, array $condition=null)
    {
        $statement = $this->sql->update($this->table, $fields)->get();

        echo $statement;

        
        
    }

    public function findById($id)
    {
        $statement = $this->sql->prepare($this->table, ['id'])->get();
    //     $query = $this->db->prepare($statement, [':id' => $id]);

    //    $result = $query->fetch();

        return $this->db->prepare($statement, [':id' => $id], \str_replace('Model', 'Entity', \get_class($this)));
    }

    public function findMany(array $condition = null, $attributes= null)
    {
        $statement = $this->sql
                    ->select($this->table)
                    ->get();
        if(!is_null($attributes)){
            $statement = $this->sql
                    ->select($this->table, $attributes)
                    ->get();
        }
       
        // $statement = "SELECT * FROM " . $this->table;

        // if(!is_null($condition)){
        //     $statement .= " WHERE " . $this->getPlaceholder($condition);
        //     $query = $this->db->prepare($statement);
        //     $query->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        //     $query->execute($this->getConditionValue($condition));

        //     return $query->fetchAll();

        // }

     
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

            // array_push($values, array($key=>$value));
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


}

