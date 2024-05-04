<?php

namespace Core;

use PDO;
use PDOStatement;

class Database
{
    public PDO $connection;

    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, arg_separator: ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    public function query($query):PDOStatement
    {
        $statement = $this->connection->prepare($query);
        $statement->execute();

        return $statement;
    }
}