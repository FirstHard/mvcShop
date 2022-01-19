<?php

namespace App\Model;

use App\Model\User;
use App\Core\Session;
use App\View\Pagination;
use Framework\DataMapper;

class UserMapper extends DataMapper
{
    protected $elements;
    protected const TABLE_NAME = 'user';
    public $errors;
    public $orders_dates_from = false;
    public $single_order;
    public $orders = [];
    public $orders_total = 0;
    public $orders_offset = 0;
    public $orders_limit = 10;
    public $pages = 1;
    public $order_by = 'ASC';
    public $sort_by = 'name';
    public $pagination;
    public $main_data;

    public function fetchCollection($objects)
    {
        foreach ($objects as $object) {
            $user = new User();
            $user->setId($object['id']);
            $user->setLogin($object['login']);
            $user->setEmail($object['email']);
            $user->setPassword($object['password']);
            $user->setPhoneNumber($object['phone_number']);
            $user->setAuthToken($object['auth_token']);
            $user->setFirstName($object['first_name']);
            $user->setLastName($object['last_name']);
            $user->setMiddleName($object['middle_name']);
            $user->setRegisteredAt($object['registered_at']);
            $user->setBlocked($object['blocked']);
            $user->setPostcode($object['postcode']);
            $user->setCountry($object['country']);
            $user->setState($object['state']);
            $user->setCity($object['city']);
            $user->setStreet($object['street']);
            $user->setHouseNumber($object['house_number']);
            $user->setApartmentNumber($object['apartment_number']);
            $this->elements[] = $user;
        }
        return $this->elements;
    }

    public function getOne($object)
    {
        $user = new User();
        $user->setId($object['id']);
        $user->setLogin($object['login']);
        $user->setEmail($object['email']);
        $user->setPassword($object['password']);
        $user->setPhoneNumber($object['phone_number']);
        $user->setAuthToken($object['auth_token']);
        $user->setFirstName($object['first_name']);
        $user->setLastName($object['last_name']);
        $user->setMiddleName($object['middle_name']);
        $user->setRegisteredAt($object['registered_at']);
        $user->setBlocked($object['blocked']);
        $user->setPostcode($object['postcode']);
        $user->setCountry($object['country']);
        $user->setState($object['state']);
        $user->setCity($object['city']);
        $user->setStreet($object['street']);
        $user->setHouseNumber($object['house_number']);
        $user->setApartmentNumber($object['apartment_number']);
        return $user;
    }

    public function getUser($id)
    {
        $object = $this->getById(self::TABLE_NAME, $id);
        $user = new User();
        $user->setId($object['id']);
        $user->setLogin($object['login']);
        $user->setEmail($object['email']);
        $user->setPassword($object['password']);
        $user->setPhoneNumber($object['phone_number']);
        $user->setAuthToken($object['auth_token']);
        $user->setFirstName($object['first_name']);
        $user->setLastName($object['last_name']);
        $user->setMiddleName($object['middle_name']);
        $user->setRegisteredAt($object['registered_at']);
        $user->setBlocked($object['blocked']);
        $user->setPostcode($object['postcode']);
        $user->setCountry($object['country']);
        $user->setState($object['state']);
        $user->setCity($object['city']);
        $user->setStreet($object['street']);
        $user->setHouseNumber($object['house_number']);
        $user->setApartmentNumber($object['apartment_number']);
        return $user;
    }

    public function getByToken($token)
    {
        $query = 'SELECT * FROM `user` WHERE auth_token = :auth_token';
        $params = [
            'auth_token' => $token
        ];
        if ($result = $this->db->run($query, $params)) {
            return $this->getOne($result[0]);
        }
        return false;
    }

    public function login()
    {
        $this->page->getMainContent('login');
        $this->ui = $this->page->renderHtmlUI();
    }

    public function reset($result = 'reset', $user = false)
    {
        $this->page->getMainContent($result);
        if ($user) {
            $this->main_data = $user;
        }
    }

    public function registration()
    {
        $this->page->getMainContent('registration');
        $this->main_data = (new StateMapper())->getStates();
    }

    public function registrationComplete()
    {
        $this->page->getMainContent('register_complete');
    }

    public function registrationSuccess()
    {
        $this->page->getMainContent('register_success');
    }

    public function registrationFailed()
    {
        $this->page->getMainContent('broken_token');
    }

