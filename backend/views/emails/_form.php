<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Emails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="emails-form">

    <?php $form = ActiveForm::begin(["options"=>["enctype"=>"multipart/form-data"]]); ?>



    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'from_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'from_email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'to_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'to_email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'priority')->dropDownList([
                '' => '',
                1 => 'Low',
                10 => 'Normal',
                20 => 'High',
                30 => 'Very high',
            ]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'send_date')->textInput(["class"=>"date-picker form-control"]) ?>
        </div>
    </div>


    <?= $form->field($model, 'content')->widget(TinyMce::className(), ['options' => ['rows' => 10]]) ?>

    <?= $form->field($model, 'attachments[]')->fileInput(["multiple"=>"multiple"]) ?>

    <p>
        <?php
        if( $model->attachments ){

            $attachments = unserialize($model->attachments);

            foreach ($attachments as $att){

                ?>

                <div><a href="<?= $att["base_url"] ?>"><?= $att["filename"] ?></a></div>
                <?php

            }

        }
        ?>
    </p>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
