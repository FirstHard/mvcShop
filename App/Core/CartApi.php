<?php

namespace App\Core;

use Framework\Api;

class CartApi extends Api
{
    public $apiName = 'cart';
    public $cart_products;
    public $cart_token;
    public $total = 0;
    public $main_data;
    public $user;

    public function actionIndex()
    {
        /* if (isset($this->requestParams['page'])) {
            $this->page = (int) $this->requestParams['page'];
            $this->offset = $this->limit * ($this->page - 1);
        }; */
        $cart = $this->cart->getIndexData();
        /* if ($cart) {
            $data['products'] = $products;
            $total = (new CartMapper())->getCountAll('product');
            if ($this->total < $total) { // Only for demo!
                $data['pagination'] = (new Pagination($total, $this->page, $this->limit))->get();
            }
            return $this->response($data, 200);
        }
        return $this->response('Data not found', 404); */
        return $this->response($cart, 200);
    }

    public function actionView()
    {
        // Id must be the first parameter after /product/x
        /* $id = $this->param;

        if ($id) {
            $product = (new CartMapper())->getById($this->apiName, $id);
            if ($product) {
                return $this->response($product, 200);
            }
        }
        return $this->response('Data not found', 404); */
    }

    public function actionCreate()
    {
    }

    public function actionUpdate()
    {
    }

    public function actionDelete()
    {
    }
}
