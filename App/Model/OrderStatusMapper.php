<?php

namespace App\Model;

use Framework\DataMapper;

class OrderStatusMapper extends DataMapper
{
    protected $elements;
    protected const TABLE_NAME = 'order_status';

    public function fetchCollection($objects)
    {
        foreach ($objects as $object) {
            $order_status = new OrderStatus();
            $order_status->setId($object['id']);
            $order_status->setName($object['name']);
            $this->elements[] = $order_status;
        }
        return $this->elements;
    }

    public function getNameById(int $id): string
    {
        $query = "SELECT `name` FROM " . self::TABLE_NAME . " WHERE id = :id";
        return $this->db->run($query, ['id' => $id])[0]['name'];
    }
}
