<?php

namespace Framework\Controller;

use App\Controller;
use Framework\Model\Home;
use Framework\View\HomeView;

class SiteController extends Controller
{
    public function actionIndex(): void
    {
        $data = (new Home())->data;
        (new HomeView())->render($data);
    }
}
