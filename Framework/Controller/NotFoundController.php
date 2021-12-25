<?php

namespace Framework\Controller;

use App\Controller;
use Framework\Model\Error;
use Framework\View\ErrorView;

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
