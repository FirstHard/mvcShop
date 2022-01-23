<?php

namespace App\Model;

use App\Core\Auth;
use App\Core\Session;
use App\Model\ProductMapper;
use Framework\DataMapper;
use FirstHard\LogsHandler;

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
            if ($this->cart_products = $this->getCartProducts($cart_token)) {
                $cart = $this->getCartByToken($this->cart_token);
                $this->getCart($cart);
            }
        }
        if (!$this->cart_products) {
            $this->page->getMainContent('cart_empty');
        }
        return $this;
    }

    public function checkoutSuccess()
    {
        $this->page->getMainContent('checkout_success');
        $this->main_data = $this->page->message;
    }

    public function checkoutFailed()
    {
        $this->page->getMainContent('checkout_failed');
        $this->main_data = $this->page->message;
    }

    public function getCheckoutData($cart_token)
    {
        $this->page->getMainContent('checkout');
        $data = filter_input_array(INPUT_POST);
        if ($cart_token && $data) {
            $this->getCartProducts($cart_token);
            $cart_products_items = $this->getCartProductsItems($cart_token);
            $new_order = [];
            $items_to_email = [];
            if ($user = (new UserMapper())->isExist($data)) {
                $new_order['user_id'] = $user->getId();
            } else {
                $new_order['user_id'] = (new UserMapper())->getNextUserId();
                $location = 'Location: /cart/success/';
                (new Auth())->registration($data, $location);
            }
            $order = (new OrderMapper());
            $new_order['id'] = null;
            $new_order['order_number'] = $order->getNextOrderNumber();
            $new_order['total'] = (int) $this->total;
            $new_order['shipping_method_id'] = 1;
            $new_order['payment_method_id'] = 1;
            $new_order['status'] = 1;
            $new_order['created_at'] = date("Y-m-d H:i:s");
            $new_order['modified_at'] = date("Y-m-d H:i:s");
            $new_order['finished'] = 1;
            $new_order['track_number'] = str_pad(random_int(1, 9999999999999999), 16, 0, STR_PAD_LEFT);
            $new_order['client_first_name'] = $data['first_name'];
            $new_order['client_last_name'] = $data['last_name'];
            $new_order['client_middle_name'] = $data['middle_name'];
            $new_order['client_phone_number'] = $data['phone_number'];
            $new_order['client_email'] = $data['email'];
            $new_order['delivery_postcode'] = $data['postcode'];
            $new_order['delivery_country'] = 'USA';
            $new_order['delivery_state'] = $data['state'];
            $new_order['delivery_city'] = $data['city'];
            $new_order['delivery_street'] = $data['street'];
            $new_order['delivery_house_number'] = $data['house_number'];
            $new_order['delivery_apartment_number'] = $data['apartment_number'];
            $order->insert($new_order, 'order');
            foreach ($cart_products_items as $item) {
                $new_product_to_order['product_id'] = $item['product_id'];
                $new_product_to_order['order_number'] = $new_order['order_number'];
                $new_product_to_order['product_price'] = $item['product_price'];
                $new_product_to_order['amount'] = $item['amount'];
                $this->insert($new_product_to_order, 'products_to_orders');
                $items_to_email[] = $new_product_to_order;
            }
            if ($this->sentCheckout($new_order, $items_to_email)) {
                $cart_id = $this->getCart($this->getCartByToken($cart_token))->getId();
                $this->delete(['id' => $cart_id], 'cart');
                foreach ($cart_products_items as $item) {
                    $params = ['id' => $item['id']];
                    $this->delete($params, 'cart_product_items');
                }
                header('Location: /cart/success/');
            } else {
                header('Location: /cart/failed/');
            }
        } else {
            header('Location: /cart');
        }
    }

    public function sentCheckout($new_order, $items_to_email)
    {
        $to = $new_order['client_first_name'] . " " . $new_order['client_last_name'] . " <" . $new_order['client_email'] . ">";
        $subject = "Your new order on our website MvcShop, No. " . $new_order['order_number'] . "!";
        $message = '
        <html>
            <head>
                <title>Thank you for your order!</title>
                <style>
                    th, td { border: 1px; border-color: black; }
                </style>
            </head>
            <body>
                <h2>Hello! Read the details of your order, No. ' . $new_order['order_number'] . '</h2>
                <h4>Created: ' . date("Y-m-d H:i") . '</h4>
                <h5>Delivery and billing to:</h5>
                <p>
                    <b>Name:</b> ' . $new_order['client_first_name'] . '<br>
                    <b>Last name:</b> ' . $new_order['client_last_name'] . '<br>
                    <b>Track Number:</b> ' . $new_order['track_number'] . '<br>
                    <b>Phone number:</b> ' . $new_order['client_phone_number'] . '<br>
                    <b>Zip:</b> ' . $new_order['delivery_postcode'] . '<br>
                    <b>State:</b> ' . $new_order['delivery_state'] . '<br>
                    <b>City:</b> ' . $new_order['delivery_city'] . '<br>
                    <b>Street:</b> ' . $new_order['delivery_street'] . '<br>
                    <b>House number:</b> ' . $new_order['delivery_house_number'] . '<br>
                    <b>APT:</b> ' . $new_order['delivery_apartment_number'] . '<br>
                </p>
                <h5>Products in Order:</h5>
                <table border="1" cellpadding="6px;">
                    <thead>
                        <tr>
                            <th>Product name:</th>
                            <th>Amount:</th>
                            <th>Product price:</th>
                            <th>Sum:</th>
                        </tr>
                    </thead>
                    <tbody>
        ';
        foreach ($items_to_email as $item) {
        $message .= '
                        <tr>
                            <td>' . (new ProductMapper())->getProduct($item["product_id"])->getName() . '</td>
                            <td>' . $item["amount"] . ' pcs.</td>
                            <td>$ ' . $item["product_price"] . '</td>
                            <td>$ ' . $item["amount"] * $item["product_price"] . '</td>
                        </tr>
        ';
        }
        $message .= '
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td style="text-align: right;"><b>Total:</b> </td>
                            <td style="text-align: right;">$ ' . $new_order['total'] . '</td>
                        </tr>
                    </tfoot>
                </table>
                <small>Please do not reply to this email - it was generated automatically.</small>
            </body>
        </html>';
        $headers = "Content-type: text/html; charset=utf-8 \r\n" .
            'Reply-To: root@staging.buinoff.tk' . "\r\n" .
            'X-Mailer: PHP/' . phpversion() . "\r\n" .
            'MIME-Version: 1.0' . "\r\n";
        $headers .= "From: Admin <root@staging.buinoff.tk>\r\n";
        if (mail($to, $subject, $message, $headers)) {
            return true;
        } else {
            LogsHandler::debug(0, ['Message' => 'Can`t sent email to user from registration page!', 'email' => $new_order['client_email']]);
        }
        return false;
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
            $total = 0;
            foreach ($cart_products as $k => $row) {
                $products[$k]['product_price'] = $row['product_price'];
                $products[$k]['amount'] = $row['amount'];
                $products[$k]['product_summ'] = $row['amount'] * $row['product_price'];
                $products[$k]['product_id'] = $row['product_id'];
                $products[$k]['product'] = $productMapper->getProduct($row['product_id']);
                $total += $products[$k]['product_summ'];
            }
            $this->total = $total;
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
                $user_id = $this->user->getId();
            } elseif ($token = Session::getSessionValue('cart_token')) {
                $posted_cart['cart_token'] = $token;
            } else {
                $posted_cart['cart_token'] = uniqid('', true);
                Session::setSessionCookie(['cart_token' => $posted_cart['cart_token']]);
            }
            $posted_cart['id'] = null;
            if (!isset($posted_cart['cart_token'])) {
                $posted_cart['cart_token'] = uniqid('', true);
            }
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
