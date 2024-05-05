<?php

namespace App\Controllers;

use Core\App;
use Core\Database;
use PDO;

class UserController {

    public function __construct(private Database $db)
    {}

    public function list():array
    {
//        $config = require BASE_PATH . 'config.php';
//        $db = new Database($config['database']);
        $usersList = $this->db->query("Select `name`, `age`, `gender` from `user`")->get();

        return $usersList;
    }

    public function get($id)
    {
//        $config = require BASE_PATH . 'config.php';
//        $db = new Database($config['database']);
//        $usersList = $db->query("Select `name`, `age`, `gender` from `user`")->get();
    }
}

