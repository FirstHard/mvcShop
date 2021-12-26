<?php

namespace Framework\Model;

use Framework\Core\Db;
use Framework\Core\Session;
use Framework\Model\Order;
use Framework\View\Pagination;

class OrderMapper
{
    protected $db;
    protected $elements;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function fetchCollection($objects)
    {
        foreach ($objects as $object) {
            $order = new Order();
            $order->setId($object['id']);
            $order->setOrderNumber($object['order_number']);
            $order->setUserId($object['user_id']);
            $order->setOrderTotal($object['total']);
            $order->setShippingMethodId($object['shipping_method_id']);
            $order->setPaymentMethodId($object['payment_method_id']);
            $order->setStatus($object['status']);
            $order->setCreatedAtDateTime($object['created_at']);
            $order->setModifiedAtDateTime($object['modified_at']);
            $order->setFinished($object['finished']);
            $order->setTrackNumber($object['track_number']);
            $order->setClientFirstName($object['client_first_name']);
            $order->setClientLastName($object['client_last_name']);
            $order->setClientMiddleName($object['client_middle_name']);
            $order->setClientPhoneNumber($object['client_phone_number']);
            $order->setClientEmail($object['client_email']);
            $order->setDeliveryPostcode($object['delivery_postcode']);
            $order->setDeliveryCountryId($object['delivery_country_id']);
            $order->setDeliveryRegionId($object['delivery_region_id']);
            $order->setDeliveryCityId($object['delivery_city_id']);
            $order->setDeliveryStreet($object['delivery_street']);
            $order->setDeliveryHouseNumber($object['delivery_house_number']);
            $order->setDeliveryAppartmentNumber($object['delivery_appartment_number']);
            $this->elements[] = $order;
        }
        return $this->elements;
    }

    public function getCountOrdersByUserId(int $user_id): int
    {
        $query = "SELECT COUNT(*) AS `count` FROM `order` WHERE `user_id` = :user_id";
        return $this->db->count($query, ['user_id' => $user_id]);
    }

    public function getOrdersByUserId(int $user_id, int $limit, int $offset, string $order): array|bool
    {
        if ($order == 'DESC') {
            $query = "SELECT * FROM `order` WHERE `user_id` = :user_id ORDER BY order_number DESC LIMIT :limit OFFSET :offset";
        } else {
            $query = "SELECT * FROM `order` WHERE `user_id` = :user_id ORDER BY order_number ASC LIMIT :limit OFFSET :offset";
        }
        $params = [
            'user_id' => $user_id,
            'offset' => $offset,
            'limit' => $limit
        ];
        $orders = $this->db->run($query, $params);
        return $this->fetchCollection($orders);
    }

    public function getUserOrdersBySearch($user_id, $search, $limit, $offset, $order): array|bool
    {
        if ($order == 'DESC') {
            $query = "SELECT * FROM `order` WHERE `user_id` = :user_id AND (order_number = :search OR created_at LIKE :search_date) ORDER BY order_number DESC LIMIT :limit OFFSET :offset";
        } else {
            $query = "SELECT * FROM `order` WHERE `user_id` = :user_id AND (order_number = :search OR created_at LIKE :search_date) ORDER BY order_number ASC LIMIT :limit OFFSET :offset";
        }
        $params = [
            'user_id' => $user_id,
            'search' => $search,
            'search_date' => '%' . $search . '%',
            'offset' => $offset,
            'limit' => $limit
        ];
        if ($orders = $this->db->run($query, $params)) {
            return $this->fetchCollection($orders);
        }
        return false;
    }

    public function getUserOrdersByDate($user_id, $created_at, $limit, $offset, $order): array|bool
    {
        if ($order == 'DESC') {
            $query = "SELECT * FROM `order` WHERE `user_id` = :user_id AND `created_at` LIKE :created_at ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
        } else {
            $query = "SELECT * FROM `order` WHERE `user_id` = :user_id AND `created_at` LIKE :created_at ORDER BY created_at ASC LIMIT :limit OFFSET :offset";
        }
        $params = [
            'user_id' => $user_id,
            'created_at' => '%' . $created_at . '%',
            'offset' => $offset,
            'limit' => $limit
        ];
        if ($orders = $this->db->run($query, $params)) {
            return  $this->fetchCollection($orders);
        }
        return false;
    }

