<?php

namespace Framework;

use App\Core\Db;
use App\Core\Fdb;

class DataMapper
{
    protected Db $db;

    public function __construct()
    {
        $this->db = Db::getInstance();
        $this->fdb = Fdb::getInstance('');
    }

    public function insert(Model $object, $table): string|false
    {
        $params = get_object_vars($object);
        $query = 'INSERT INTO `' . $table . '` (' . implode(", ", array_keys($params)) . ') VALUES (:' . implode(", :", array_keys($params)) . ') ON DUPLICATE KEY UPDATE id = :id';
        if ($this->db->run($query, $params)) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function update(Model $object, $table): string|false
    {
        $params = get_object_vars($object);
        $query = 'UPDATE `' . $table . '` SET ';
        foreach ($params as $key => $value) {
            if ($key != 'id') $query .= $key . ' = :' . $key . ', ';
        }
        $query = rtrim($query, ', ') . ' WHERE id = :id';
        if ($this->db->run($query, $params)) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function delete(Model $object, $table)
    {
        $query = 'DELETE FROM `' . $table . '` WHERE id = :id';
        $params = [
            'id' => $object->id
        ];
        if ($this->db->run($query, $params)) {
            return true;
        }
        return false;
    }

    public function selectWhereAnd($table, array|false $what = false, array $params = [])
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
        $query = 'SELECT ' . $what_str .  ' FROM `' . $table . '`' . $where;
        return $this->db->run($query, $params);
    }

    public function getById($table, int $id)
    {
        $query = 'SELECT * FROM `' . $table . '` WHERE id = :id';
        $params = [
            'id' => $id
        ];
        if ($object = $this->db->run($query, $params)) {
            return $object[0];
        }
        return false;
    }

    public function getAll(string $table, $order_by = 'id', $sort_by = 'ASC', $offset = 0, $limit = 12)
    {
        $query = 'SELECT * FROM `' . $table . '`';
        $params = [];
        $query .= ' ORDER BY ' . $order_by;
        $query .= ' ' . $sort_by;
        $query .= ' LIMIT :limit OFFSET :offset';
        $params = array_merge($params, ['limit' => $limit, 'offset' => $offset]);
        if ($objects = $this->db->run($query, $params)) {
            return $objects;
        }
        return false;
    }
}
