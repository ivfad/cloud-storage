<?php

namespace Core\Middleware;

class Auth
{
    public function handle()
    {
//        $user = $_SESSION ? $_SESSION['user'] : false;
//        dd($_SESSION ? $_SESSION['user'] : false);
        if(!$_SESSION || !$_SESSION['user']) {
            header('location: /');
            die();
        }
    }
}