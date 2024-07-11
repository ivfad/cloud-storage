<?php
use App\Controllers\UserController;
use Core\Database;
use Core\Route;

return [
    Route::get('/users/list', [\App\Controllers\UserController::class, 'list']),
    Route::get('/users/get/{id}', [\App\Controllers\UserController::class, 'get']),
    Route::put('/users/update', [\App\Controllers\UserController::class, 'get']),

    Route::get('/test3', [\App\Controllers\TestController::class, 'index']),
    Route::get('/', [\App\Controllers\HomeController::class, 'index']),
    Route::post('/test2', [\App\Controllers\TestController::class, 'index']),
    Route::put('/test2', [\App\Controllers\TestController::class, 'index']),
//    Route::post('/test3', \App\Controllers\TestController::class),
    Route::get('/test', function() {
        echo '123';
    }),
];
