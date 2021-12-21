<?php

namespace Framework\Controller;

use App\Controller;
use Framework\Model\Order;
use Framework\View\OrderView;

class OrdersController extends Controller
{
    public function actionIndex($param = false, $query_data = false): void
    {
        $model = new Order();
        $model->getIndexData($query_data);
        $data = $model->data;
        (new OrderView())->render($data, $param, $query_data);
    }

    public function findAlias($alias): bool
    {
        return false;
    }
}
