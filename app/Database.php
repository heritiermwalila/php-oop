<?php


namespace App;


class Database
{
    private $db_name;
    private $db_host;
    private $db_user;
    private $db_pass;
    private $pdo;
    public function __construct($db_name, $db_host, $db_user, $db_pass)
    {
        $this->db_host = $db_host;
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
    }

    private function getPDO()
    {
        if(is_null($this->pdo)){
            $pdo = new \PDO('mysql:dbname=' . $this->db_name . 'host=' . $this->db_host, $this->db_user, $this->db_pass);
            $pdo->setAttribute(PDO::ATTR_ERROR, PDO::ERRORMODE_EXCEPTION);
            $this->pdo = $pdo;
            return $this->pdo;
        }
    }

    public function query($statement, $class_name)
    {
        $request = $this->getPDO()->query($statement);
        return $request->fetchAll(PDO::FETCH_CLASS, $class_name);
    }
}