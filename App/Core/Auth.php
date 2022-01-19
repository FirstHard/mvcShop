<?php

namespace App\Core;

use App\Core\Session;
use App\Model\UserMapper;
use App\Core\ExceptionsHandler;
use FirstHard\LogsHandler;

class Auth
{

    public $logged_user = '';
    public $errors = [];

    public function __construct()
    {
        $this->isAuth();
        if (isset($_GET['do']) && $_GET['do'] == 'login') $this->doLogin();
        if (isset($_GET['do']) && $_GET['do'] == 'registration') $this->doRegistration();
        if (isset($_GET['do']) && $_GET['do'] == 'reset') $this->doReset();
        if (isset($_GET['do']) && $_GET['do'] == 'set_password') $this->doSetPassword();
        if (isset($_GET['do']) && $_GET['do'] == 'logout') $this->doLogout();
    }

    private function doLogin()
    {
        $message = [];
        if ($data = filter_input_array(INPUT_POST)) {
            $mapper = new UserMapper();
            if ($user = $mapper->isExist($data)) {
                if (password_verify($data['password'], $user->getPassword())) {
                    if ($user->getBlocked() != 1) {
                        // That's right, let's authorize the user and redirecting him to Home page.
                        $this->logged_user = $user;
                        $params['id'] = $user->getId();
                        $params['auth_token'] = trim(file_get_contents('/proc/sys/kernel/random/uuid'));
                        if (!$mapper->update($params, 'user')) {
                            LogsHandler::debug(0, ['Message' => 'Can`t update user info on login!']);
                        }
                        Session::writeUserSession($this->logged_user);
                        header('Location: /');
                    } else {
                        $message['error']['message_heading'] = 'Your account still blocked!';
                        $message['error']['message_description'] = 'If you have not yet activated your account after registration - follow the link in the email message we sent you.';
                    }
                } else {
                    $message['error']['message_heading'] = 'You enter a wrong password!';
                    $message['error']['message_description'] = 'Please, try again!';
                }
            } else {
                $message['error']['message_heading'] = 'You enter a wrong login!';
                $message['error']['message_description'] = 'Please, try again!';
            }
        } else {
            $message['error']['message_heading'] = 'Something went wrong!';
            $message['error']['message_description'] = 'The data you sent has not been validated on the server. Please, try again later!';
        }
        $this->errors = $message;
    }

    public function doSetPassword()
    {
        $userMapper = new UserMapper();
        if ($data = filter_input_array(INPUT_POST)) {
            if ($user = (new UserMapper())->getById('user', $data['id'])) {
                $user['blocked'] = 0;
                $user['password'] = password_hash($data['password'], PASSWORD_ARGON2I);
                $user['auth_token'] = trim(file_get_contents('/proc/sys/kernel/random/uuid'));
                if ($userMapper->update($user, 'user')) {
                    header('Location: /user/login');
                }
            } else {
                header('Location: /');
            }
        }
        return false;
    }

    public function doRegistration()
    {
        $message = [];
        if ($data = filter_input_array(INPUT_POST)) {
            if ((new UserMapper())->isExist($data)) {
                $message['error']['message_heading'] = 'User exist!';
                $message['error']['message_description'] = 'Please register another Login and/or Email!';
                $this->errors = $message;
            } else {
                return $this->registration($data);
            }
        }
        return false;
    }

    public function resetToken($token)
    {
        $userMapper = new UserMapper();
        if ($user = $userMapper->selectWhereAnd('user', false, ['auth_token' => trim($token)])) {
            $user['blocked'] = 0;
            $user['auth_token'] = trim(file_get_contents('/proc/sys/kernel/random/uuid'));
            if ($userMapper->update($user, 'user')) {
                return true;
            }
        }
        return false;
    }

    public function checkToken($token)
    {
        $userMapper = new UserMapper();
        if ($userMapper->selectWhereAnd('user', false, ['auth_token' => trim($token)])) {
            return true;
        }
        return false;
    }

