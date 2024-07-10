<?php

use Core\Database;
use Core\Router;
use Core\Request;
use Core\Response;

const BASE_PATH = __DIR__ . '/../';

require_once BASE_PATH . '/vendor/autoload.php';
require_once base_path('bootstrap.php');

//session_start();

$router = new Router();

$request = Request::createFromGlobals();

$content = $router->route($request->uri(), $request->method());

$result = $db->query("select * from `user` where id>2")->get();
//require_once base_path('index.view.php');
dd($result);
