<?php

namespace Framework\Model;

use App\Model;
use Framework\Core\Db;
use Framework\Model\Product;

class Category extends Model
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
        $this->data['headers']['pageTitle'] = 'Category';
        foreach ($list_data as $list) {
            if ($list['category_id'] == $id) {
                $products[] = (new Product)->getProductById($list['product_id']);
            }
        }
        if (isset($products)) {
            $this->data['main_content'] = $products;
            return $this->data;
        }
        return false;
    }

    public function getCategoryById($id)
    {
        extract(Db::getOne('shop_category', $id));
        $this->id = $id;
        $this->image_name = $image_name;
        $this->parent_id = $parent_id;
        $this->name = $name;
        $this->alias = $alias;
        $this->short_description = $short_description;
        $this->full_description = $full_description;
        return $this;
    }
}
