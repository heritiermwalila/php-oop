<?php

interface SQLQueryBuilder {

    public function select(string $table, array $fields = null): SQLQueryBuilder;
    public function update(string $table, array $fields): SQLQueryBuilder; //$thist-sql->update(user, ['id'=> 1])
    public function where(string $field, string $value, string $operator = '='): SQLQueryBuilder;
    public function limit(int $start, int $offset): SQLQueryBuilder;

    public function get(): string;
}


class MySQLQueryBuilder implements SQLQueryBuilder {

    protected $query;


    protected function reset()
    {
        $this->query = new stdClass();
    }

    public function select(string $table, array $fields=null): SQLQueryBuilder
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

    public function update(string $table, array $fields): SQLQueryBuilder
    {
        $this->reset();
        $this->query = "UPDATE " . $table . " SET " . implode(" ", $fields);
        echo $this->query;
        return $this;
    }

    public function where(string $field, string $value, string $operator = '='): SQLQueryBuilder
    {
        if(!in_array($this->query->type, ['select', 'update', 'delete'])){
            throw new Exception('Were condition can only be used with select update and delete');
        }
        $this->query->where[] = "$field $operator '$value'";
        return $this;
    }

    public function limit(int $start, int $offset): SQLQueryBuilder
    {
        if(!in_array($this->query->type, ['select'])){
            throw new Exception('Limit can only be used with select');
        }

        $this->query->limit = " LIMIT " . $start . ", " . $offset;

        return $this;
    }

    public function get(): string
    {
        $query = $this->query;
        $sql = $query->select;

        if(!empty($this->query->where)){
            $sql .= " WHERE " . implode(" AND", $query->where);
        }

        if(isset($query->limit)){
            $sql .= $query->limit;
        }

        $sql .= ";";

        return $sql;
    }


}


function clientCode(SQLQueryBuilder $queryBuilder)
{
    $query = $queryBuilder
    ->select("users")
    ->where("status", "pending")
    ->limit(10, 40)
    ->get();

    echo $query;
}


clientCode(new MySQLQueryBuilder());