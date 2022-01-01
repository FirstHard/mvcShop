<?php

namespace App\Core;

use PDO;
use PDOException;
use App\Core\ExceptionsHandler;
use FirstHard\LogsHandler;

class Db extends PDO
{
    private static $conn = null;

    private function __construct()
    {
        return self::$conn = parent::__construct(
            'mysql:host=localhost;dbname=' . DB_NAME . ';charset=utf8',
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public static function getInstance(): Db
    {
        if (self::$conn !== null) {
            return self::$conn;
        }
        return self::$conn = new self();
    }

    public function run(string $query, array $params)
    {
        $result = self::$conn->prepare($query);
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
        $result->execute();
        return $result->fetchAll();
    }

    public function count(string $query, array $params): int
    {
        $result = self::$conn->prepare($query);
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
        $result->execute();
        return $result->fetchAll()[0]['count'];
    }

    /* public function lastinsertid()
    {
        return self::$conn->lastInsertId();
    } */

    public static function getlist(string $list_name): array
    {
        return require(ROOT . '/App/DB_tmp/' . $list_name . '.php');
    }

    public static function getOne(string $table, int $id): array
    {
        $all_data = require(ROOT . '/App/DB_tmp/' . $table . '.php');
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
