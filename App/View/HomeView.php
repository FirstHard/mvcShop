<?php

namespace App\View;

class HomeView

{

    public function render($data)
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
        include('modules/home_carousel.php');
        $home_carousel_module = ob_get_contents();
        ob_end_clean();
        ob_start();
        include('modules/header.php');
        $header_block = ob_get_contents();
        ob_end_clean();
        ob_start();
        include('modules/messages.php');
        $messages_module = ob_get_contents();
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
        ob_start();
        return include('templates/home.php');
        ob_end_flush();
    }
}
