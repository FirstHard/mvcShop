<?php

namespace App\Controller;

use App\Model\Home;
use App\View\HomeView;
use Framework\Controller;

class SiteController extends Controller
{
    public function actionIndex(): void
    {
        $data = (new Home())->data;
        (new HomeView())->render($data);
    }
}
