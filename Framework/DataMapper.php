<?php

namespace Framework;

use App\Core\Db;
use App\Model\Page;

class DataMapper
{
    protected Db $db;
    public $page;

    public function __construct()
    {
        $this->db = Db::getInstance();
        $this->page = new Page();
    }

    public function insert(array $params, $table): string|false
    {
        $query = 'INSERT INTO `' . $table . '` (' . implode(", ", array_keys($params)) . ') VALUES (:' . implode(", :", array_keys($params)) . ') ON DUPLICATE KEY UPDATE id = :id';
        if ($this->db->run($query, $params)) {
            return true;
        }
        return false;
    }

    public function update(array $params, $table): bool
    {
        $query = 'UPDATE `' . $table . '` SET ';
        foreach ($params as $key => $value) {
            if ($key != 'id') $query .= $key . ' = :' . $key . ', ';
        }
        $query = rtrim($query, ', ') . ' WHERE id = :id';
        if ($result = $this->db->run($query, $params)) {
            return $result;
        }
        return false;
    }

    public function delete(array $params, $table)
    {
        $query = 'DELETE FROM `' . $table . '` WHERE id = :id';
        $params = [
            'id' => $params['id']
        ];
        if ($this->db->run($query, $params)) {
            return true;
        }
        return false;
    }

    public function getCountAll($table): int
    {
        $query = "SELECT COUNT(*) AS `count` FROM `" . $table . "`";
        if ($count = $this->db->run($query, [])[0]['count']) {
            return $count;
        }
        return false;
    }

    public function getlist(string $list_name): array
    {
        $query = "SELECT * FROM `" . $list_name . "`";
        if ($list = $this->db->run($query, [])) {
            return $list;
        }
        return false;
    }

    public function selectWhereAnd($table, array|false $what = false, array $params = []): array|false
    {
        $where = '';
        $what_str = $what;
        if (!empty($what) && is_array($what)) {
            $what_str = '`' . implode("`, `", array_values($what)) . '`';
        } else {
            $what_str = '*';
        }
        if (!empty($params)) {
            $where = ' WHERE ';
            foreach ($params as $key => $value) {
                $where .= '`' . $key . '` = :' . $key . ' AND ';
            }
            $where = rtrim($where, ' AND ');
        }
        $query = 'SELECT ' . $what_str . ' FROM `' . $table . '`' . $where;
        if ($data = $this->db->run($query, $params)) {
            return $data[0];
        }
        return false;
    }

    public function getById($table, int $id): array|false
    {
        $query = 'SELECT * FROM `' . $table . '` WHERE id = :id';
        $params = [
            'id' => $id
        ];
        if ($result = $this->db->run($query, $params)) {
            return $result[0];
        }
        return false;
    }

    public function getAll(string $table, $order_by = 'id', $sort_by = 'ASC', $offset = 0, $limit = 12)
    {
        $query = 'SELECT * FROM `' . $table . '`';
        $params = [];
        $query .= ' ORDER BY ' . $order_by;
        $query .= ' ' . $sort_by;
        if ($limit) {
            $query .= ' LIMIT :limit OFFSET :offset';
            $params = array_merge($params, ['limit' => $limit, 'offset' => $offset]);
        }
        if ($result = $this->db->run($query, $params)) {
            return $result;
        }
        return false;
    }
}
