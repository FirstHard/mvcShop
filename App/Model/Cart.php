<?php

namespace App\Model;

use Framework\Model;

class Cart extends Model
{
    protected $id;
    protected $cart_token;
    protected $user_id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCartToken()
    {
        return $this->cart_token;
    }

    public function setCartToken($cart_token)
    {
        $this->cart_token = $cart_token;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
}
