<?php 
namespace Core\Database;

use Core\Helper;

class QueryBuilder {

    private $select = [];
    private $from;
    private $where = [];
    private $update = [];
    private $insert = [];
    private $join;
    private $delete = [];
    private $on = [];

    public function select()
    {
        $this->select = func_get_args();

        return $this;
    }

    public function from(string $table, $alias = null)
    {
        if(\is_null($alias)){
            $this->from = " FROM $table $alias";
        }


        return $this;

    }

    public function where($condition)
    {
        $this->where[] = $condition;
        return $this;
    }

    public function update()
    {
        return $this;
    }

    public function insert()
    {
        return $this;
    }

    public function join($table, $alias)
    {
        $this->join[] = " JOIN $table $alias";
        return $this;
    }

    public function on()
    {
        $this->on = func_get_args();
        return $this;
    }

    public function get()
    {
        $query = "";
        if(!empty($this->select)){
            $query .= "SELECT " . implode(', ', $this->select);
            $query .= " FROM " . $this->from;
            if(isset($this->join)) {
                $query .= " JOIN " . implode(" ", $this->join);
            }
            $query .= " WHERE " .  implode(" AND ", $this->where);
        }

        Helper::dd($query);

        return $query . ';';
    }
}