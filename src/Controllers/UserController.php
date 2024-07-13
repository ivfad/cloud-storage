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

    public static function get($params)
    {
        $id = $params['ida'];
        echo 'get' . $id . PHP_EOL;
        return;
//        $config = require BASE_PATH . 'Config.php';
//        $db = new Database($config['database']);
//        $usersList = $db->query("Select `name`, `age`, `gender` from `user`")->get();
    }

    public function test($params)
    {
        $id = $params['id'];
//        dd($id);
        echo 'share' . $id . PHP_EOL;
    }

    public function update()
    {

    }
}

