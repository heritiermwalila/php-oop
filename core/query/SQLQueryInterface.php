<?php
namespace Core\query;

use PDOStatement;

interface SQLQueryInterface {

    public function select(string $table, array $fields = null): SQLQueryInterface;
    public function where(string $field, string $operator = '=', string $value): SQLQueryInterface;
    public function limit(int $start, int $offset): SQLQueryInterface;

    public function get(): string;
}