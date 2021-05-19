<?php
namespace Core\QueryBuilder;

use Core\QueryBuilder\SQLQueryInterface;
use Exception;
use PDOStatement;
use Core\Helper;
use stdClass;

class SQLQueryBuilder implements SQLQueryInterface {

    protected $query;


    private function reset()
    {
        $this->query = new stdClass();
    }

    public function select(string $table, ?array $fields = null): SQLQueryInterface
    {
        $this->reset();

        if(is_null($fields)){
            $this->query->select = "SELECT * FROM " . $table;
        }else {
            $this->query->select = "SELECT " . implode(", ", $fields) . " FROM " . $table;
        }
        
        $this->query->type = 'select';


        return $this;
    }

    public function prepare(string $table, array $fields): SQLQueryInterface
    {
        $this->reset();

        if(\is_null($fields) || empty($fields)){
            throw new Exception('Invalid fields for prepare statement');
        }
        $this->query->prepare = "SELECT * FROM $table WHERE " . implode(", ", $this->prepareStatementHelper($fields));
        $this->query->type = "prepare";
        return $this;
    }

    public function update(string $table, array $fields): SQLQueryBuilder
    {
        $this->reset();

        $str = [];
        foreach($fields as $key => $value) {
            array_push($str, " $key=\"$value\"");
        }
        $this->query->update = "UPDATE " . $table . " SET " . implode(" ", $str);
        $this->query->type = "update";
        // echo $this->query;
        return $this;
    }

    public function where(string $field, string $operator = '=', string $value): SQLQueryInterface
    {
        if(!in_array($this->query->type, ['select', 'update', 'delete'])) {
            throw new Exception('Only SELECT, UPDATE and DELETE is supported');
        }
        $this->query->where[] = "$field $operator '$value'";
        return $this;
    }

    public function limit(int $start, int $offset): SQLQueryInterface
    {
        if(!in_array($this->query->type, ['select'])){
            throw new Exception('Can only offset on SELECT');

        }

        $this->query->limit = " LIMIT " . $start . ", " . $offset;
        return $this;
    }

    public function get(): string
    {

        $query = $this->query;
        $sql;

       

        switch ($query->type) {
            case 'select':
               $sql = $query->select;
                break;
            case 'update':
                $sql = $query->update;
                break;

            case 'delete':
                $sql = $query->delete;
                break;

            case 'prepare':
                $sql = $query->prepare;
                break;
            
            default:
                throw new Exception("Invalid query type");
                break;
        }

    
        if(!empty($query->where)){
            $sql .= " WHERE " . implode(", ", $query->where);
        }

        if(isset($query->limit)){
            $sql .= $query->limit;
        }

        $sql .= ";";

        return $sql;
    }

    private function prepareStatementHelper($fields)
    {
        $keys = [];

        foreach($fields as $field){
            array_push($keys, "$field=:$field");
        }
        return $keys;
    }
}