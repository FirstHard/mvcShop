<?php

namespace App\Model;

use App\Core\Auth;
use App\Core\Session;
use App\Model\ProductMapper;
use Framework\DataMapper;

class CartMapper extends DataMapper
{
    protected $elements;
    protected const TABLE_NAME = 'cart';
    public $cart_products;
    public $cart_token;
    public $total = 0;
    public $main_data;
    public $user;

    public function fetchCollection($objects): array
    {
        foreach ($objects as $object) {
            $cart = new Cart();
            $cart->setId($object['id']);
            $cart->setCartToken($object['cart_token']);
            $cart->setUserId($object['user_id']);
            $cart->cart_products = $this->getCartProducts($object['cart_token']);
            $this->elements[] = $cart;
        }
        return $this->elements;
    }

    public function getCart($object): Cart
    {
        $cart = new Cart();
        $cart->setId($object['id']);
        $cart->setCartToken($object['cart_token']);
        $cart->setUserId($object['user_id']);
        return $cart;
    }

    public function getIndexData()
    {
        //unset($_SESSION['cart_token']);
        $this->page->getMainContent('cart');
        if ($data = filter_input_array(INPUT_POST)) {
            if (isset($data['cart_token'])) {
                $update = [];
                $update['cart_token'] = $data['cart_token'];
                $update['product_id'] = $data['product_id'];
                $update['product_price'] = $data['product_price'];
                if (isset($data['increase'])) {
                    $update['amount'] = $data['amount'] + 1;
                }
                if (isset($data['decrease'])) {
                    if ($data['amount'] > 1) {
                        $update['amount'] = $data['amount'] - 1;
                    }
                }
                if ($cart_products_items = $this->getCartProductsItems($data['cart_token'])) {
                    if ($id = array_search($data['product_id'], array_column($cart_products_items, 'product_id', 'id'))) {
                        $update['id'] = $id;
                        $this->update($update, 'cart_product_items');
                    }
                }
                $this->cart_token = $update['cart_token'];
                if (isset($data['del_product'])) {
                    $this->delete($update, 'cart_product_items');
                    header('Location: /cart');
                }
                $this->cart_products = $this->getCartProducts($this->cart_token);
            }
            if (isset($data['email'])) {
                echo '<pre>';
                print_r($data);
                echo '</pre>';
            }
        }
        if ($this->user = (new Auth())->isAuth()) {
            if ($user_cart = $this->getUserCart($this->user->getId())) {
                $this->getCart($user_cart);
                $token = $user_cart['cart_token'];
            }
        }
        if (isset($token)) {
            $cart_token = $token;
        } else {
            $cart_token = Session::getSessionValue('cart_token');
        }
        if (isset($token) && $cart = $this->getCartByToken($cart_token)) {
            $cart['user_id'] = $this->user->getId();
            $this->update($cart, self::TABLE_NAME);
            $this->getCart($cart);
        }
        if ($cart_token) {
            $this->cart_token = $cart_token;
            $this->cart_products = $this->getCartProducts($cart_token);
            $cart = $this->getCartByToken($this->cart_token);
            $this->getCart($cart);
        }
        if (!$this->cart_products) {
            $this->page->getMainContent('cart_empty');
        }
    }

    public function getUserCart($user_id)
    {
        $query = "SELECT * FROM `" . self::TABLE_NAME . "` WHERE user_id = :user_id";
        if ($cart_data = $this->db->run($query, ['user_id' => $user_id])) {
            return $cart_data[0];
        }
        return false;
    }

    public function getCartByToken($cart_token)
    {
        $query = "SELECT * FROM `" . self::TABLE_NAME . "` WHERE cart_token = :cart_token";
        if ($cart_data = $this->db->run($query, ['cart_token' => $cart_token])) {
            return $cart_data[0];
        }
        return false;
    }

    public function getCartProductsItems($cart_token)
    {
        $query = "SELECT * FROM `cart_product_items` WHERE cart_token = :cart_token";
        if ($products_items = $this->db->run($query, ['cart_token' => $cart_token])) {
            return $products_items;
        }
        return false;
    }

    public function getCartProducts($cart_token)
    {
        if ($cart_products = $this->getCartProductsItems($cart_token)) {
            $productMapper = new ProductMapper();
            $products = [];
            foreach ($cart_products as $k => $row) {
                $products[$k]['product_price'] = $row['product_price'];
                $products[$k]['amount'] = $row['amount'];
                $products[$k]['product_summ'] = $row['amount'] * $row['product_price'];
                $products[$k]['product_id'] = $row['product_id'];
                $products[$k]['product'] = $productMapper->getProduct($row['product_id']);
            }
            return $products;
        }
        return false;
    }

    public function addToCart($posted_cart)
    {
        $user_id = null;
        if ($posted_cart) {
            if ($this->user = (new Auth())->isAuth()) {
                if ($user_cart = $this->getUserCart($this->user->getId())) {
                    $posted_cart['cart_token'] = $user_cart['cart_token'];
                }
            } elseif ($token = Session::getSessionValue('cart_token')) {
                $posted_cart['cart_token'] = $token;
            } else {
                $posted_cart['cart_token'] = uniqid('', true);
                Session::setSessionCookie(['cart_token' => $posted_cart['cart_token']]);
            }
            $posted_cart['id'] = null;
            if ($cart = $this->getCartByToken($posted_cart['cart_token'])) {
                $this->cart_token = $cart['cart_token'];
                if ($cart_product_items = $this->getCartProductsItems($this->cart_token)) {
                    if ($this->cart_products = $this->getCartProducts($this->cart_token)) {
                        if ($id = array_search($posted_cart['product_id'], array_column($cart_product_items, 'product_id', 'id'))) {
                            $posted_cart['id'] = $id;
                            $this->update($posted_cart, 'cart_product_items');
                        } else {
                            $this->insert($posted_cart, 'cart_product_items');
                        }
                    } else {
                        $this->insert($posted_cart, 'cart_product_items');
                    }
                } else {
                    $this->insert($posted_cart, 'cart_product_items');
                }
            } else {
                $this->cart_token = $posted_cart['cart_token'];
                $params = [
                    'id' => null,
                    'cart_token' => $this->cart_token,
                    'user_id' => $user_id
                ];
                $this->insert($params, self::TABLE_NAME);
                $this->insert($posted_cart, 'cart_product_items');
                $this->getCartProductsItems($this->cart_token);
                $this->cart_products = $this->getCartProducts($this->cart_token);
            }
        }
    }
}
