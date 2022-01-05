<?php

namespace App\Model;

use App\Core\Session;
use App\Model\Product;
use App\View\Pagination;
use Framework\DataMapper;

class ProductMapper extends DataMapper
{

    protected $elements;
    protected const TABLE_NAME = 'product';
    public $main_content = 'Nothing to show';
    public $offset = 0;
    public $page = 1;
    public $limit = 10;
    public $order_by = 'ASC';
    public $sort_by = 'name';
    public $total = 0;
    public $search = false;
    public $queries = false;
    public $pagination = false;

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
            $product->setNewPrice($object['new_price']);
            $product->setPrice($object['price']);
            $product->setPublished($object['published']);
            $product->setShopArticule($object['shop_articule']);
            $product->setShortDescription($object['short_description']);
            $this->elements[] = $product;
        }
        return $this->elements;
    }

    public function getByList(string $list_name): bool|array
    {
        $list_data = $this->fdb->getInstance($list_name)->getList();
        foreach ($list_data as $product_id) {
            $products[] = $this->getById(self::TABLE_NAME, $product_id);
        }
        if (isset($products)) {
            return $this->fetchCollection($products);
        }
        return false;
    }

    public function getIndexData($gets = []): array
    {
        $data['main_content'] = $this->getAll(self::TABLE_NAME);
        /* $this->setSessionVars();
        if ($gets) $this->getRequestsData($gets);
        $data['main_content'] = $this->main_content;
        $data['sort_by'] = $this->sort_by;
        $data['order_by'] = $this->order;
        $data['show_by'] = $this->limit;
        $data['page'] = $this->page;
        $data['total'] = $this->getCountOrdersByUserId($this->user_id);
        if ($this->orders_dates_from) {
            if ($data['main_content'] = $this->getUserOrdersByDate($this->user_id, $this->orders_dates_from, $this->limit, $this->offset, $this->order)) {
                $data['total'] = sizeof($data['main_content']);
            }
        } else {
            $data['main_content'] = $this->getOrdersByUserId($this->user_id, $this->limit, $this->offset, $this->order);
        }
        if ($data['total'] > $this->limit) $data['pagination'] = new Pagination($data['total'], $this->page, $this->limit); */
        return $data;
    }
}