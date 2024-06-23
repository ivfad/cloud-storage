<?php

use Core\Container;
use Core\Database;
use Core\App;
use Core\TestReflectionMain;

$container = Container::getInstance();

$container->bind(Database::class, function() {
    return Database::getInstance();
});

require_once base_path('Config.php');
$db = $container->get(Database::class);

$config = new Config;
$db->connect($config);

//$container->bind(TestReflectionMain::class, function() {
//    echo 'TestReflectionMain test output';
//});

//$container->bind(\Core\TestReflectionChildOne::class, function() {
//    return new \Core\TestReflectionChildOne(17);
//});
//$container->bind(TestReflectionMain::class,\Core\TestReflectionChildOne::class);

//$container->bind(\Core\TestReflectionChildOne::class, function() {
//    echo 'TestReflectionChildOne test output';
//});

//$container->bind(\Core\TestReflectionChildTwo::class, function() {
//    echo 'TestReflectionChildTwo test output';
//});

//$container->bind(\Core\TestReflectionChildThree::class, function() {
//    echo 'TestReflectionChildThree test output';
//});

//dd($container->get(TestReflectionMain::class));
//$db = $container->get(Database::class);
//dd($container->get(Database::class));
//dd($container);
//dd($container->checkInstantiability(Database::class));
//$container->createInstance(TestReflectionMain::class);
//dd(Database::class);
//App::setContainer($container);



