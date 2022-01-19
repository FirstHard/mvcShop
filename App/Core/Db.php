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
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
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

    public function run(string $query, array $params): array|int|false
    {
        $result = self::$conn->prepare($query);
        foreach ($params as $key => $value) {
            if (gettype($value) == 'integer') {
                $param_type = PDO::PARAM_INT;
            } elseif (gettype($value) == 'string') {
                $param_type = PDO::PARAM_STR;
            } else {
                throw new ExceptionsHandler('Wrong param type of: ' . $key . '!', 0);
                die();
            }
            $result->bindParam(':' . $key, $params[$key], $param_type);
        }
        $result->execute();
        if (in_array(explode(' ', trim($query))[0], ['INSERT', 'UPDATE', 'DELETE'])) {
            if ($data = $result->rowCount()) {
                return $data;
            }
        }
        if ($data = $result->fetchAll()) {
            return $data;
        }
        return false;
    }
}