    public function isExist($data): User|false
    {
        $query = 'SELECT `id` FROM `' . self::TABLE_NAME . '` WHERE login = :login || email = :email';
        $params = ['login' => $data['login'], 'email' => $data['login']];
        if ($user_id = $this->db->run($query, $params)) {
            return $this->getUser($user_id[0]['id']);
        }
        return false;
    }

    public function getUserOrdersData($logged_user_id, $gets = [])
    {
        $this->setSessionVars();
        $this->ui = $this->page->renderHtmlUI();
        $orderMapper = new OrderMapper();
        if ($gets) {
            $this->getRequestsData($gets);
        }
        $this->orders_total = $orderMapper->getCountOrdersByUserId($logged_user_id);
        if ($this->orders = $orderMapper->getOrdersByUserId($logged_user_id, $this->orders_limit, $this->orders_offset, $this->order_by)) {
            $this->page->getMainContent('orders_history');
            if ($this->orders_total > $this->orders_limit) {
                $this->pagination = new Pagination($this->orders_total, $this->pages, $this->orders_limit);
            }
        } else {
            $this->page->getMainContent('no_orders');
        }
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
        if ($orders = $this->db->run($query, $params)) return (new OrderMapper())->fetchCollection($orders);
        return false;
    }

    public function getUserOrder($order_number, $user_id)
    {
        $this->ui = $this->page->renderHtmlUI();
        $orderMapper = new OrderMapper();
        if ($single_order = $orderMapper->getByNumber('order', $order_number, $user_id)) {
            $this->page->getMainContent('single_order');
            $this->single_order = $single_order;
        } else {
            $this->page->getMainContent('order_not_found');
        }
    }

    public function getSearchData($user_id, $queries_data)
    {
        if (is_string($queries_data)) parse_str($queries_data, $this->queries);
        if (is_array($queries_data)) $this->queries = $queries_data;
        if ($this->queries) $this->getQueriesData($user_id, $this->queries);
    }

    public function getQueriesData($user_id, $queries): void
    {
        $this->page->getMainContent('search_orders');
        $this->ui = $this->page->renderHtmlUI();
        if (isset($queries['search'])) $this->search = htmlspecialchars($queries['search']);
        if ($this->orders = $this->getUserOrdersBySearch($user_id, $this->search, $this->orders_limit, $this->orders_offset, $this->order_by)) {
            $this->orders_total = sizeof($this->orders);
        }
        if ($this->orders_total > $this->orders_limit) $this->pagination = new Pagination($this->orders_total, $this->pages, $this->orders_limit);
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
        if ($orders = $this->db->run($query, $params)) return (new OrderMapper())->fetchCollection($orders);
        return false;
    }

    public function getProfileData($logged_user)
    {
        $this->page->getMainContent('user_profile');
        $this->ui = $this->page->renderHtmlUI();
        $this->main_data = $this->getUser($logged_user->getId());
    }

    public function setSessionVars(): void
    {
        if (Session::getSessionValue('show_by')) $this->orders_limit = (int) Session::getSessionValue('show_by');
        if (Session::getSessionValue('order_by')) $this->order_by = Session::getSessionValue('order_by');
        if (Session::getSessionValue('sort_by')) $this->sort_by = Session::getSessionValue('sort_by');
    }

    public function getRequestsData($gets): void
    {
        if (isset($gets['page'])) {
            $this->pages = $gets['page'];
            $this->orders_offset = $this->orders_limit * ($this->pages - 1);
            Session::setSessionCookie(['page' => $this->pages]);
            Session::setSessionCookie(['offset' => $this->orders_offset]);
        }
        if (isset($gets['show_by'])) {
            $this->orders_limit = (int) $gets['show_by'];
            Session::setSessionCookie(['show_by' => $this->orders_limit]);
        }
        if (isset($gets['orders_dates_from'])) {
            $this->orders_dates_from = str_replace('T00:00', ' ', htmlspecialchars($gets['orders_dates_from']));
            Session::setSessionCookie(['orders_dates_from' => $this->orders_dates_from]);
        }
        if (isset($gets['order_by'])) {
            $this->order_by = $gets['order_by'];
            Session::setSessionCookie(['order_by' => $this->order_by]);
        }
        if (isset($gets['sort_by'])) {
            $this->sort_by = $gets['sort_by'];
            Session::setSessionCookie(['sort_by' => $this->sort_by]);
        }
    }
}
