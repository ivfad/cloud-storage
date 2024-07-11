<?php

use Core\Database;
use Core\Router;
use Core\Request;
use Core\Response;

const BASE_PATH = __DIR__ . '/../';

require_once BASE_PATH . '/vendor/autoload.php';
require_once base_path('bootstrap.php');

//$url = parse_url($_SERVER['REQUEST_URI']);
//
//$url = explode('/', $url['path']);
//
//dd(array_pop($url));

$router = new Router();

$request = Request::createFromGlobals();

$content = $router->route($request->uri(), $request->method());

$query = "select * from `user` where id > :id";
$result = $db->query($query, [':id' => 2])->find();

if (!$result['admin']) {
    $content = 'Not authorized user';
    $response = new Response($content, 403);
    $response->send();
}
//$response = new Response($content);
//$response->send();
//require_once base_path('index.view.php');
//dd($result['admin']);
