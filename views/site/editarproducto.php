<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\widgets\GridView;
?>
<div class="site-login">
	<div class="x_title">
        	<div class="col-md-6 text-left"> 
        		<h2><i class="fa fa-edit"></i>Editar Indicador</h2>
				<a class="btn btn-primary btn-sm" href="<?=url::toRoute("listadoproducto")?>">
					<big><i class="glyphicon glyphicon-arrow-left"></i></big> Volver</a>
			</div>
        <div class="clearfix"></div>
    </div><br>
    <h3><?= $msj ?></h3>
    <?php $form = ActiveForm::begin([
        'id' => 'mision-form',
        'layout' => 'horizontal',
    ]); ?>
        <div class='row'>
            <div class='col-md-6'>
                <?= $form->field($model, 'nombre')->input(['autocomplete'=>'off']) ?>
            </div>
            <div class='col-md-6'>
                <?= $form->field($model, 'categoria')->input(['autocomplete'=>'off']) ?>
            </div>
        </div> 
        <div class='row'>
            <div class='col-md-6'>
                <?= $form->field($model, 'precio')->input(['autocomplete'=>'off']) ?>
            </div>
            <div class='col-md-6'>
                <?= $form->field($model, 'peso')->input(['autocomplete'=>'off']) ?>
            </div>
        </div> 
        <div class='row'>
            <div class='col-md-6'>
                <?= $form->field($model, 'stock')->input(['autocomplete'=>'off']) ?>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-12 text-center'>
                <?= $form->field($model, 'Referencia')->input(['autocomplete'=>'off']) ?>
            </div>
        </div>  
        <div class='row'>
            <div class='col-md-12 text-center'>   
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success', 'name' => 'guardar']) ?>
            </div>
        </div>
        <br><h3><?= $msj ?></h3>
        <div class='row'>
        </div><br>
    <?php ActiveForm::end(); ?>
</div>