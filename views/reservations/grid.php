<?php
use yii\grid\GridView;
use yii\helpers\Html;
?>

    <h2>Customers</h2>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns'=>[
        'id',
        'room_id',
        'customer_id',
        'price_per_day',
        'date_from'
    ],
]) ?>