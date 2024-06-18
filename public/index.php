<?php

use Core\Database;
use Core\Router;
use Core\Request;
use Core\Response;

const BASE_PATH = __DIR__ . '/../';

require_once BASE_PATH . '/vendor/autoload.php';

//session_start();

//Connecting DB-config
//require_once base_path('config.php');
require_once base_path('bootstrap.php');
//require_once  BASE_PATH . 'bootstrap.php';

$router = new Router();
//$routes = require base_path('routes.php');
$request = Request::createFromGlobals();
//dd($request);
$content = 'ABC TEST RESPONSE';
$response = new Response($content);
//$response = (new $controller())->$method;
$response->send();

$router->route($request->uri(), $request->method());

//$config = new Config;
//$db = new Database($config);
$result = $db->query("select * from user where id>2")->get();
dd($result);
require_once base_path('index.view.php');
