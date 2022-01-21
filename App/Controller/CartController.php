<?php

namespace App\Controller;

use App\View\CartView;
use App\Model\CartMapper;
use Framework\Controller;

class CartController extends Controller
{

    public function __construct()
    {
        $this->mapper = new CartMapper();
    }

    public function actionIndex(): void
    {
        $this->mapper->getIndexData();
        (new CartView())->render($this->mapper);
    }
}
