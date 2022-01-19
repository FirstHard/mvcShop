<?php

namespace App\Model;

use Framework\Model;
use App\Model\Product;
use App\Core\Fdb;

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

    /* public function newArrivalsProducts()
    {
        return $this->productMapper->getByList('new_arrivals_products');
    }

    public function topProducts()
    {
        return $this->productMapper->getByList('top_products');
    }

    public function recommendedProducts()
    {
        return $this->productMapper->getByList('recommended_products');
    } */
}
