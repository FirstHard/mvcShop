<?php

namespace App\Model;

use App\Core\Session;
use App\Model\Order;
use App\View\Pagination;
use Framework\DataMapper;

class OrderMapper extends DataMapper
{
    protected $elements;
    public $main_content = 'Nothing to show';
    public $orders_dates_from = false;
    public $user_id = 1; // Getting user ID from Auth...
    public $offset = 0;
    public $page = 1;
    public $limit = 10;
    public $order = 'ASC';
    public $sort_by = 'order_number';
    public $total = 0;
    public $search = false;
    public $queries = false;
    public $pagination = false;

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
        if ($orders = $this->db->run($query, $params)) return $this->fetchCollection($orders);
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
        if ($orders = $this->db->run($query, $params)) return  $this->fetchCollection($orders);
        return false;
    }

    public function getSearchData($queries_data): array
    {
        if (is_string($queries_data)) parse_str($queries_data, $this->queries);
        if (is_array($queries_data)) $this->queries = $queries_data;
        if ($this->queries) $this->getQueriesData($this->queries);
        $data['sort_by'] = $this->sort_by;
        $data['order_by'] = $this->order;
        $data['show_by'] = $this->limit;
        $data['main_content'] = $this->main_content;
        $data['total'] = $this->total;
        $data['pagination'] = $this->pagination;
        return $data;
    }

    public function getQueriesData($queries): void
    {
        if (isset($queries['search'])) $this->search = htmlspecialchars($queries['search']);
        if ($this->main_content = $this->getUserOrdersBySearch($this->user_id, $this->search, $this->limit, $this->offset, $this->order)) {
            $this->total = sizeof($this->main_content);
        }
        if ($this->total > $this->limit) $this->pagination = new Pagination($this->total, $this->page, $this->limit);
    }

    public function setSessionVars(): void
    {
        if (Session::getSessionValue('show_by')) $this->limit = (int) Session::getSessionValue('show_by');
        if (Session::getSessionValue('order_by')) $this->order = Session::getSessionValue('order_by');
        if (Session::getSessionValue('sort_by')) $this->sort_by = Session::getSessionValue('sort_by');
    }

    public function getRequestsData($gets): void
    {
        if (isset($gets['page'])) {
            $this->page = $gets['page'];
            $this->offset = $this->limit * ($this->page - 1);
        }
        if (isset($gets['show_by'])) {
            $this->limit = (int) $gets['show_by'];
            Session::setSessionCookie(['show_by' => $this->limit]);
        }
        if (isset($gets['orders_dates_from'])) $this->orders_dates_from = str_replace('T00:00', ' ', htmlspecialchars($gets['orders_dates_from']));
        if (isset($gets['order_by'])) {
            $this->order = $gets['order_by'];
            Session::setSessionCookie(['order_by' => $this->order]);
        }
        if (isset($gets['sort_by'])) {
            $this->sort_by = $gets['sort_by'];
            Session::setSessionCookie(['order_by' => $this->order]);
        }
    }

    public function getIndexData($gets = []): array
    {
        $this->setSessionVars();
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
        if ($data['total'] > $this->limit) $data['pagination'] = new Pagination($data['total'], $this->page, $this->limit);
        return $data;
    }
}
