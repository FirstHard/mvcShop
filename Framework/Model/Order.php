<?php

namespace Framework\Model;

use PDO;
use App\Model;
use Framework\Core\Db;
use Framework\Core\Session;
use Framework\View\Pagination;

class Order extends Model
{
    public $data = [];
    public $param = false;
    public $queries = false;
    public $gets = false;

    public static function getCountOrdersByUserId(int $id): array|bool
    {
        $query = "SELECT COUNT(*) FROM `order` WHERE `user_id` = :user_id";
        $result = (Db::run($query, ['user_id' => $id]));
        $result->execute();
        return $result->fetchColumn();
    }

    public static function getOrdersByUserId(int $user_id, int $limit, int $offset, string $order): array|bool
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

    public static function getIndexData($queries = [], $gets = []): array
    {
        $data['headers']['pageTitle'] = 'Orders';
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
                $orders_dates_from = str_replace('T', ' ', htmlspecialchars($gets['orders_dates_from']));
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
        if ($queries) {
            if (isset($queries['search'])) {
                $search = htmlspecialchars($queries['search']);
            }
        }
        $data['sort_by'] = $sort_by;
        $data['order_by'] = $order;
        $data['show_by'] = $limit;
        $data['page'] = $page;
        if (!empty($search)) {
            $data['main_content'] = self::getUserOrdersBySearch($user_id, $search, $limit, $offset, $order);
        } elseif (!empty($orders_dates_from)) {
            $data['main_content'] = self::getUserOrdersByDate($user_id, $orders_dates_from, $limit, $offset, $order);
        } else {
            $data['count_all'] = self::getCountOrdersByUserId($user_id);
            $data['main_content'] = self::getOrdersByUserId($user_id, $limit, $offset, $order);
            $data['pagination'] = new Pagination($data['count_all'], $page, $limit, 'page');
        }
        return $data;
    }

    public static function getUserOrdersBySearch($user_id, $search, $limit, $offset, $order): array|bool
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

    public static function getUserOrdersByDate($user_id, $created_at, $limit, $offset, $order): array|bool
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
