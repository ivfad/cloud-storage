<?php

use Core\Database;
use Core\Router;

const BASE_PATH = __DIR__ . '/../';

require_once BASE_PATH . '/vendor/autoload.php';

session_start();

$config = require base_path('config.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'] ?? '/';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$router = new Router();
$routes = require base_path('routes.php');



$router->route($uri, $method);
require_once  BASE_PATH . 'bootstrap.php';
//$config = new Config;
//$db = new Database($config);
//$result = $db->query("select * from user where id>2")->get();
//dd($result);
require_once base_path('index.view.php');
