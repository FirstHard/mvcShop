<?php

namespace App\Controller;

use App\Model\Error;
use App\View\ErrorView;
use Framework\Controller;

class NotFoundController extends Controller
{
    public function actionNotFound(int $code): void
    {
        header("Status: " . $code . "Not Found");
        header("HTTP/1.1 " . $code . "Not Found");
        $data = (new Error())->getErrorInfo($code);
        (new ErrorView())->render($data);
    }
}
