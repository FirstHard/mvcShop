<?php

namespace App\Model;

use Framework\Model;
use App\Core\Db;
use App\Core\Fdb;
use App\Model\Product;

class Shop extends Model
{
    public $data = [];
    public $param = false;
    public $queries = false;
    public $gets = false;
    protected $fdb;

    public function __construct()
    {
        $this->fdb = Fdb::getInstance('');
    }

    public function getIndexData()
    {
        $list_data = $this->fdb->getInstance('shop_category')->getList();
        if ($list_data) {
            foreach ($list_data as $category) {
                $id = $category['id'];
                $categories[] = (new Category())->getCategoryById($id);
            }
            $data['main_content'] = $categories;
            return $data;
        }
        return false;
    }

    public function getProductsByCategoryId($id): bool|array
    {
        $list_data = $this->fdb->getInstance('product_to_category')->getList();
        foreach ($list_data as $list) {
            if ($list['category_id'] === $id) {
                $products_list[] = $list['product_id'];
            }
        }
        if (isset($products_list)) {
            foreach ($products_list as $product_id) {
                $products[] = (new ProductMapper())->getById('product', $product_id);
            }
            return $products;
        }
        return false;
    }
}
