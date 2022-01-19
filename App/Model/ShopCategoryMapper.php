<?php

namespace App\Model;

use App\Core\Session;
use App\Model\ShopCategory;
use App\View\Pagination;
use Framework\DataMapper;

class ShopCategoryMapper extends DataMapper
{

    protected $elements;
    protected const TABLE_NAME = 'shop_category';
    public $products_offset = 0;
    public $products_page = 1;
    public $products_limit = 10;
    public $products_total = 0;
    public $products_search = false;
    public $main_data;
    public $order_by = 'ASC';
    public $sort_by = 'name';
    public $search = false;
    public $queries = false;
    public $pagination = false;

    public function fetchCollection($objects)
    {
        foreach ($objects as $object) {
            $category = new ShopCategory();
            $category->setId($object['id']);
            $category->setName($object['name']);
            $category->setAlias($object['alias']);
            $category->setParentId($object['parent_id']);
            $category->setShortDescription($object['short_description']);
            $category->setFullDescription($object['full_description']);
            $category->setImageName($object['image_name']);
            $this->elements[] = $category;
        }
        return $this->elements;
    }

    public function getCategoryById($id)
    {
        $object = $this->getById(self::TABLE_NAME, $id);
        $category = new ShopCategory();
        $category->setId($object['id']);
        $category->setName($object['name']);
        $category->setAlias($object['alias']);
        $category->setParentId($object['parent_id']);
        $category->setShortDescription($object['short_description']);
        $category->setFullDescription($object['full_description']);
        $category->setImageName($object['image_name']);
        return $category;
    }

    public function getProductsByCategoryId($id)
    {
        $list_data = $this->getList('product_to_category');
        foreach ($list_data as $list) {
            if ($list['category_id'] == $id) {
                $products[] = $this->getById('product', $list['product_id']);
            }
        }
        if (isset($products)) {
            $this->products = (new ProductMapper())->fetchCollection($products);
        }
        $this->products_total = sizeof($this->products);
        if ($this->products_total > $this->products_limit) {
            $this->pagination = new Pagination($this->products_total, $this->products_page, $this->products_limit);
        }
        $this->page->getMainContent('list_products');
    }

    public function getByList(string $list)
    {
        $list_data = $this->getList($list);
        foreach ($list_data as $category_id) {
            $categories[] = $this->getById(self::TABLE_NAME, $category_id);
        }
        if (isset($products)) {
            return $this->fetchCollection($categories);
        }
        return false;
    }

    public function getIndexData()
    {
        $this->page->getMainContent('shop');
        $this->main_data = $this->fetchCollection($this->getAll(self::TABLE_NAME));
    }
}
