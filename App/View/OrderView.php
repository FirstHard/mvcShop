<?php

namespace App\View;

use Framework\View;
use App\Model\Page;

class OrderView extends View

{
    public function render($data): void
    {
        if (is_array($data)) {
            extract($data);
        }
        if (is_string($data)) {
            parse_str($data, $queries_data);
            extract($queries_data);
        }
        if (isset($pagination) && is_object($pagination)) {
            ob_start();
            echo $pagination->get();
            $pagination_block = ob_get_contents();
            ob_end_clean();
        }
        $headers = new Page();
        $headers->setTitle('Orders');
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
        include('modules/order_filters.php');
        $asaid_modules = ob_get_contents();
        ob_end_clean();
        ob_start();
        if (is_array($main_content)) {
            include('modules/list_orders.php');
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
        include('templates/orders.php');
    }
}
