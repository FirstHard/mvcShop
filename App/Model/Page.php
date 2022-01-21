<?php

namespace App\Model;

use Framework\Model;

class Page extends Model
{
    public $title;
    public $message;
    public $site_title = 'Project MVC The Shop';
    public $level;
    public $header;
    public $body;
    public $footer;

    public function __construct()
    {
    }

    public function getMainContent($type)
    {
        switch ($type) {

            case 'home':
                $this->title = 'Home';
                break;

            case 'shop_category':
                $this->title = 'Category';
                break;

            case 'shop':
                $this->title = 'Shop categories';
                break;

            case 'list_products':
                $this->title = 'List Products';
                break;

            case 'registration':
                $this->title = 'New User Registration';
                break;

            case 'register_success':
                $this->title = 'New User Registration';
                $this->level = 'success';
                $this->header = 'Congratulations!';
                $this->body = 'You have successfully verified your email address!';
                $this->footer = 'Log in to your <a href="/user/login">Profile</a>, or go to the <a href="/">Home</a> page.';
                break;

            case 'register_complete':
                $this->title = 'New User Registration';
                $this->level = 'info';
                $this->header = 'Thanks!';
                $this->body = 'Please note! You have just registered an account on our website. We have sent a message to your email address with a link to confirm it. Open this letter and follow the link in it to activate your account. After that, you can log in to our website.';
                $this->footer = 'If you have activated your email address in another browser window - log in to your <a href="/user/login">Profile</a>, or go to the <a href="/">Home</a> page.';
                break;

            case 'reset':
                $this->title = 'Reset User Password';
                $this->level = 'info';
                $this->header = 'Forgot Your Password?';
                $this->footer = 'A link to confirm your password reset will be sent to your email address. Follow this link and enter a new password. After submitting a new password, this link will no longer be valid.';
                break;

            case 'reset_complete':
                $this->title = 'Reset User Password';
                $this->level = 'success';
                $this->header = 'Reset User Password complete!';
                $this->footer = 'A password reset confirmation link has been sent to your email address. Follow this link and enter a new password. Once a new password has been submitted, this link will no longer be valid.';
                break;

            case 'reset_success':
                $this->title = 'Reset User Password';
                $this->level = 'info';
                $this->header = 'Create a new password';
                $this->footer = 'Password cannot be less than 6 characters. After submitting the form, you will be redirected to the login page.';
                break;

            case 'reset_false':
                $this->title = 'Reset User Password';
                $this->level = 'danger';
                $this->header = 'Reset Password False! Try again.';
                $this->footer = 'A link to confirm your password reset will be sent to your email address. Follow this link and enter a new password. After submitting a new password, this link will no longer be valid.';
                break;

            case 'broken_token':
                $this->title = 'Broken token!';
                $this->level = 'danger';
                $this->header = 'Attantion!';
                $this->body = 'This token is broken!';
                $this->footer = 'If you have activated your email address in another browser window - log in to your <a href="/user/login">Profile</a>, or go to the <a href="/">Home</a> page.';
                break;

            case 'user_profile':
                $this->title = 'User Profile';
                break;

            case 'search_orders':
                $this->title = 'Search orders';
                break;

            case 'orders_history':
                $this->title = 'My Orders history';
                break;

            case 'no_orders':
                $this->title = 'My Orders history';
                $this->level = 'danger';
                $this->header = 'Nothing to show!';
                $this->body = 'Sorry, you have not made any purchases in our store yet.';
                $this->footer = 'Choose something from our <a href="/shop">Products</a> range.';
                break;

            case 'cart_empty':
                $this->title = 'Cart';
                $this->level = 'info';
                $this->header = 'Your shopping cart is empty.';
                $this->body = 'Please add to cart products.';
                $this->footer = 'Choose something fine from our <a href="/shop">Products</a> range.';
                break;

            case 'cart':
                $this->title = 'Cart';
                break;

            case 'single_order':
                $this->title = 'Order';
                break;

            case 'order_not_found':
                $this->title = 'Order not found';
                $this->level = 'danger';
                $this->header = 'Order not found!';
                $this->body = 'Please make sure you have entered the correct order number!';
                $this->footer = 'Return to the <a href="/user/orders">Order History</a> page and select the correct order number.';
                break;

            case '404':
                $this->title = 'Page not found';
                $this->level = 'danger';
                $this->header = 'Error 404: Page not found!';
                $this->body = 'Please make sure you have entered the correct link!';
                $this->footer = 'Return to the <a href="/">Home page</a> and select the correct link.';
                break;

            case '500':
                $this->title = 'Server error';
                $this->level = 'danger';
                $this->header = 'Error 500: Server error!';
                $this->body = 'An error has occurred on the server, our specialists are already working on its elimination.';
                $this->footer = 'Return to the <a href="/">Home page</a> or check back later.';
                break;

            case 'login':
                $this->title = 'User login page';
                break;

            default:
                $this->title = 'Error!';
                $this->level = 'default';
                $this->header = 'Something wrong...';
                $this->body = 'Unknown message';
                $this->footer = 'Let the site administrator know about it: <a href="#">.';
                break;
        }
        if ($this->level) {
            $this->message = $this->renderHtmlMessage($this->level, $this->header, $this->body, $this->footer);
        }
    }

    public function renderHtmlMessage($level, $header, $body, $footer)
    {
        return '
            <div class="alert alert-' . $level . ' alert fade show my-5" role="alert">
              <h4 class="alert-heading">' . $header . '</h4>
              <p><strong>' . $body . '</strong></p>
              <hr>
              <p class="mb-0">' . $footer . '</p>
            </div>
        ';
    }

    public function renderHtmlUI()
    {
        return '
        <ul class="nav nav-pills my-5">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/user">Profile home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/user/orders">My Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/user?do=logout">Logout</a>
          </li>
        </ul>
      ';
    }
}
