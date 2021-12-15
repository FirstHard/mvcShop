<?php

namespace App\Controller;
use App\Model\Home;
use App\View\HomeView;

class SiteController
{
    public function actionIndex()
    {
        $model = new Home();
        $data = $model->data;
        (new HomeView())->render($data);
    }
}
