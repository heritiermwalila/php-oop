<?php
namespace Core\query;

use Core\query\SQLQueryInterface;
use Exception;
use PDOStatement;
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

    public function where(string $field, string $operator = '=', string $value): SQLQueryInterface
    {
        if(!in_array($this->query->type, ['select', 'update', 'delete'])) {
            throw new Exception('Only SELECT, UPDATE and DELETE is supported');
        }
        $this->query->where[] = "$field $operator '$$value'";
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

        $sql = $query->select;

        if(!empty($query->where)){
            $sql .= " WHERE " . implode(", ", $query->where);
        }

        if(isset($query->limit)){
            $sql .= $query->limit;
        }

        $sql .= ";";

        return $sql;
    }
}