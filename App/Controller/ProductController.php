<?php

namespace App\Controller;

use Framework\Controller;

class ProductController extends Controller
{
    public function actionIndex(): void
    {
        echo 'Product Page';
    }
}
