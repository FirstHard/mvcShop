<?php

namespace App\View;

use Framework\View;
use App\Model\Page;
use App\Model\Order;
use App\Model\OrderMapper;

class OrderView extends View
{

    public function renderList($data): void
    {
        extract($data);
        if (is_array($main_content)) {
            ob_start();
            include('modules/order_filters.php');
            $asaid_modules = ob_get_contents();
            ob_end_clean();
            ob_start();
            include('modules/list_orders.php');
            $main_block = ob_get_contents();
            ob_end_clean();
        } else {
            ob_start();
            include('modules/main.php');
            $main_block = ob_get_contents();
            ob_end_clean();
        }
        if (isset($pagination) && is_object($pagination)) {
            ob_start();
            echo $pagination->get();
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
        include('modules/footer.php');
        $footer_block = ob_get_contents();
        ob_end_clean();
        include('templates/orders.php');
        flush();
    }

    public function renderOne($data): void
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
        include('modules/order_main.php');
        $main_block = ob_get_contents();
        ob_end_clean();
        ob_start();
        include('modules/footer.php');
        $footer_block = ob_get_contents();
        ob_end_clean();
        include('templates/order.php');
        flush();
    }
}
