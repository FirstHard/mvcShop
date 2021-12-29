<?php

namespace App\Controller;

use Framework\Controller;

class UserController extends Controller
{
    public function actionIndex(): void
    {
        echo 'User area';
    }

    public function actionLogin()
    {
        echo 'Login Page';
    }

    public function actionLogout()
    {
        echo 'Logout Page';
    }
}
