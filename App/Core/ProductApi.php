<?php

namespace App\Core;

use App\Model\Product;
use App\Model\ProductMapper;
use App\View\Pagination;
use App\View\ApiPagination;

class ProductApi extends Api
{
    public $apiName = 'product';
    public $param;
    public $total = 0;
    public $page = 1;
    public $limit = 12;

    public function actionIndex()
    {
        $products = (new ProductMapper())->getAll('product');
        if ($products) {
            $data['products'] = $products;
            $total = (new ProductMapper())->getCountProducts();
            if ($this->total < $total)
                $data['pagination'] = (new Pagination($total, $this->page, $this->limit))->get();
            return $this->response($data, 200);
        }
        return $this->response('Data not found', 404);
    }

    public function actionView()
    {
        // id must be the first parameter after / product / x
        $id = $this->param;

        if ($id) {
            $product = (new ProductMapper())->getById($this->apiName, $id);
            if ($product) {
                return $this->response($product, 200);
            }
        }
        return $this->response('Data not found', 404);
    }

    public function actionCreate()
    {
        /* $name = $this->requestParams['name'] ?? '';
        $email = $this->requestParams['email'] ?? '';
        if ($name && $email) {
            $db = Db::getInstance();
            $product = new Product($db, [
                'name' => $name,
                'email' => $email
            ]);
            if($product = $product->saveNew()) {
                return $this->response('Data saved.', 200);
            }
        }
        return $this->response("Saving error", 500); */
    }

    public function actionUpdate()
    {
        /* $parse_url = parse_url($this->requestUri[0]);
        $productId = $parse_url['path'] ?? null;

        $db = Db::getInstance();

        if (!$productId || !(new ProductMapper())->getById($this->apiName, $productId)) {
            return $this->response("Product with id=$productId not found", 404);
        }

        $name = $this->requestParams['name'] ?? '';
        $email = $this->requestParams['email'] ?? '';

        if ($name && $email) {
            if ($product = (new ProductMapper())->update($db, $productId, $name, $email)) {
                return $this->response('Data updated.', 200);
            }
        }
        return $this->response("Update error", 400); */
    }

    public function actionDelete()
    {
        /* $parse_url = parse_url($this->requestUri[0]);
        $productId = $parse_url['path'] ?? null;

        $db = Db::getInstance();

        if (!$productId || !(new ProductMapper())->getById($this->apiName, $productId)) {
            return $this->response("Product with id=$productId not found", 404);
        }
        if ((new ProductMapper())->deleteById($db, $productId)) {
            return $this->response('Data deleted.', 200);
        }
        return $this->response("Delete error", 500); */
    }
}
