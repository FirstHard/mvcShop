<?php

namespace App\Model;

use Framework\Model;

class Home extends Model
{
    protected $productMapper;
    public $newArrivalsProducts;
    public $topProducts;
    public $recommendedProducts;

    public function __construct()
    {
        $this->productMapper = new ProductMapper();
        $this->page = new Page();
    }

    public function getData()
    {
        $this->newArrivalsProducts = $this->productMapper->getByList('new_arrivals_products');
        $this->topProducts = $this->productMapper->getByList('top_products');
        $this->recommendedProducts = $this->productMapper->getByList('recommended_products');
        $this->page->getMainContent('home');
    }
}
