<?php

namespace Framework\Core;

use PDO;
use PDOException;
use Framework\Core\ExceptionsHandler;
use FirstHard\LogsHandler;

class Db
{
    private static $conn = null;

    private function __construct()
    {
        try {
            self::$conn = new PDO(
                'mysql:host=localhost;dbname=' . DB_NAME,
                DB_USER,
                DB_PASS,
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
                ]
            );
        } catch (PDOException $pdo) {
            throw new PDOException($pdo->getMessage(), 0);
            LogsHandler::debug($pdo->getMessage());
        }
        return self::$conn;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public static function getInstance()
    {
        if (self::$conn != null) {
            return self::$conn;
        }
        return new self();
    }

    public static function run(string $query, array $params)
    {
        $result = Db::getInstance()->prepare($query);
        foreach ($params as $key => $value) {
            if (gettype($value) == 'integer') {
                $param_type = PDO::PARAM_INT;
            } elseif (gettype($value) == 'string') {
                $param_type = PDO::PARAM_STR;
            } else {
                throw new ExceptionsHandler('Wrong param type!', 0);
                die();
            }
            $result->bindParam(':' . $key, $params[$key], $param_type);
        }
        return $result;
    }

    /* public function insert(string $table_name, array $params)
    {
        $query = '
            INSERT INTO ' . $table_name . ' (';
        $keys = array_keys($params);
        foreach ($keys as $value) {
            $query .= $value . ', ';
        }
        $query = rtrim($query, ', ');
        $query .= ') VALUES (';
        foreach ($keys as $value) {
            $query .= ':' . $value . ', ';
        }
        $query = rtrim($query, ', ') . ')';
        $result = $this->conn->prepare($query);
        foreach ($params as $key => $value) {
            if (gettype($value) == 'integer') {
                $param_type = PDO::PARAM_INT;
            } elseif (gettype($value) == 'string') {
                $param_type = PDO::PARAM_STR;
            } else {
                throw new ExceptionsHandler('Wrong param type!', 0);
                die();
            }
            $result->bindParam(':' . $key, $params[$key], $param_type);
        }
        return $result->execute();
    } */

    public static function getlist(string $list_name): array
    {
        return require(ROOT . '/Framework/DB_tmp/' . $list_name . '.php');
    }

    public static function getOne(string $table, int $id): array
    {
        $all_data = require(ROOT . '/Framework/DB_tmp/' . $table . '.php');
        // Iteration on leafs
        foreach ($all_data as $i => $subarray) {
            foreach ($subarray as $key => $value) {
                if ('id' === $key && $id == $value) {
                    return $all_data[$i];
                }
            }
        }
    }
}
