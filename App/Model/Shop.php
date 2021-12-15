<?php

namespace App\Model;

use App\Core\Db;
use App\Model\Product;

class Shop
{
    public $data = [];
    public $param = false;
    public $query_data = false;

    public function __construct()
    {
        $this->data['headers']['pageTitle'] = 'Shop';
        $this->data['headers']['siteTitle'] = 'Project MVC The Shop';
        $this->data['main_content'] = 'Welcome to our store!';
    }

    public function getProductsIdByCategoryId($id)
    {
        $list_data = Db::getList('product_to_category');
        foreach ($list_data as $list) {
            if ($list['category_id'] == $id) {
                $products[] = (new Product)->getProductById($list['product_id']);
            }
        }
        if (isset($products)) {
            $this->data['main_content'] = $products;
        }
    }
}
