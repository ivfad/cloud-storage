<?php

use Core\Container;
use Core\Database;
use Core\App;

$container = new Container();

$container->bind(Database::class, function() {
    return new Database();
});

$db = $container->get(Database::class);

App::setContainer($container);



