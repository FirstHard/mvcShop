<?php

namespace Framework\Controller;

use App\Controller;
use Framework\Model\Category;
use Framework\View\CategoryView;

class CategoryController extends Controller
{
    public function actionIndex($param = false, $query_data = false): void
    {
        $model = new Category();
        $data = $model->data;
        $model->data['headers']['pageTitle'] = 'Category';
        (new CategoryView())->render($data);
    }

    public function actionCategory($param = false, $query_data = false): void
    {
        $model = new Category();
        if (false !== $param) {
            $model->data['main_content'] = $model->getProductsByCategoryId($param);
        }
        $data = $model->data;
        (new CategoryView())->render($data);
    }
}
