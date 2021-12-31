<?php

namespace Framework;

use App\Core\Db;

class DataMapper
{
    protected Db $db;

    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    public function insert(DataMapper $object, $table): string|false
    {
        $params = get_object_vars($object);
        if (isset($params['id'])) unset($params['id']);
        $query = 'INSERT INTO `' . $table . '` (' . implode(", ", array_keys($params)) . ') VALUES (:' . implode(", :", array_keys($params)) . ')';
        if ($this->db->run($query, $params)) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function update(DataMapper $object, $table): string|false
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

    public function delete(DataMapper $object, $table)
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
        /* echo '<pre>';
        print_r($query);
        echo '</pre>'; */
        return $this->db->run($query, $params);
    }
}
