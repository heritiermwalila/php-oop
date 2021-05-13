<?php


namespace App;
use PDO;

class Database
{
    private $db_name;
    private $db_host;
    private $db_user;
    private $db_pass;
    private $pdo;
    public function __construct(string $db_name, string $db_host, string $db_user, string $db_pass)
    {
        $this->db_host = $db_host;
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
    }

    private function getPDO()
    {
        if(is_null($this->pdo)){
            $dsn = 'mysql:dbname=' . $this->db_name . ';host=' . $this->db_host;
            $pdo = new PDO($dsn, $this->db_user, $this->db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
            return $this->pdo;
        }
    }

    public function query($statement)
    {
        return $this->getPDO()->query($statement);
    }

    public function prepare($statement)
    {
        return $this->getPDO()->prepare($statement);
    }

    public function execute($statement)
    {
        return $this->getPDO()->exec($statement);
    }
}