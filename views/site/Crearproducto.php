<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\widgets\GridView;
?>
<div class="site-login">
	<div class="x_title">
        <h2><i class="fa fa-edit"></i>Crear Indicadores</h2>
        <div class="clearfix"></div>
    </div><br>
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
                    <?= Html::submitButton('Crear Producto', ['class' => 'btn btn-success', 'name' => 'guardar']) ?>
            </div>
        </div>
        <br><h3><?= $msj ?></h3>
    <?php ActiveForm::end(); ?>
</div>
<div class="body-content">
    <div class="site-login">
        <div class="x_title">
            <h2><i class="fa fa-edit"></i>Listado de Productos</h2>
            <div class="clearfix"></div>
        </div><br>
        <table class="table table-hover">
            <tr>
                <th>Id</th>   
                <th>Categoria</th>
                <th>Nombre Producto</th>
                <th>Referencia</th>
                <th>Precio</th>
                <th>Peso</th>
                <th>Stock</th>
                <th>Fecha creacion</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
            <?php foreach($modelprod as $row){ ?>
                <tr>
                    <td><?= $row->id?></td>
                    <td><?= $row->nombre?></td>
                    <td><?= $row->categoria?></td>
                    <td><?= $row->Referencia?></td>
                    <td><?= "$ ".number_format($row->precio)?></td>
                    <td><?= $row->peso?></td>
                    <td><?= $row->stock?></td>
                    <td><?= $row->fecha_creación?></td>
                    <td>
                        <a href="<?=url::toRoute(["editarproducto","id"=>$row->id])?>" ><big><i class="glyphicon glyphicon-pencil"></i></big></a>
                    </td>
                    <td>
                        <a href="<?=url::toRoute(["eliminarproducto","id"=>$row->id])?>" ><big><i class="glyphicon glyphicon-trash"></i></big></a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>