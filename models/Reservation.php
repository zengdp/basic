<?php

namespace app\models;

class Reservation extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'reservation';
    }
}