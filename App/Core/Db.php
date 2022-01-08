<?php

namespace App\Core;

use PDO;
use App\Core\ExceptionsHandler;

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

    public function __clone()
    {
    }

    public function __wakeup()
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
        return $result->fetchAll(PDO::FETCH_ASSOC);
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
        return $result->fetchAll(PDO::FETCH_ASSOC)[0]['count'];
    }

    public static function getlist(string $list_name): array
    {
        return require(ROOT . '/App/DB_tmp/' . $list_name . '.php');
    }

    public static function getOne(string $table, int $id): array
    {
        $all_data = require(ROOT . '/App/DB_tmp/' . $table . '.php');
        foreach ($all_data as $i => $subarray) {
            foreach ($subarray as $key => $value) {
                if ('id' === $key && $id == $value) {
                    return $all_data[$i];
                }
            }
        }
    }
}
