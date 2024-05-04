<?php

$router->get('/', 'This is \'/\' page');
$router->get('/about', 'This is \'/about\' page');
$router->get('/test', 'This is \'/test\' page');

$router->get('/users/list', 'GET users list page');
$router->get('/users/get/{id}', 'GET users ID info page');
$router->put('/users/update', 'PUT users update-info page');
