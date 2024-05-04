<?php

use Core\Database;
use Core\Router;

const BASE_PATH = __DIR__ . '/../';

require_once __DIR__ . '/../' . '/vendor/autoload.php';

$config = require base_path('config.php');

$router = new Router();
$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);

$db = new Database($config['database']);
$result = $db->query("select * from user where id>2")->fetchAll(PDO::FETCH_ASSOC);

require_once base_path('index.view.php');
