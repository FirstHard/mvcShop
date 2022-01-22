<?php

namespace Framework;

use App\Core\Auth;
use App\Model\CartMapper;

class View
{
    protected $auth;

    public function __construct()
    {
        $this->auth = new Auth();
        $this->cart = new CartMapper();
        $this->cart->getIndexData();
    }

    public function render($data): void
    {
    }
}
