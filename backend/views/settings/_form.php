<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Settings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'facebook_api_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'facebook_api_secret_key')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'facebook_link')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'twitter_link')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'footer_copyrights')->textarea(['maxlength' => true]) ?>
    <?= $form->field($model, 'google_analytics')->textarea(['maxlength' => true, "rows"=>"5"]) ?>
    <?= $form->field($model, 'favicon')->fileInput() ?>
    <?php if(isset($model['favicon'])):?>
        <p><?php echo $model['favicon'];?></p>
    <?php endif;?>
    <?= $form->field($model, 'notification_email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'notification_email_bcc')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
