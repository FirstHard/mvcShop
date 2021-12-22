<?php

namespace Framework\Model;

use App\Model;
use Framework\Core\Db;
use Framework\Model\Product;

class Shop extends Model
{
    public $data = [];
    public $param = false;
    public $query_data = false;

    public function __construct()
    {
    }

    public static function getIndexData($queries, $gets)
    {
        $data['headers']['pageTitle'] = 'Shop';
        $data['headers']['siteTitle'] = 'Project MVC The Shop';
        $list_data = Db::getList('shop_category');
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
        $list_data = Db::getList('product_to_category');
        foreach ($list_data as $list) {
            if ($list['category_id'] === $id) {
                $products_list[] = $list['product_id'];
            }
        }
        if (isset($products_list)) {
            foreach ($products_list as $product_id) {
                $products[] = (new Product())->getProductById($product_id);
            }
            return $products;
        }
        return false;
    }
}
