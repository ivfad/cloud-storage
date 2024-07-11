<?php

namespace App\Controllers;

use Core\App;
use Core\Controller;
use Core\Database;
//use PDO;

class UserController extends Controller{

    public function list():array
    {
        $db= App::getContainer()->get(Database::class);
        $usersList = $db->query("Select `name`, `age`, `gender` from `user`")->get();
        return $usersList;
    }

    public function get($id)
    {
//        $config = require BASE_PATH . 'Config.php';
//        $db = new Database($config['database']);
//        $usersList = $db->query("Select `name`, `age`, `gender` from `user`")->get();
    }

    public function update()
    {

    }
}

