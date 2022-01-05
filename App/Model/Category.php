<?php

namespace App\Model;

use Framework\Model;
use App\Core\Fdb;
use App\Model\Product;

class Category extends Model
{
    public $data = [];
    public $param = false;
    public $query_data = false;
    protected $fdb;

    public function __construct()
    {
        $this->fdb = Fdb::getInstance('');
    }

    public function getProductsByCategoryId($id): bool|array
    {
        $list_data = $this->fdb->getInstance('product_to_category')->getList();
        foreach ($list_data as $list) {
            if ($list['category_id'] == $id) {
                $products[] = (new ProductMapper())->getById('product', $list['product_id']);
            }
        }
        if (isset($products)) {
            return (new ProductMapper())->fetchCollection($products);
        }
        return false;
    }

    public function getCategoryById($id): Category
    {
        extract($this->fdb->getInstance('shop_category')->getOne($id));
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
