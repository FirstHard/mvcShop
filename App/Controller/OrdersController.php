<?php

namespace App\Controller;

use Framework\Controller;
use App\Core\Db;
use App\Model\OrderMapper;
use App\View\OrderView;

class OrdersController extends Controller
{

    public function actionIndex(): void
    {
        $data = (new OrderMapper(Db::getInstance()))->getIndexData($this->gets);
        (new OrderView())->render($data);
    }

    public function actionSearch()
    {
        $data = (new OrderMapper(Db::getInstance()))->getSearchData($this->queries);
        (new OrderView())->render($data);
    }
}
