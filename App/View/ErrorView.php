<?php

namespace App\View;

use Framework\View;
use App\Model\Page;

class ErrorView extends View

{
    public function render($data): void
    {
        $headers = new Page();
        $headers->setTitle('Error');
        extract($data);
        ob_start();
        include('modules/head.php');
        $head_block = ob_get_contents();
        ob_end_clean();
        ob_start();
        include('modules/nav.php');
        $nav_module = ob_get_contents();
        ob_end_clean();
        ob_start();
        include('modules/header.php');
        $header_block = ob_get_contents();
        ob_end_clean();
        ob_start();
        include('modules/main.php');
        $main_block = ob_get_contents();
        ob_end_clean();
        ob_start();
        include('modules/footer.php');
        $footer_block = ob_get_contents();
        ob_end_clean();
        include('templates/errors.php');
    }
}
