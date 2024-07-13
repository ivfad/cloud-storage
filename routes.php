<?php
use App\Controllers\UserController;
use Core\Database;
use Core\Route;

return [
    Route::get('/test3', [\App\Controllers\TestController::class, 'index']),
    Route::get('/users/get/{ida}', [\App\Controllers\UserController::class, 'get']),
    Route::get('/files/share/{id}/{user}', [\App\Controllers\UserController::class, 'test']),
    Route::get('/users/list', [\App\Controllers\UserController::class, 'list']),
    Route::put('/users/update', [\App\Controllers\UserController::class, 'get']),

    Route::get('/', [\App\Controllers\HomeController::class, 'index']),
    Route::post('/test2', [\App\Controllers\TestController::class, 'index']),
    Route::put('/test2', [\App\Controllers\TestController::class, 'index']),
//    Route::post('/test3', \App\Controllers\TestController::class),
    Route::get('/test', function() {
        echo '123';
    }),
];
