<?php

namespace App\Controller;

use Framework\Controller;
use App\Model\OrderMapper;
use App\Model\UserMapper;
use App\View\UserView;

class UserController extends Controller
{
    protected $mapper;

    public function __construct()
    {
        $this->mapper = new UserMapper();
    }

    public function actionIndex(): void
    {
        if ($logged_user = $this->auth->isAuth()) {
            $this->mapper->getProfileData($logged_user, $this->gets);
            (new UserView())->renderIndex($this->mapper);
        } else {
            header('Location: /user/login');
        }
    }

    public function actionLogin()
    {
        if ($this->auth->isAuth()) {
            header('Location: /user');
        } else {
            if (!empty($this->auth->errors)) {
                $this->mapper->errors = $this->auth->errors;
            }
            $this->mapper->login();
            (new UserView())->renderLoginPage($this->mapper);
        }
    }

    public function actionReset()
    {
        $addmodule = 'reset';
        if (isset($this->gets['token'])) {
            if ($user = $this->mapper->getByToken($this->gets['token'])) {
                $this->mapper->reset('reset_success', $user);
                $addmodule = 'set_password';
            } else {
                $this->mapper->reset('reset_false');
            }
        } elseif (isset($this->gets['action']) && $this->gets['action'] == 'complete') {
            $this->mapper->reset('reset_complete');
            $addmodule = '';
        } else {
            $this->mapper->reset();
        }
        (new UserView())->renderDefault($this->mapper, $addmodule);
    }

    public function actionRegistration()
    {
        if (isset($this->gets['action']) && $this->gets['action'] == 'complete') {
            $this->mapper->registrationComplete();
            (new UserView())->renderDefault($this->mapper);
        } else {
            $this->mapper->registration();
            (new UserView())->renderRegistrationPage($this->mapper);
        }
    }

    public function actionCheck()
    {
        if (isset($this->gets['token'])) {
            if ($this->auth->checkToken($this->gets['token'])) {
                $this->auth->resetToken($this->gets['token']);
                $this->mapper->registrationSuccess();
            } else {
                $this->mapper->registrationFailed();
            }
        } else {
            $this->mapper->registrationFailed();
        }
        (new UserView())->renderDefault($this->mapper);
    }

    public function actionOrders()
    {
        if ($user = $this->auth->logged_user) {
            if (!isset($this->param)) {
                $this->mapper->getUserOrdersData($user->getId(), $this->gets);
            } else {
                $this->mapper->getUserOrder($this->param, $user->getId());
            }
            (new UserView())->render($this->mapper);
        } else {
            header('Location: /user/login');
        }
    }

    public function actionOrdersSearch()
    {
        if ($user = $this->auth->logged_user) {
            $user_id = $user->getId();
            $this->mapper->getSearchData($user_id, $this->queries);
            (new UserView())->render($this->mapper);
        } else {
            header('Location: /user/login');
        }
    }
}
