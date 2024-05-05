<?php
use App\Controllers\UserController;
use Core\Database;
$router->get('/', 'This is \'/\' page');
$router->get('/about', 'This is \'/about\' page');
$router->get('/test', 'This is \'/test\' page');

$router->get('/users/list', (new UserController(new Database(new Config)))->list());
$router->get('/users/get/{id}', 'GET users ID info page');
$router->put('/users/update', 'PUT users update-info page');
