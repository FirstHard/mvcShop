<?php

namespace App\Controller;

use App\View\ShopView;
use App\Model\ShopCategoryMapper;
use App\View\ShopCategoryView;
use Framework\Controller;

class ShopController extends Controller
{

    public function __construct()
    {
        $this->mapper = new ShopCategoryMapper();
    }

    public function actionIndex(): void
    {
        $this->mapper->getIndexData();
        (new ShopView())->render($this->mapper);
    }

    public function actionCategory(): void
    {
        if (!isset($this->param)) {
            header('Location: /shop');
        }
        $this->mapper->getProductsByCategoryId($this->param);
        (new ShopCategoryView())->render($this->mapper);
    }
}
