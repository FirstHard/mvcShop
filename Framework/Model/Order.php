<?php

namespace Framework\Model;

use PDO;
use App\Model;
use Framework\Core\Db;
use Framework\Core\Session;
use Framework\View\Modules\Pagination;

class Order extends Model
{
    public $data = [];
    public $param = false;
    public $query_data = false;

    public function __construct()
    {
    }

    public function getCountOrdersByUserId(int $id)
    {
        $query = "SELECT COUNT(*) FROM `order` WHERE `user_id` = :user_id";
        $result = (Db::run($query, ['user_id' => $id]));
        $result->execute();
        return $result->fetchColumn();
    }

    public function getOrdersByUserId(int $user_id, int $limit, int $offset, string $order)
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
        $result = (Db::run($query, $params));
        $result->setFetchMode(PDO::FETCH_CLASS, 'Framework\Model\Order');
        $result->execute();
        return $result->fetchAll();
    }

    public function getIndexData($query_data = false)
    {
        $data['headers']['pageTitle'] = 'My orders';
        $data['headers']['siteTitle'] = 'Project MVC The Shop';
        $user_id = 1; // Getting user ID from Auth...
        $offset = 0;
        $page = 1;
        $search = '';
        $orders_dates_from = '';
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
        if ($query_data) {
            if (isset($query_data['page'])) {
                $page = $query_data['page'];
                $offset = $limit * ($page - 1);
            }
            if (isset($query_data['search'])) {
                $search = htmlspecialchars($query_data['search']);
            }
            if (isset($query_data['orders_dates_from'])) {
                $orders_dates_from = str_replace('T', ' ', htmlspecialchars($query_data['orders_dates_from']));
            }
            if (isset($query_data['show_by'])) {
                $limit = (int) $query_data['show_by'];
                Session::setSessionCookie(['show_by' => $limit]);
            }
            if (isset($query_data['order_by'])) {
                $order = $query_data['order_by'];
                Session::setSessionCookie(['order_by' => $order]);
            }
            if (isset($query_data['sort_by'])) {
                $sort_by = $query_data['sort_by'];
                Session::setSessionCookie(['order_by' => $order]);
            }
        }
        $data['sort_by'] = $sort_by;
        $data['order_by'] = $order;
        $data['show_by'] = $limit;
        $data['page'] = $page;
        if (!empty($search)) {
            $data['main_content'] = $this->getUserOrdersBySearch($user_id, $search, $limit, $offset, $order);
        } elseif (!empty($orders_dates_from)) {
            $data['main_content'] = $this->getUserOrdersByDate($user_id, $orders_dates_from, $limit, $offset, $order);
        } else {
            $data['count_all'] = $this->getCountOrdersByUserId($user_id);
            $data['main_content'] = $this->getOrdersByUserId($user_id, $limit, $offset, $order);
            $data['pagination'] = new Pagination($data['count_all'], $page, $limit, 'page');
        }
        $this->data = $data;
    }

    public function getUserOrdersBySearch($user_id, $search, $limit, $offset, $order)
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
        $result = (Db::run($query, $params));
        $result->setFetchMode(PDO::FETCH_CLASS, 'Framework\Model\Order');
        $result->execute();
        return $result->fetchAll();
    }

    public function getUserOrdersByDate($user_id, $created_at, $limit, $offset, $order)
    {
        if ($order == 'DESC') {
            $query = "SELECT * FROM `order` WHERE `user_id` = :user_id AND created_at LIKE :created_at ORDER BY order_number DESC LIMIT :limit OFFSET :offset";
        } else {
            $query = "SELECT * FROM `order` WHERE `user_id` = :user_id AND created_at LIKE :created_at ORDER BY order_number ASC LIMIT :limit OFFSET :offset";
        }
        $params = [
            'user_id' => $user_id,
            'created_at' => '%' . $created_at . '%',
            'offset' => $offset,
            'limit' => $limit
        ];
        $result = (Db::run($query, $params));
        $result->setFetchMode(PDO::FETCH_CLASS, 'Framework\Model\Order');
        $result->execute();
        return $result->fetchAll();
    }
}
