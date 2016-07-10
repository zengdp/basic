<?php

namespace app\models;


class Customer extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'customer';
    }

    public function getReservationsCount()
    {
        return $this->hasMany(\app\models\Reservation::className(),['customer_id'=>'id'])->count();
    }
}