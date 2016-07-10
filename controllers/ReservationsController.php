<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Reservation;
use yii\data\ActiveDataProvider;

class ReservationsController extends Controller
{
    
    public function actionGrid()
    {
        $query = Reservation::find();

        if(isset($_GET['Reservation']))
        {
            $query->andFilterWhere([
                'customer_id'=>isset($_GET['Reservation']['customer_id'])?$_GET['Reservation']['customer_id']:null,
            ]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('grid',['dataProvider' => $dataProvider]);
    }

    public function actionDetailDependentDropdown()
    {
//      echo "life ";exit;
      $showDetail = false;

      $model = new Reservation();

      if(isset($_POST['Reservation']))
      {
        $model->load(Yii::$app->request->post());
        if(isset($_POST['Reservation']['id']) && ($_POST['Reservation']['id']!=null))
        {
          $model = Reservation::findOne($_POST['Reservation']['id']);
          $showDetail = true;
        }
      }
      return $this->render('detailDependentDropdown',['model'=>$model,'showDetail'=>$showDetail]);
    }

    public function actionAjaxDropDownListByCustomerId($customer_id)
    {
      $output = '';
      $items = Reservation::findAll(['customer_id'=>$customer_id]);
      foreach($items as $item)
      {
        $content = sprintf('Reservation #%s at %s' ,$item->id,data('Y-m-d H:i:s',strtotime($item->reservatioin_date)));
        $output .= \yii\helpers\Html::tag('option',$content,['value'=>$item->id]);
      }
      return $output;
    }

    public function getDescription()
    {
      $content = sprintf('reservation #%s at %s',$this->id,date('Y-m-d H:i:s',strtotime($this->reservation_date)));
      return $content;
    }
}
