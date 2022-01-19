<?php

namespace Framework;

use App\Core\Auth;

class View
{
    protected $auth;
    
    public function __construct()
    {
        $this->auth = new Auth;
    }

    public function render($data): void
    {
    }
}
