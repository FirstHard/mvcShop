<?php

namespace App\Controller;

use App\Model\ProductMapper;
use App\View\ProductView;
use Framework\Controller;

class ProductController extends Controller
{
    public function actionIndex(): void
    {
        $data = (new ProductMapper())->getIndexData($this->gets);
        (new ProductView())->render($data);
    }
}
