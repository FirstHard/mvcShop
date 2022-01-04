<?php

namespace App\Model;

use Framework\Model;
use App\Core\Db;
use App\Core\Fdb;

class Product extends Model
{
    public $id;
    public $articule;
    public $product_date_added;
    public $date_modify;
    public $product_price;
    public $min_price;
    public $image;
    public $product_manufacturer_id;
    public $hits;
    public $name;
    public $alias;
    public $short_description;
    public $description;
    protected $fdb;

    public function __construct()
    {
        $this->fdb = Fdb::getInstance('');
    }

    public function getProductsByList(string $list_name): bool|array
    {
        $list_data = $this->fdb->getInstance($list_name)->getList();
        foreach ($list_data as $product_id) {
            $products[] = (new Product)->getProductById($product_id);
        }
        if (isset($products)) {
            return $products;
        }
        return false;
    }

    public function getProductById(int $id): Product
    {
        extract($this->fdb->getInstance('products')->getOne($id));
        $this->id = $id;
        $this->articule = $articule;
        $this->product_date_added = $product_date_added;
        $this->date_modify = $date_modify;
        $this->product_price = $product_price;
        $this->min_price = $min_price;
        $this->image = $image;
        $this->product_manufacturer_id = $product_manufacturer_id;
        $this->hits = $hits;
        $this->name = $name;
        $this->alias = $alias;
        $this->short_description = $short_description;
        $this->description = $description;
        return $this;
    }
}
