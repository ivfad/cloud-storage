<?php

namespace Core;

use Config;
use PDO;
use PDOStatement;

class Database
{
    protected PDO $connection;
    protected PDOStatement $statement;

    public function __construct($config = new Config, $username = 'root', $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, arg_separator: ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
    public function query(string $query):Database
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute();

        return $this;
    }

    public function get()
    {
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->statement->fetch();

//        !$result ? : abort();
        if(!$result) {
            abort();
        }

        return $result;
    }
}