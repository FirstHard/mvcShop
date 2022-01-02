<?php

namespace App\View;

use App\Model\Page;
use Framework\View;

class ShopView extends View
{

    public function render($data): void
    {
        $headers = new Page();
        $headers->setTitle('Shop');
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
        // Check for error notifications
        ob_start();
        include('modules/why_us.php');
        $why_us_module = ob_get_contents();
        ob_end_clean();
        ob_start();
        include('modules/about_us.php');
        $about_us_module = ob_get_contents();
        ob_end_clean();
        ob_start();
        include('modules/subscribe.php');
        $subscribe_module = ob_get_contents();
        ob_end_clean();
        ob_start();
        if (is_array($main_content)) {
            include('modules/list_categories.php');
            $main_block = ob_get_contents();
        } else {
            include('modules/main.php');
            $main_block = ob_get_contents();
        }
        ob_end_clean();
        ob_start();
        include('modules/footer.php');
        $footer_block = ob_get_contents();
        ob_end_clean();
        include('templates/shop.php');
        flush();
    }
}
