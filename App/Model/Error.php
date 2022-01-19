<?php

namespace App\Model;

use Framework\Model;

class Error extends Model
{
    public $page;

    public function __construct()
    {
        $this->page = new Page();
    }

    public function getErrorInfo($code)
    {
        if ($code === 404) {
            $this->page->getMainContent('404');
        } else {
            $this->page->getMainContent('500');
        }
        $this->main_data = $this->page->renderHtmlMessage($this->page->level, $this->page->header, $this->page->body, $this->page->footer);
    }
}
