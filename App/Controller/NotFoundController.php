<?php

namespace App\Controller;

class NotFoundController
{
    public function actionIndex(array $data = [])
    {
        extract($data);
        header("Status: " . $code . " " . $status);
        header("HTTP/1.1 " . $code . " " . $status);
        // Next - connect the template and display information like this:
        echo 'Sorry, but the requested page "' . $escaped_url . '" not found on our site for the reason: ' . $message . '.';
    }
}
