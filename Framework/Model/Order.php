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

    public function getOrdersByUserId(int $id, int $limit = 10, int $offset = 10, string $sort_by = '`order_number`', string $order = '`ASC`')
    {
        $query = "SELECT * FROM `order` WHERE `user_id` = :user_id ORDER BY :sort_by :order LIMIT :limit OFFSET :offset";
        $params = [
            'user_id' => $id,
            'limit' => $limit,
            'offset' => $offset,
            'sort_by' => $sort_by,
            'order' => $order
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
        $user_id = 1;
        $offset = 0;
        $page = 1;
        if (Session::getSessionValue('show_by')) {
            $limit = (int) Session::getSessionValue('show_by');
        } else {
            $limit = 10;
        }
        if ($query_data) {
            if (isset($query_data['show_by'])) {
                $limit = (int) $query_data['show_by'];
                Session::setSessionCookie(['show_by' => $limit]);
            }

            if (isset($query_data['page'])) {
                $page = $query_data['page'];
                $offset = $limit * ($page - 1);
            }
        }
        $data['count_all'] = $this->getCountOrdersByUserId($user_id);
        $data['page'] = $page;
        $data['main_content'] = $this->getOrdersByUserId($user_id, $limit, $offset);
        $data['pagination'] = new Pagination($data['count_all'], $page, $limit, 'page');
        $this->data = $data;
    }
}
