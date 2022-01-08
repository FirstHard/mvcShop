<?php

namespace App\Controller;

use App\Model\OrderMapper;
use App\View\OrderView;
use Framework\Controller;

class OrdersController extends Controller
{

    public function actionIndex(): void
    {
        $data = (new OrderMapper())->getIndexData($this->gets);
        (new OrderView())->renderList($data);
    }

    public function actionSearch()
    {
        $data = (new OrderMapper())->getSearchData($this->queries);
        (new OrderView())->renderList($data);
    }

    public function actionView()
    {
        $data = (new OrderMapper())->getOrder($this->param);
        (new OrderView())->renderOne($data);
    }

    public function actionEdit()
    {

    }

    public function actionUpdate()
    {

    }

    public function actionCreate()
    {

    }
}
