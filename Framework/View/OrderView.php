<?php

namespace Framework\View;

use App\View;

class OrderView extends View

{
    public function render($data): void
    {
        // Get content for page from model
        if (is_array($data)) {
            extract($data);
        }
        if (is_string($data)) {
            parse_str($data, $queries_data);
            extract($queries_data);
        }
        if (isset($pagination)) {
            ob_start();
            echo ($pagination)->get();
            $pagination_block = ob_get_contents();
            ob_end_clean();
        }
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
