<?php

use Core\Container;
use Core\Database;
use Core\App;
use Core\TestReflectionMain;

$container = Container::getInstance();

$container->singleton(Database::class, Database::getInstance());

//$container->bind(Database::class, function() {
//    return Database::getInstance();
//});
require_once base_path('Config.php');
$db = $container->get(Database::class);

$config = new Config();
$db->connect($config);

interface DatabaseDriver {
    public function connect();
    public function query();
}

class MySQL implements DatabaseDriver {
    public function connect()
    {
        var_dump('Connecting to MySQL');
    }

    public function query()
    {
        var_dump('Querying to MySQL');
    }
}

class Postgre implements DatabaseDriver {
    public function connect()
    {
        var_dump('Connceting to Postgre');
    }

    public function query()
    {
        var_dump('Connecting to Postgre');
    }
}

class UserModel {
    public function __construct(DatabaseDriver $driver)
    {
        $driver->connect();
        $driver->query();
    }
}

//$container->bind(DatabaseDriver::class, Postgre::class);
//
//
//$container->get(UserModel::class);

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
//dd($container);


//$container->bind(TestReflectionMain::class, function () {
//    return new TestReflectionMain(12);
//});
//$container->get(TestReflectionMain::class);


//dd($container->get(TestReflectionMain::class));
//$db = $container->get(Database::class);
//dd($container->get(Database::class));
//dd($container);
//dd($container->checkInstantiability(Database::class));
//$container->get(TestReflectionMain::class);
//dd($container->get(TestReflectionMain::class));
//dd(Database::class);
//App::setContainer($container);



