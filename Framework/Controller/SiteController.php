<?php

namespace Framework\Controller;

use App\Controller;
use Framework\Model\Home;
use Framework\View\HomeView;

class SiteController extends Controller
{
    public function actionIndex(): void
    {
        $model = new Home();
        $data = $model->data;
        (new HomeView())->render($data);
    }
}
