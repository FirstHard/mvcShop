<?php

namespace Framework\Controller;

use Framework\Core\Db;
use App\Controller;
use Framework\Model\OrderMapper;
use Framework\View\OrderView;

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
