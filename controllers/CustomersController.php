<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Customer;
use yii\data\ActiveDataProvider;

class CustomersController extends Controller
{
    public function actionGrid()
    {
        $query = Customer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 1,
            ],
        ]);

        return $this->render('grid',['dataProvider' => $dataProvider]);
    }
}