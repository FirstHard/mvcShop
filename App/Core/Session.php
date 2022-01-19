<?php

namespace App\Core;

use App\Model\User;

class Session
{

    public static function delete(): void
    {
        session_regenerate_id();
        setcookie(session_name(), session_id(), time() - 3600);
        unlink(session_save_path() . '/sess_' . $_SESSION[session_name()]);
        unset($_COOKIE);
        unset($_SESSION);
        session_unset();
        session_destroy();
    }

    public static function emergencyDelete(): void
    {
        session_regenerate_id();
        $compromised_cookies = $_COOKIE[session_name()];
        unlink(session_save_path() . '/sess_' . $compromised_cookies);
    }

    public static function writeUserSession(User $logged_user): void
    {
        // Writing data to the session and cookie
        $_SESSION['logged_user'] = serialize($logged_user);
        $_SESSION[session_name()] = session_id();
        $_SESSION['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
        setcookie(session_name(), session_id(), 1440, $_SERVER['HTTP_HOST'], '', false, false);
        setcookie('logged_user', $logged_user->getLogin(), 1440, $_SERVER['HTTP_HOST'], '', false, true);
    }

    public static function checkUserSession()
    {
        // Simple XSS attack check, prohibiting the same session from different user agent and from different IP
        if (($_SERVER['REMOTE_ADDR'] === $_SESSION['REMOTE_ADDR']) && ($_SERVER['HTTP_USER_AGENT'] === $_SESSION['USER_AGENT']) && ($_SESSION[session_name()] === $_COOKIE[session_name()])) {
            return unserialize($_SESSION["logged_user"]);
        }
        self::delete();
        self::emergencyDelete();
        return false;
    }

    public static function setSessionCookie(array $data): void
    {
        foreach ($data as $key => $value) {
            $_SESSION[$key] = $value;
            setcookie($key, $value, 1440, '/', HOME, false, true);
        }
    }

    public static function getSessionValue($key): string|bool
    {
        $value = false;
        if (isset($_SESSION[$key])) {
            $value = $_SESSION[$key];
        } elseif (isset($_COOKIE[$key])) {
            $value = $_COOKIE[$key];
        }
        return $value;
    }
}
