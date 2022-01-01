<?php

namespace App\Model;

use Framework\Model;

class Page extends Model
{
    public $title = "";

    public function setTitle(string $title)
    {
        $this->title = $title;
    }
}