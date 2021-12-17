<?php

namespace Framework\Core;

class Db
{

    public function __construct()
    {
        // Getting connect to db and connect statement
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
