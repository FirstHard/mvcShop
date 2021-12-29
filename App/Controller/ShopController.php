<?php

namespace App\Controller;

use App\Model\Shop;
use App\View\ShopView;
use App\Model\Category;
use App\View\CategoryView;
use Framework\Controller;

class ShopController extends Controller
{
    public function actionIndex(): void
    {
        $data = Shop::getIndexData($this->queries, $this->gets);
        (new ShopView())->render($data);
    }

    public function actionCategory(): void
    {
        $data = (new Category())->getProductsByCategoryId($this->param);
        (new CategoryView())->render($data);
    }
}
