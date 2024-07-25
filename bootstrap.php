<?php

//use Core\Singleton;
use Core\Container;
use Core\Database;
use Core\App;
use Psr\Container\ContainerExceptionInterface;

//use Core\TestReflectionMain;
try {
    $container = Container::getInstance();
} catch (ContainerExceptionInterface $e) {
    echo $e->getMessage();
}

App::setContainer($container);

$container->singleton(Database::class, Database::getInstance());
require_once base_path('Config.php');
$db = $container->get(Database::class);

$config = new Config();

try {
    $db->connect($config);
} catch (PDOException $e) {
    echo 'PDOException: ' . $e->getMessage();
}

require_once base_path('Core/TestScenarios.php');
//$container->bind('abc', 'abc');
//dd($container);

//require_once base_path('Core/Model.php');
//require_once base_path('Core/View.php');
require_once base_path('Core/Controller.php');


