<?php

namespace App\Core;

use App\Model\ProductMapper;
use App\View\Pagination;

class ProductApi extends Api
{
    public $apiName = 'product';
    public $param;
    public $total = 0;
    public $page = 1;
    public $limit = 12;
    public $offset = 0;
    public $order = 'ASC';

    public function actionIndex()
    {
        if (isset($this->requestParams['page'])) {
            $this->page = (int) $this->requestParams['page'];
            $this->offset = $this->limit * ($this->page - 1);
        };
        $products = (new ProductMapper())->getAll('product', 'date_added', 'ASC', $this->offset, $this->limit);
        if ($products) {
            $data['products'] = $products;
            $total = (new ProductMapper())->getCountProducts();
            if ($this->total < $total) {
                $data['pagination'] = (new Pagination($total, $this->page, $this->limit))->get();
            }
            return $this->response($data, 200);
        }
        return $this->response('Data not found', 404);
    }

    public function actionView()
    {
        // Id must be the first parameter after /product/x
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
    }

    public function actionUpdate()
    {
    }

    public function actionDelete()
    {
    }
}
