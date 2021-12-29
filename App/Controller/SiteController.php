<?php

namespace App\Controller;

use Framework\Controller;
use App\Model\Home;
use App\View\HomeView;

class SiteController extends Controller
{
    public function actionIndex(): void
    {
        $data = (new Home())->data;
        (new HomeView())->render($data);
    }
}
