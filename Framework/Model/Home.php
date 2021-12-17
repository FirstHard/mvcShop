<?php

namespace Framework\Model;

use App\Model;
use Framework\Model\Product;

class Home extends Model
{
    //public $db;
    //public $data;
    public $data = [];

    public function __construct()
    {
        /* $this->db = new Db(); */
        $this->data['headers']['pageTitle'] = 'Shop';
        $this->data['headers']['siteTitle'] = 'Project MVC The Shop';
        $this->data['main_content'] = '';
        $this->data['newArrivalsProducts'] = Product::getProductsByList('new_arrivals_products');
        $this->data['topProducts'] = Product::getProductsByList('top_products');
        $this->data['recommendedProducts'] = Product::getProductsByList('recommended_products');
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
