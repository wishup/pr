<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Update Administrator: ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Administrators', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <div class="form-group">
            <label>Roles</label>
            <?= Html::dropDownList('roles[]', $seleditems, $roleitems, ["multiple"=>"multiple", "class"=>"form-control"]) ?>
        </div>

        <?= $form->field($infomodel, 'first_name')->textInput() ?>
        <?= $form->field($infomodel, 'last_name')->textInput() ?>
        <?= $form->field($model, 'email')->textInput() ?>

        <div class="form-group">
            <label>Password</label>
            <?= Html::passwordInput('password', '', ["class"=>"form-control"]) ?>
            <div class="help-block"><small>Leave blank if you don't want to change the password</small></div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
