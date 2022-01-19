<?php

namespace App\View;

use Framework\View;
use App\Model\Page;

class UserView extends View

{
    public function render($data): void
    {
        if ($data->pagination) {
            $pagination_block = $data->pagination->get();
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
        if ($data->orders) {
            ob_start();
            include('modules/order_filters.php');
            $asaid_modules = ob_get_contents();
            ob_end_clean();
            ob_start();
            include('modules/list_orders.php');
            $main_block = ob_get_contents();
            ob_end_clean();
        } elseif ($data->single_order) {
            ob_start();
            include('modules/order_main.php');
            $main_block = ob_get_contents();
            ob_end_clean();
        } else {
            ob_start();
            include('modules/main.php');
            echo $data->page->message;
            $main_block = ob_get_contents();
            ob_end_clean();
        }
        ob_start();
        include('modules/footer.php');
        $footer_block = ob_get_contents();
        ob_end_clean();
        include('templates/user.php');
        flush();
    }

    public function renderIndex($data)
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
        include('modules/user_profile.php');
        $main_block = ob_get_contents();
        ob_end_clean();
        ob_start();
        include('modules/footer.php');
        $footer_block = ob_get_contents();
        ob_end_clean();
        include('templates/user.php');
        flush();
    }

    public function renderLoginPage($data)
    {
        $errors_block = false;
        if (!empty($data->errors)) {
            ob_start();
            include('modules/error.php');
            $errors_block = ob_get_contents();
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
        include('modules/login.php');
        $main_block = ob_get_contents();
        ob_end_clean();
        ob_start();
        include('modules/footer.php');
        $footer_block = ob_get_contents();
        ob_end_clean();
        include('templates/user_default.php');
        flush();
    }

    public function renderDefault($data, $addmodule = false)
    {
        $errors = false;
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
        if ($addmodule) {
            ob_start();
            echo $data->page->message;
            include('modules/' . $addmodule . '.php');
            $main_block = ob_get_contents();
            ob_end_clean();
        } else {
            ob_start();
            echo $data->page->message;
            include('modules/main.php');
            $main_block = ob_get_contents();
            ob_end_clean();
        }
        ob_start();
        include('modules/footer.php');
        $footer_block = ob_get_contents();
        ob_end_clean();
        include('templates/user_default.php');
        flush();
    }

    public function renderRegistrationPage($data)
    {
        $errors = false;
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
        include('modules/registration.php');
        $main_block = ob_get_contents();
        ob_end_clean();
        ob_start();
        include('modules/why_us.php');
        $why_us_module = ob_get_contents();
        ob_end_clean();
        ob_start();
        include('modules/footer.php');
        $footer_block = ob_get_contents();
        ob_end_clean();
        include('templates/user_default.php');
        flush();
    }
}
