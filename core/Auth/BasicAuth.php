<?php
namespace Core\Auth;

use Core\Connection\Database;
use Core\Helper;
use Core\QueryBuilder\SQLQueryBuilder;

class BasicAuth
{
    private $db;
    private $sql;
    public function __construct(Database $db, SQLQueryBuilder $sql)
    {
        $this->db = $db;
        $this->sql = $sql;
    }

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function login($username, $password): bool
    {
        $statement = $this->sql->prepare('users', ['username', 'password'])->get();
        $query = $this->db->prepare($statement, null, true);

        Helper::dd($query);

        if(!$query){
            return false;
        }
        return true;
    }

    public function logged()
    {
        return $_SESSION['auth'];
    }
}