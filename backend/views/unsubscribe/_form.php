<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Unsubscribe */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unsubscribe-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?php
    $groupmodels = \common\models\EmailGroups::find()->orderBy("title")->all();
    $group_items = [0=>''];
    foreach( $groupmodels as $groupmodel )
        $group_items[ $groupmodel->id ] = $groupmodel->title;
    ?>
    <?= $form->field($model, 'group_id')->dropDownList($group_items) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