    public function doReset()
    {
        if ($data = filter_input_array(INPUT_POST)) {
            $mapper = new UserMapper();
            if ($user = $mapper->isExist($data)) {
                $to = $user->getFirstName() . " " . $user->getLastName() . " <" . $user->getEmail() . ">";
                $subject = "Password reset";
                $message = '
                <html>
                    <head>
                        <title>Password reset request</title>
                    </head>
                    <body>
                        <p>To reset your password please follow the link: <a href="http://staging.buinoff.tk:8080/user/reset?token=' . $user->getAuthToken() . '" target=_blank>http://staging.buinoff.tk:8080/user/reset?token=' . $user->getAuthToken() . '</a></p>
                        <p>After reset password, You may be able to login on our site.</p>
                        <br>
                        <p>Best regards, Staging.Buinoff.Tk Site Administrator</p>
                        <small>Please do not reply to this email - it was generated automatically.</small>
                    </body>
                </html>';
                $headers = "Content-type: text/html; charset=utf-8 \r\n" .
                'Reply-To: root@staging.buinoff.tk' . "\r\n" .
                'X-Mailer: PHP/' . phpversion() . "\r\n" .
                'MIME-Version: 1.0' . "\r\n";
                $headers .= "From: Admin <root@staging.buinoff.tk>\r\n";
                if (mail($to, $subject, $message, $headers)) {
                    header('Location: /user/reset?action=complete');
                } else {
                    LogsHandler::debug(0, ['Message' => 'Can`t sent email to user from reset password page!', 'email' => $user->getEmail()]);
                }
            }
        }
        return false;
    }

    private function registration($data)
    {
        $userMapper = new UserMapper();
        $data['id'] = 0;
        $data['password'] = password_hash($data['password'], PASSWORD_ARGON2I);
        $data['auth_token'] = trim(file_get_contents('/proc/sys/kernel/random/uuid'));
        $data['registered_at'] = date("Y-m-d H:i:s");
        unset($data['last_login']);
        $data['blocked'] = 1;
        $data['country'] = 'USA';
        if ($userMapper->insert($data, 'user')) {
            $to = $data['first_name'] . " " . $data['last_name'] . " <" . $data['email'] . ">";
            $subject = "You registered on MvcShop!";
            $message = '
            <html>
                <head>
                    <title>Congratulations on registering on MvcShop!</title>
                </head>
                <body>
                    <p>To activate your account please follow the link: <a href="http://staging.buinoff.tk:8080/user/check?do=activate&token=' . $data['auth_token'] . '" target=_blank>http://staging.buinoff.tk:8080/user/check?do=activate&token=' . $data['auth_token'] . '</a></p>
                    <p>After activation account, You may be able to login on our site.</p>
                    <p>Remember:</p>
                    <p>Your Login: ' . $data['login'] . '</p>
                    <p>Your password: the one you entered during registration.</p>
                    <br>
                    <p>Best regards, Staging.Buinoff.Tk Site Administrator</p>
                    <small>Please do not reply to this email - it was generated automatically.</small>
                </body>
            </html>';
            $headers = "Content-type: text/html; charset=utf-8 \r\n" .
            'Reply-To: root@staging.buinoff.tk' . "\r\n" .
            'X-Mailer: PHP/' . phpversion() . "\r\n" .
            'MIME-Version: 1.0' . "\r\n";
            $headers .= "From: Admin <root@staging.buinoff.tk>\r\n";
            if (mail($to, $subject, $message, $headers)) {
                header('Location: /user/registration?action=complete');
            } else {
                LogsHandler::debug(0, ['Message' => 'Can`t sent email to user from registration page!', 'email' => $data['email']]);
            }
        }
        return false;
    }

    public function isLogged()
    {
        if (empty($this->logged_user)) {
            header('Location: /user/login');
        }
        return $this->logged_user;
    }

    public function isAuth()
    {
        $message = false;
        if (isset($_SESSION["logged_user"])) { // If session variable logged_user exists
            if ($this->logged_user = Session::checkUserSession()) {
                return $this->logged_user;
            } else {
                $message['error']['message_heading'] = 'Suspected XSS attack!';
                $message['error']['message_description'] = 'For security reasons, we have deleted the previous session. Please log in again!';
                $this->errors = $message;
            }
        }
        return false; //The user is not logged in because variable logged_user not created or checking session is false
    }

    public function doLogout()
    {
        Session::delete();
        header('Location: /');
    }
}
