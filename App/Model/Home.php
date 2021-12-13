<?php

namespace App\Model;

use App\Core\Db;

use App\Model\Product;

class Home
{
    //public $db;
    //public $data;

    public function __construct()
    {
        /* $this->db = new Db(); */
    }

    public function newArrivalsProducts()
    {
        return Product::getProductsByList('new_arrivals_products');
    }

    public function topProducts()
    {
        return Product::getProductsByList('top_products');
    }

    public function recommendedProducts()
    {
        return Product::getProductsByList('recommended_products');
    }
}
