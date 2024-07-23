<?php
//use App\Controllers\UserController;
//use Core\Database;
use Core\Route;

return [
    Route::get('/test3', [\App\Controllers\TestController::class, 'index']),
    Route::get('/files/share/{id}/{user}', [\App\Controllers\UserController::class, 'test']),
    Route::get('/users/get/{ida}', [\App\Controllers\UserController::class, 'get']),
    Route::get('/users/list', [\App\Controllers\UserController::class, 'list']),
    Route::put('/users/update', [\App\Controllers\UserController::class, 'get']),
    Route::get('/register', [App\Controllers\RegistrationController::class, 'index'])->access('guest'),
    Route::post('/register', [App\Controllers\RegistrationController::class, 'store']),


//    Route::get('/', [\App\Controllers\HomeController::class, 'index'])::access(),
//    Route::access(Route::get('/', [\App\Controllers\HomeController::class, 'index'])),
    Route::get('/', [\App\Controllers\HomeController::class, 'index']),
    Route::get('/test2', [\App\Controllers\TestController::class, 'index'])->access('user'),
    Route::put('/test2', [\App\Controllers\TestController::class, 'index']),
//    Route::post('/test3', \App\Controllers\TestController::class),
    Route::get('/test', function() {
        echo '123';
    }),
];
