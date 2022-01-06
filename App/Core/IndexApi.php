<?php

namespace App\Core;

use App\Model\Product;
use App\Model\ProductMapper;

class IndexApi extends Api
{
    public $apiName = 'index';
    public $param;

    public function actionIndex()
    {
        /* $products = (new ProductMapper())->getAll('product');
        if($products){
            return $this->response($products, 200);
        } */
        return $this->response(['Connection established. Awaiting your requests.'], 200);
    }

    public function actionView()
    {
        /* $this->apiName = 'view';
        // id must be the first parameter after / product / x
        $id = array_shift($this->requestUri);

        if($id){
            $product = (new ProductMapper())->getById($this->apiName, $id);
            if($product){
                return $this->response($product, 200);
            }
        }
        return $this->response('Data not found', 404); */
    }

    /* public function viewAction()
    {
        $this->apiName = 'view';
        // id must be the first parameter after / product / x
        $id = array_shift($this->requestUri);

        if($id){
            $product = (new ProductMapper())->getById($this->apiName, $id);
            if($product){
                return $this->response($product, 200);
            }
        }
        return $this->response('Data not found', 404);
    } */

    public function createAction()
    {
        /* $name = $this->requestParams['name'] ?? '';
        $email = $this->requestParams['email'] ?? '';
        if($name && $email){
            $db = Db::getInstance();
            $product = new Product($db, [
                'name' => $name,
                'email' => $email
            ]);
            if($product = $product->saveNew()){
                return $this->response('Data saved.', 200);
            }
        }
        return $this->response("Saving error", 500); */
    }

    public function updateAction()
    {
        /* $parse_url = parse_url($this->requestUri[0]);
        $productId = $parse_url['path'] ?? null;

        $db = Db::getInstance();

        if(!$productId || !(new ProductMapper())->getById($this->apiName, $productId)){
            return $this->response("Product with id=$productId not found", 404);
        }

        $name = $this->requestParams['name'] ?? '';
        $email = $this->requestParams['email'] ?? '';

        if($name && $email){
            if($product = (new ProductMapper())->update($db, $productId, $name, $email)){
                return $this->response('Data updated.', 200);
            }
        }
        return $this->response("Update error", 400); */
    }

    public function deleteAction()
    {
        /* $parse_url = parse_url($this->requestUri[0]);
        $productId = $parse_url['path'] ?? null;

        $db = Db::getInstance();

        if(!$productId || !(new ProductMapper())->getById($this->apiName, $productId)){
            return $this->response("Product with id=$productId not found", 404);
        }
        if((new ProductMapper())->deleteById($db, $productId)){
            return $this->response('Data deleted.', 200);
        }
        return $this->response("Delete error", 500); */
    }
}