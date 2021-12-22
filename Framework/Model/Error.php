<?php

namespace Framework\Model;

use App\Model;

class Error extends Model
{
    public function getErrorInfo($code): array
    {
        $data = [];
        switch ($code) {
            case 404:
                $data['headers']['pageTitle'] = 'Error ' . $code;
                $data['headers']['siteTitle'] = 'Project MVC The Shop';
                $data['code'] = $code;
                $data['status'] = 'Not Found';
                $data['main_content'] = '<h3>Sorry, the page you requested was not found on our site. Please use the search, or go to the Main page.</h3>';
                break;
            default:
                $data['headers']['pageTitle'] = 'Unknown error';
                $data['headers']['siteTitle'] = 'Project MVC The Shop';
                $data['code'] = 500;
                $data['status'] = 'Server error';
                $data['main_content'] = '<h3>Sorry, an unknown error has occurred. Our administrators are already working on fixing it. Please check back on our website a little later.</h3>';
        }
        return $data;
    }
}
