<?php

namespace App\Core;

class Fdb
{
    private static $instance = null;
    private static $table = null;

    private function __construct($table)
    {
        self::$table = $table;
        return self::$instance;
    }

    public static function getInstance($table): Fdb
    {
        if (self::$instance != null) {
            return self::$instance;
        }
        return new self($table);
    }

    public function getlist(): array
    {
        return require(ROOT . 'App/DB_tmp/' . self::$table . '.php');
    }

    public function getOne(int $id): array
    {
        $all_data = require(ROOT . 'App/DB_tmp/' . self::$table . '.php');
        foreach ($all_data as $i => $subarray) {
            foreach ($subarray as $key => $value) {
                if ('id' === $key && $id == $value) {
                    return $all_data[$i];
                }
            }
        }
    }
}
