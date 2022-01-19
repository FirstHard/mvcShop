<?php

namespace App\View;

use Framework\View;
use App\Model\Page;
use App\Core\ExceptionsHandler;

class HomeView extends View
{

    public function render($data): void
    {
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
        include('modules/why_us.php');
        $why_us_module = ob_get_contents();
        ob_end_clean();
        ob_start();
        include('modules/featured_tabs.php');
        $featured_tabs_module = ob_get_contents();
        ob_end_clean();
        ob_start();
        include('modules/footer.php');
        $footer_block = ob_get_contents();
        ob_end_clean();
        include('templates/home.php');
        flush();
    }
}
