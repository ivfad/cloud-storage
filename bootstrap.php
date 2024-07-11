<?php

use Core\Singleton;
use Core\Container;
use Core\Database;
use Core\App;
use Core\TestReflectionMain;

$container = Container::getInstance();

App::setContainer($container);

$container->singleton(Database::class, Database::getInstance());

require_once base_path('Config.php');
$db = $container->get(Database::class);

$config = new Config();
$db->connect($config);
//$db->connect();
//$db->query('SELECT * FROM `users`');
require_once base_path('Core/TestScenarios.php');

//
//require_once base_path('Core/Model.php');
//require_once base_path('Core/View.php');
require_once base_path('Core/Controller.php');


