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
        $db = Db::getInstance();
        $data = (new OrderMapper($db))->getIndexData($this->gets);
        (new OrderView())->render($data);
    }

    public function actionSearch()
    {
        $db = Db::getInstance();
        $data = (new OrderMapper($db))->getSearchData($this->queries);
        (new OrderView())->render($data);
    }
}
