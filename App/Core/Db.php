<?php

namespace App\Core;

use \RecursiveIterator;
use App\Model\Product;

class Db
{

    public function __construct()
    {
        // Getting connect to db and connect statement
    }

    /* public function getNewArrivalsProducts()
    {
        $table_data = ROOT . '/App/DB_tmp/' . $table . '.php';
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
