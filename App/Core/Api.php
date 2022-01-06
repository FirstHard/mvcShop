<?php

namespace App\Core;

use App\Core\Db;
use Exception;
use RuntimeException;

abstract class Api
{
    public $apiName = '';
    public $param;

    protected $method = ''; // GET|POST|PUT|DELETE

    public $requestUri = [];
    public $requestParams = [];

    public $action = ''; // The name of the method to be executed

    protected $db = '';


    public function __construct()
    {
        $this->db = Db::getInstance();
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");
        $this->requestParams = $_REQUEST;
        $this->method = $_SERVER['REQUEST_METHOD'];
        if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                $this->method = 'DELETE';
            } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                $this->method = 'PUT';
            } else {
                throw new Exception("Unexpected Header");
            }
        }
    }

    public function run()
    {
        $this->action = $this->getAction();

        // If method (action) is defined in child API class
        if (method_exists($this, $this->action)) {
            return $this->{$this->action}();
        } else {
            throw new RuntimeException('Invalid Method', 405);
        }
    }

    protected function response($data, $status = 500)
    {
        header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
        return json_encode($data);
    }

    private function requestStatus($code)
    {
        $status = [
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        ];
        return ($status[$code]) ? $status[$code] : $status[500];
    }

    protected function getAction()
    {
        $method = $this->method;
        switch ($method) {
            case 'GET':
                if ($this->param) {
                    return 'actionView';
                } else {
                    return 'actionIndex';
                }
                break;
            case 'POST':
                return 'actionCreate';
                break;
            case 'PUT':
                return 'actionUpdate';
                break;
            case 'DELETE':
                return 'actionDelete';
                break;
            default:
                return null;
        }
    }

    abstract protected function actionIndex();
    abstract protected function actionView();
    abstract protected function actionCreate();
    abstract protected function actionUpdate();
    abstract protected function actionDelete();
}
