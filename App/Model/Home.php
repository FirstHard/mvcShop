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
        $this->data['newArrivalsProducts'] = (new ProductMapper())->getByList('new_arrivals_products');
        $this->data['topProducts'] = (new ProductMapper())->getByList('top_products');
        $this->data['recommendedProducts'] = (new ProductMapper())->getByList('recommended_products');
    }

    public function newArrivalsProducts()
    {
        return (new ProductMapper())->getByList('new_arrivals_products');
    }

    public function topProducts()
    {
        return (new ProductMapper())->getByList('top_products');
    }

    public function recommendedProducts()
    {
        return (new ProductMapper())->getByList('recommended_products');
    }
}
