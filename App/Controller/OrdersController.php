<?php

namespace App\Controller;

use App\Core\Db;
use App\Model\OrderMapper;
use App\View\OrderView;
use Framework\Controller;

class OrdersController extends Controller
{

    public function actionIndex(): void
    {
        $data = (new OrderMapper())->getIndexData($this->gets);
        (new OrderView())->render($data);
    }

    public function actionSearch()
    {
        $data = (new OrderMapper())->getSearchData($this->queries);
        (new OrderView())->render($data);
    }
}
