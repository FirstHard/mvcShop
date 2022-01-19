<?php

namespace App\Core;

use Framework\Api;

class IndexApi extends Api
{
    public function actionIndex()
    {
        return $this->response(['Connection established. Awaiting your requests.'], 200);
    }

    public function actionView()
    {
    }

    public function actionCreate()
    {
    }

    public function actionUpdate()
    {
    }

    public function actionDelete()
    {
    }
}