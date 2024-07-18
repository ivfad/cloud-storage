<?php

declare(strict_types=1);
use Core\Database;
use Core\Router;
use Core\Request;
use Core\Response;
const BASE_PATH = __DIR__ . '/../';

session_start();

require_once BASE_PATH . '/vendor/autoload.php';
require_once base_path('bootstrap.php');

$router = new Router();

$request = Request::createFromGlobals();

//$content = $router->route($request->uri(), $request->method());
$content = $router->route($request);

$query = "select * from `user` where id > :id";
$result = $db->query($query, [':id' => 2])->find();

$currentUser = 0;
//dd($currentUser);
//if (!$result['admin']) {
if ($currentUser !== 1) {
    $content = 'Not authorized user';
    $response = new Response($content, 403);
    $response->send();
}
//$response = new Response($content);
//$response->send();
//require_once base_path('index.view.php');
//dd($result['admin']);
