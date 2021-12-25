<?php

namespace Framework\Controller;

use App\Controller;
use Framework\Model\Order;
use Framework\View\OrderView;

class OrdersController extends Controller
{
    public function actionIndex(): void
    {
        $data = Order::getIndexData($this->queries, $this->gets);
        (new OrderView())->render($data);
    }
}
