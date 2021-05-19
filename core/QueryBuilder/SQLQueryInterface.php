<?php
namespace Core\QueryBuilder;

use PDOStatement;

interface SQLQueryInterface {

    public function select(string $table, array $fields = null): SQLQueryInterface;
    public function prepare(string $table, array $fields): SQLQueryInterface;
    public function update(string $table, array $fields): SQLQueryBuilder; //$thist-sql->update(user, ['id'=> 1])
    public function where(string $field, string $operator = '=', string $value): SQLQueryInterface;
    public function limit(int $start, int $offset): SQLQueryInterface;

    public function get(): string;
}