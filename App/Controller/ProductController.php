<?php

namespace App\Controller;

use App\Model\ProductMapper;
use App\View\ProductView;
use Framework\Controller;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->mapper = new ProductMapper();
    }

    public function actionIndex(): void
    {
        $this->mapper->getIndexData($this->gets);
        (new ProductView())->render($this->mapper);
    }

    public function actionView(): void
    {
        $this->mapper->getProductById($this->param, $this->gets, $this->queries);
        (new ProductView())->renderOne($this->mapper);
    }
}