    public function getSearchData($queries_data)
    {
        if (is_string($queries_data)) {
            parse_str($queries_data, $queries);
        }
        if (is_array($queries_data)) {
            $queries = $queries_data;
        }
        $user_id = 1; // Getting user ID from Auth...
        $offset = 0;
        $page = 1;
        $limit = 10;
        $order = 'ASC';
        $sort_by = 'order_number';
        $data['headers']['pageTitle'] = 'Search orders';
        $data['headers']['siteTitle'] = 'Project MVC The Shop';
        $data['total'] = 0;
        $data['sort_by'] = $sort_by;
        $data['order_by'] = $order;
        $data['show_by'] = $limit;
        $data['main_content'] = 'Nothing to show';
        if ($queries) {
            if (isset($queries['search'])) {
                $search = htmlspecialchars($queries['search']);
            }
            if ($data['main_content'] = $this->getUserOrdersBySearch($user_id, $search, $limit, $offset, $order)) {
                $data['total'] = sizeof($data['main_content']);
            }
            if ($data['total'] > $limit) {
                $data['pagination'] = new Pagination($data['total'], $page, $limit, 'page');
            }
        }
        return $data;
    }

    public function getIndexData($gets = []): array
    {
        $data['headers']['pageTitle'] = 'Orders';
        $data['headers']['siteTitle'] = 'Project MVC The Shop';
        $data['main_content'] = 'Nothing to show';
        $user_id = 1; // Getting user ID from Auth...
        $offset = 0;
        $page = 1;
        $orders_dates_from = false;
        if (Session::getSessionValue('show_by')) {
            $limit = (int) Session::getSessionValue('show_by');
        } else {
            $limit = 10;
        }
        if (Session::getSessionValue('order_by')) {
            $order = Session::getSessionValue('order_by');
        } else {
            $order = 'ASC';
        }
        if (Session::getSessionValue('sort_by')) {
            $sort_by = Session::getSessionValue('sort_by');
        } else {
            $sort_by = 'order_number';
        }
        if ($gets) {
            if (isset($gets['page'])) {
                $page = $gets['page'];
                $offset = $limit * ($page - 1);
            }
            if (isset($gets['show_by'])) {
                $limit = (int) $gets['show_by'];
                Session::setSessionCookie(['show_by' => $limit]);
            }
            if (isset($gets['orders_dates_from'])) {
                $orders_dates_from = str_replace('T00:00', ' ', htmlspecialchars($gets['orders_dates_from']));
            }
            if (isset($gets['order_by'])) {
                $order = $gets['order_by'];
                Session::setSessionCookie(['order_by' => $order]);
            }
            if (isset($gets['sort_by'])) {
                $sort_by = $gets['sort_by'];
                Session::setSessionCookie(['order_by' => $order]);
            }
        }
        $data['sort_by'] = $sort_by;
        $data['order_by'] = $order;
        $data['show_by'] = $limit;
        $data['page'] = $page;
        $data['total'] = $this->getCountOrdersByUserId($user_id);
        if ($orders_dates_from) {
            if ($data['main_content'] = $this->getUserOrdersByDate($user_id, $orders_dates_from, $limit, $offset, $order)) {
                $data['headers']['pageTitle'] = 'Orders from date';
                $data['total'] = sizeof($data['main_content']);
            }
        } else {
            $data['main_content'] = $this->getOrdersByUserId($user_id, $limit, $offset, $order);
        }
        if ($data['total'] > $limit) {
            $data['pagination'] = new Pagination($data['total'], $page, $limit, 'page');
        }
        return $data;
    }
}
