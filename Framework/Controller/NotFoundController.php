<?php

namespace Framework\Controller;

use App\Controller;

class NotFoundController extends Controller
{
    public function actionNotFound(array $data = []): void
    {
        extract($data);
        header("Status: " . $code . " " . $status);
        header("HTTP/1.1 " . $code . " " . $status);
        // Next - connect the template and display information like this:
        echo 'Sorry, but the requested page "' . $escaped_url . '" not found on our site for the reason: ' . $message . '.';
    }
}
