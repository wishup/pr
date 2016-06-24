<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Create Administrator';
$this->params['breadcrumbs'][] = ['label' => 'Administrators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <div class="form-group">
            <label>Roles</label>
            <?= Html::dropDownList('roles[]', null, $roleitems, ["multiple"=>"multiple", "class"=>"form-control"]) ?>
        </div>

        <?= $form->field($infomodel, 'first_name')->textInput() ?>
        <?= $form->field($infomodel, 'last_name')->textInput() ?>
        <?= $form->field($model, 'username')->textInput() ?>
        <?= $form->field($model, 'email')->textInput() ?>
        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        <div class="note note-success">
            <p>Super Admin - Add/Edit admin users, Admin access. </p>
            <p>Admin - Admin access.</p>
        </div>
    </div>

</div>
