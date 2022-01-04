<?php

namespace App\Model;

use Framework\Model;

class Page extends Model
{
    public $title = "";

    public function setTitle($title)
    {
        $this->title = $title;
    }
}