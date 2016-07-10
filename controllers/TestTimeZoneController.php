<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class TestTimeZoneController extends Controller
{
    public function actionCheck()
    {
        $dt = new \DateTime();
        echo 'Current date\time:'.$dt->format('Y-m-d H:i:s');
        echo '<br/>';
        echo 'Current timezone:'.$dt->getTimezone()->getName();
        echo '<br/>';
    }
}