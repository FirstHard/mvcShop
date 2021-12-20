<?php

namespace Framework\Core;

use PDO;
use PDOException;
use Framework\Core\ExceptionsHandler;

class Db
{
    private static $conn = null;

    public static function getInstance(){
        try {
            self::$conn = new PDO('mysql:host=localhost;dbname=' . DB_TABLE, DB_USER, DB_PASS);
            self::$conn->exec("set names utf8");
        } catch (PDOException $pdo) {
            throw new ExceptionsHandler($pdo->getMessage(), 0);
        } catch (ExceptionsHandler $e) {
            throw new ExceptionsHandler($e->getMessage(), 0);
        }
        return self::$conn;
    }

    public static function run(string $query, array $params) {
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

    public function insert(string $table_name, array $params)
    {
        //extract($params);
        $query = '
            INSERT INTO `' . $table_name . '` (`';
        $keys = array_keys($params);
		foreach ($keys as $value) {
            $query .= $value . '`, `';
        }
        $query = rtrim($query, ', `');
        $query .= '`) VALUES (';
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
    }



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
