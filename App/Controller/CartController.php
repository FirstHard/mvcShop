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

    public function actionCheckout(): void
    {
        $cart_token = false;
        if ($this->gets['cart_token']) {
            $cart_token = $this->gets['cart_token'];
        }
        $this->mapper->getCheckoutData($cart_token);
        (new CartView())->renderCheckout($this->mapper);
    }

    public function actionSuccess()
    {
        $this->mapper->checkoutSuccess();
        (new CartView())->renderResult($this->mapper);
    }

    public function actionFailed()
    {
        $this->mapper->checkoutFailed();
        (new CartView())->renderResult($this->mapper);
    }
}
