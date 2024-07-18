<?php

namespace App\Controllers;
use Core\App;
use Core\Controller;
use Core\Database;

class RegistrationController extends Controller
{
    public function index()
    {
//        require_once BASE_PATH . 'index.view.php';
        require_once base_path('register.view.php');
    }

    public function store()
    {
//        require_once BASE_PATH . 'index.view.php';
//        dd($_POST);
//        require_once base_path('register.view.php');
        $db = App::get(Database::class);
        $email = $_POST['email'];
        $user = $db->query('SELECT * FROM `user` where email = :email', [
            ':email' => $email,
        ])->find();
        if ($user) {
            header('location: /');
            exit();
            //redirect to login, because there is such user
        } else {
            $db->query('INSERT INTO `user`(email, password) VALUES(:email, :password)', [
                ':email' => $email,
                ':password' => $_POST['password'],
            ]);

            $_SESSION['user'] = [
                'email' => $email,
            ];

            header('location: /');
            exit();
        }
    }
}