<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class ThreeColumnsController extends Controller
{
    public function actionIndex()
    {
//        echo "life";exit;
        return $this->render('index');
    }
}