<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Button;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'My profile';
$this->params['breadcrumbs'][] = 'My profile';
?>
<div class="user-update">

    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'email')->textInput() ?>
        <?= $form->field($infomodel, 'first_name')->textInput() ?>
        <?= $form->field($infomodel, 'last_name')->textInput() ?>
        <div class="form-group field-user-email">
            <label class="control-label" for="user-email">Password</label>
            <?php echo Html::input('password', 'password','', ['class' => 'form-control', 'id' => 'new-pass']);?>
            <div class="help-block"></div>
        </div>
        <div class="form-group field-user-email">
            <?php
            echo Button::widget([
                'label' => 'Generate Password',
                'options' => ['class' => 'generate-user-pass'],
            ]);
            ?>
            <span id="new-pass-show"></span>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
