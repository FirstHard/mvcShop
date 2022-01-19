<?php

namespace App\Model;

use App\Model\Product;
use App\View\Pagination;
use Framework\DataMapper;

class ProductMapper extends DataMapper
{
    protected const TABLE_NAME = 'product';
    public $products;
    public $products_offset = 0;
    public $products_page = 1;
    public $products_limit = 10;
    public $order_by;
    public $sort_by = 'name';
    public $products_total = 0;
    public $products_search = false;
    public $queries = false;
    public $pagination = false;
    public $main_data;

    public function fetchCollection($objects)
    {
        foreach ($objects as $object) {
            $product = new Product();
            $product->setId($object['id']);
            $product->setAlias($object['alias']);
            $product->setAvailability($object['availability']);
            $product->setAverageRating($object['average_rating']);
            $product->setBrandId($object['brand_id']);
            $product->setDateAdded($object['date_added']);
            $product->setDateModify($object['date_modify']);
            $product->setFullDescription($object['full_description']);
            $product->setImageName($object['image_name']);
            $product->setLabelId($object['label_id']);
            $product->setManufacturerEan($object['manufacturer_ean']);
            $product->setName($object['name']);
            $product->setNewPrice((int) $object['new_price']);
            $product->setPrice((int) $object['price']);
            $product->setPublished($object['published']);
            $product->setShopArticule($object['shop_articule']);
            $product->setShortDescription($object['short_description']);
            $this->products[] = $product;
        }
        return $this->products;
    }

    public function getProduct($id)
    {
        $object = $this->getById(self::TABLE_NAME, $id);
        $product = new Product();
        $product->setId($object['id']);
        $product->setAlias($object['alias']);
        $product->setAvailability($object['availability']);
        $product->setAverageRating($object['average_rating']);
        $product->setBrandId($object['brand_id']);
        $product->setDateAdded($object['date_added']);
        $product->setDateModify($object['date_modify']);
        $product->setFullDescription($object['full_description']);
        $product->setImageName($object['image_name']);
        $product->setLabelId($object['label_id']);
        $product->setManufacturerEan($object['manufacturer_ean']);
        $product->setName($object['name']);
        $product->setNewPrice((int) $object['new_price']);
        $product->setPrice((int) $object['price']);
        $product->setPublished($object['published']);
        $product->setShopArticule($object['shop_articule']);
        $product->setShortDescription($object['short_description']);
        return $product;
    }

    public function getProductById($id)
    {
        if ($this->main_data = $this->getProduct($id)) {
            return $this->main_data;
        }
        return false;
    }

    public function getByList(string $list_name)
    {
        $list_data = $this->getList($list_name);
        foreach ($list_data as $row) {
            $products[] = $this->getProduct($row['product_id']);
        }
        if (isset($products)) {
            return $products;
        }
        return false;
    }

    public function getIndexData()
    {
        $this->fetchCollection($this->getAll(self::TABLE_NAME));
        $this->products_total = sizeof($this->products);
        if ($this->products_total > $this->products_limit) {
            $this->pagination = new Pagination($this->products_total, $this->products_page, $this->products_limit);
        }
        $this->page->getMainContent('list_products');
    }
}
