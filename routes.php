<?php
use App\Controllers\UserController;
use Core\Database;
use Core\Route;


//$router->get('/', 'This is \'/\' page');
//$router->get('/about', 'This is \'/about\' page');
//$router->get('/test', 'This is \'/test\' page');
//
//$router->get('/users/list', (new UserController(new Database(new Config)))->list());
//$router->get('/users/get/{id}', 'GET users ID info page');
//$router->put('/users/update', 'PUT users update-info page');


return [
//    Route::post('/test', function() {
//        echo '123';
//
//    }),
//    Route::get('/', function() {
//        echo '123';
//    }),
    Route::get('/test3', \App\Controllers\TestController::class, 'index'),
//    Route::post('/test3', \App\Controllers\TestController::class),
//    Route::post('/test2', function() {
//        echo '123';
//
//    }),
];