<?php

use Core\Container;
use Core\Database;
use Core\App;

$container = new Container();

$container->bind(Database::class, function() {
    require_once base_path('config.php');
    $config = new Config;
    return new Database($config);
});

$db = $container->get(Database::class);

//App::setContainer($container);



