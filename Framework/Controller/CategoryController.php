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
        if (false !== $param){
            $model->data['main_content'] = $model->getProductsByCategoryId($param);
        }
        /* if ($query_data){
            $model->query_data = $query_data;
        } */
        $data = $model->data;
        (new CategoryView())->render($data);
    }

    /* public function actionAlias($alias): void
    {
        $model = new Shop();
        $data = $model->data;
        (new ShopView())->render($data);
    } */

    /* public function findAlias($alias): bool
    {
        return false;
    } */
}
