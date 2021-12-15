<?php

namespace App\Model;

use App\Core\Db;
use App\Model\Product;

class Category
{
    public $data = [];
    public $param = false;
    public $query_data = false;

    public function __construct()
    {
        /* $this->db = new Db();  ... */
        $this->data['headers']['pageTitle'] = 'Shop';
        $this->data['headers']['siteTitle'] = 'Project MVC The Shop';
        $this->data['main_content'] = 'Welcome to our store!';
    }

    public function getProductsByCategoryId($id): bool|array 
    {
        $list_data = Db::getList('product_to_category');
        foreach ($list_data as $list) {
            if ($list['category_id'] == $id) {
                $products[] = (new Product)->getProductById($list['product_id']);
            }
        }
        if (isset($products)) {
            return $products;
        }
        return false;
    }
}
