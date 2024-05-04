<?php

use Core\Database;

const BASE_PATH = __DIR__ . '/../';

require_once __DIR__ . '/../' . '/vendor/autoload.php';

$config = require base_path('config.php');

$db = new Database($config['database']);


$result = $db->query("select * from user where id>2")->fetchAll(PDO::FETCH_ASSOC);

//dd($result);



require_once base_path('index.view.php');


//var_dump($_SERVER['REQUEST_URI']);
//var_dump($_SERVER['QUERY_STRING']);
//$urlsList = [
//
//]
//var_dump($_SERVER);

