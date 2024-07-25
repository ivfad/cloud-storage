<?php

namespace App\Controllers;

use App\Models\UserModel;
use Core\App;
use Core\Controller;
use Core\Database;
use Core\Request;
use Core\Route;
use Core\View;


class UserController extends Controller{

    function __construct()
    {
        parent::__construct();
        $this->model = new UserModel();
        $this->view = new View();
    }

    public function list():array
    {
        return $this->model->getUsersList();
    }

    public function login(Request $request)
    {
        $email = $request->post()['email'];
        $password = $request->post()['password'];

        $user = $this->model->getUserByEmail($email);

        if(!$user) {
            return 'There is no such user';
        }

        if(!password_verify($password, $user['password'])) {
            return 'Incorrect password';
        }

        $_SESSION['user'] = [
            'email' => $email,
            'admin' => $user['admin'],
        ];

        session_regenerate_id(true);

        header('location: /');
        exit();
    }

    public function logout()
    {
        session_destroy();
        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain']);

        header('location: /');
        exit();
    }

    public function loginView(Request $request)
    {
        return require_once base_path('login.view.php');
    }

    public function get(Request $request, $params)
    {
        $id = $params['id'];

        return $this->model->getUserInfoById($id);
    }

    public function test(Request $request, $params)
    {
        $id = $params['id'];
        $user = $params['user'];
        echo 'id = ' . $id . ' user =' . $user . PHP_EOL;
    }

    public function update()
    {

    }
}

