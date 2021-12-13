<?php

namespace App\Controller;
use App\Model\Home;
use App\View\HomeView;

class SiteController
{
    public function actionIndex()
    {
        $data = [];
        $model = new Home();
        $data['headers'] = $model->page_data;
        $data['newArrivalsProducts'] = $model->newArrivalsProducts();
        $data['topProducts'] = $model->topProducts();
        $data['recommendedProducts'] = $model->recommendedProducts();
        (new HomeView())->render($data);
    }
}
