<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\widgets\GridView;
?>
<div class="site-login">
	<div class="x_title">
        <h2><i class="fa fa-edit"></i>Vender Producto</h2>
        <div class="clearfix"></div>
    </div><br>
    <?php $form = ActiveForm::begin([
        'id' => 'mision-form',
        'layout' => 'horizontal',
    ]); ?>
    	<div class='row'>
            <div class='col-md-5'>
                <?= $form->field($model, 'id_producto')->input(['autocomplete'=>'off']) ?>
            </div>
            <div class='col-md-5'>
                <?= $form->field($model, 'cantidad')->input(['autocomplete'=>'off']) ?>
            </div>
            <div class='col-md-2'>   
                    <?= Html::submitButton('Vender', ['class' => 'btn btn-success', 'name' => 'Vender']) ?>
            </div>
        </div> 
          <br><h3><?= $msj ?></h3>
    <?php ActiveForm::end(); ?>
</div>