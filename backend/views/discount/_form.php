<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Discount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="discount-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'discount_type')->dropDownList([''=>'', 'fixed'=>'Fixed', 'percent'=>'Percent']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'amount')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'limit')->textInput() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'usage')->textInput(['disabled'=>'disabled']) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'per_type')->radioList(Yii::$app->params['discount_per_types']) ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
