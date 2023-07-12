<?php

namespace App\Controllers;

use App\Validation\UserLoginValidator;

/**
 * User authorization controller.
 *
 * @package App\Controllers
 */
class AuthController
{
    /**
     * Render the login page.
     *
     * @return void
     */
    public function index(): void
    {
        session_start();
        if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
            header('Location: /');
            exit;
        }
        include_once __DIR__ . '/../Views/login.php';
    }

    /**
     * LogIn the admin.
     *
     * @return void
     */
    public function login(): void
    {
        $validator = new UserLoginValidator();
        $errors = $validator->validate($_POST);
        $login = trim($_POST['login']);
        $password = trim($_POST['password']);
        if (!empty($errors)) {
            include_once __DIR__ . '/../Views/login.php';
            exit;
        }
        session_start();
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['login'] = $_POST['login'];
        header('Location: /');
        exit;
    }

    /**
     * LogOut the admin.
     *
     * @return void
     */
    public function logout(): void
    {
        session_start();
        $_SESSION = array();
        session_destroy();
        header("Location: /");
        exit;
    }
}
