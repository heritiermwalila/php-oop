<?php


namespace Core\connection;

use PDO;
use Core\Helper;

/**
 * Class Database
 * @package App
 */
class Mysql extends Database
{
    private $db_name;
    private $db_host;
    private $db_user;
    private $db_pass;
    private $pdo;

    /**
     * Database constructor.
     * @param string $db_name
     * @param string $db_host
     * @param string $db_user
     * @param string $db_pass
     */
    public function __construct(string $db_name, string $db_host, string $db_user, string $db_pass)
    {
        $this->db_host = $db_host;
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
    }

    /**
     * @return PDO
     */
    private function getPDO()
    {
        try {
            if(is_null($this->pdo)){
                $dsn = 'mysql:dbname=' . $this->db_name . ';host=' . $this->db_host;

                $pdo = new PDO($dsn, $this->db_user, $this->db_pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo = $pdo;

            }
            return $this->pdo;
        }catch (\Exception $e){
            Helper::dd($e->getMessage());
        }
    }

    /**
     * @param $statement
     * @return false|\PDOStatement
     */
    public function query($statement)
    {
        try {

            return $this->getPDO()->query($statement);
        }catch (\Exception $e){
            Helper::dd($e->getMessage());
        }
    }

    /**
     * @param $statement
     * @return false|\PDOStatement
     */
    public function prepare($statement)
    {
        try {

            return $this->getPDO()->prepare($statement);
        }catch (\Exception $exception){
            Helper::dd($exception->getMessage());
        }
    }

    /**
     * @param $statement
     * @return false|int
     */
    public function execute($statement)
    {
        try {
            return $this->getPDO()->exec($statement);
        }catch (\Exception $exception){
            Helper::dd($exception->getMessage());
        }
    }
}