<?php

namespace App\Model;

use Framework\Model;
// use App\Core\Db;

class Page extends Model
{
    public $title = "";

    public function setTitle(string $title)
    {
        $this->title = $title;
    }
}