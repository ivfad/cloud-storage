<?php

namespace App\Controllers;
use Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
//        require_once BASE_PATH . 'index.view.php';
        require_once base_path('index.view.php');
    }
}