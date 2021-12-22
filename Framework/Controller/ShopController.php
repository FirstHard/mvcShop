<?php

namespace Framework\Controller;

use App\Controller;
use Framework\Model\Shop;
use Framework\View\ShopView;
use Framework\Model\Category;
use Framework\View\CategoryView;

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
