<?php

namespace Framework\View;

use App\View;
use Framework\Core\ExceptionsHandler;

class HomeView extends View

{

    public function render($data): void
    {
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
        include('modules/home_carousel.php');
        $home_carousel_module = ob_get_contents();
        ob_end_clean();
        $error = false;
        $errors = (new ExceptionsHandler())->getMessage();
        if ($errors) {
            ob_start();
            include('modules/error.php');
            $error = ob_get_contents();
            ob_end_clean();
        }
        ob_start();
        include('modules/why_us.php');
        $why_us_module = ob_get_contents();
        ob_end_clean();
        ob_start();
        include('modules/featured_tabs.php');
        $featured_tabs_module = ob_get_contents();
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
        include('modules/main.php');
        $main_block = ob_get_contents();
        ob_end_clean();
        include('modules/footer.php');
        $footer_block = ob_get_contents();
        ob_end_clean();
        include('templates/home.php');
    }
}
