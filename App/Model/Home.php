<?php

namespace App\Model;

use Framework\Model;
use App\Model\Product;
use App\Core\Fdb;

class Home extends Model
{
    public $data = [];

    public function __construct()
    {
        $this->data['main_content'] = '';
        $this->data['newArrivalsProducts'] = (new Product())->getProductsByList('new_arrivals_products');
        $this->data['topProducts'] = (new Product())->getProductsByList('top_products');
        $this->data['recommendedProducts'] = (new Product())->getProductsByList('recommended_products');
    }

    public function newArrivalsProducts()
    {
        return (new Product())->getProductsByList('new_arrivals_products');
    }

    public function topProducts()
    {
        return (new Product())->getProductsByList('top_products');
    }

    public function recommendedProducts()
    {
        return (new Product())->getProductsByList('recommended_products');
    }
}
