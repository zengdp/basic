<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\Customer;
use app\models\Reservation;
?>
<?php
$urlReservationByCustomer = Url::to(['reservations/ajax-drop-down-list-by-customer-id']);
$this->registerJs(<<< EOT_JS
$(document).on('change','#Reservation-customer_id',function(ev){
$('#detail').hide();

var customerId = $(this).val();

$.get(
        '{$urlReservationByCustomer}',
        {'customer_id':customerId},
        function(data){
        data = '<option value="">---choose</option>'+data;
        $('#reservation-id').html(data);
        }
    )

    ev.preventDefault();
});

    $(document).on('change','#reservation-id',function(ev){
    $(this).parents('form').submit();
    ev.preventDefault();
    });

EOT_JS
);

?>

<div class="customer-form">
  <?php $form = ActiveForm::begin(['enableAjaxValidation'=>false,'enableClientValidation'=>false,'options'=>['data-pjax'=>'']]); ?>
  <?php $customers = Customer::find()->all(); ?>
  <?= $form->field($model,'customer_id')->dropDownList(ArrayHelper::map($customers,'id','name','surname'),['prompt'=>'---choose']) ?>
  <?php $reservations = Reservation::findAll(['customer_id'=>$model->customer_id]); ?>
  <?= $form->field($model,'id')->label('Reservation ID')->dropDownList(ArrayHelper::map($reservations,'id',function($temp,$defaultValue){
    $content  = sprintf('reservation #%s at %s',$temp->id,date('Y-m-d H:i:s',strtotime($temp->reservation_date)));
    return $content;
  }),['prompt'=>'---choose']); ?>

  <div id="detail">
    <?php if($showDetail) { ?>
      <hr/>
      <h2>reservation Detail:</h2>
      <table>
        <tr>
          <td>Price per day</td>
          <td><?php echo $model->price_per_day ?> </td>
        </tr>
      </table>
      <?php } ?>
  </div>

    <?php ActiveForm::end(); ?>
</div>
