<?php

namespace App\View;

use Framework\View;

class CartView extends View

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
        if ($data->user) {
            include('modules/order_form.php');
            $order_form = ob_get_contents();
        } else {
            include('modules/guest_order_form.php');
            $order_form = ob_get_contents();
        }
        ob_end_clean();
        ob_start();
        include('modules/cart_main.php');
        $main_block = ob_get_contents();
        ob_end_clean();
        ob_start();
        include('modules/footer.php');
        $footer_block = ob_get_contents();
        ob_end_clean();
        include('templates/cart.php');
        flush();
    }
}
