<?php

use Core\Database;
use Core\Router;
use Core\Request;
use Core\Response;

const BASE_PATH = __DIR__ . '/../';

require_once BASE_PATH . '/vendor/autoload.php';
require_once base_path('bootstrap.php');

//session_start();

//$routes = require base_path('routes.php');
//$response = (new $controller())->$method;

$router = new Router();

$request = Request::createFromGlobals();

//$router->route($request->uri(), $request->method());
$content = $router->route($request->uri(), $request->method());
//$content = 'ABC TEST RESPONSE';
//$controller = $content->getController();
//$method = $content->getAction();
//dd($controller->index());
//$response = new Response($content);
//$response->send();

//$router2 = new Router();
$result = $db->query("select * from user where id>2")->get();
//require_once base_path('index.view.php');
//dd($result);
