<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model backend\models\MailingTemplates */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mailing-templates-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php
    $this->registerJsFile("/backend/js/tinymce_plugin.js", ["depends"=>"dosamigos\\tinymce\\TinyMceAsset"]);
    $this->registerJsFile("/backend/js/tinymce_email_preview_plugin.js", ["depends"=>"dosamigos\\tinymce\\TinyMceAsset"]);
    ?>
    <?= $form->field($model, 'message')->widget(TinyMce::className(), [
        'options' => ['rows' => 10],
        'clientOptions' => [
            'relative_urls' => false,
            'remove_script_host' => false,
            'convert_urls' => false,
            'plugins' => [
                'bb_media bb_email_preview advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools'
            ],
            'toolbar1' => "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image bb_media",
            'toolbar2' => "print preview media | forecolor backcolor bb_email_preview",
        ]
    ]) ?>
    <h4>Insert Keywords</h4>
    <div class="row">
        <?php
        $keywords = \common\models\Mailing::emailParamsInfo(\common\models\Users::find()->one(), $model);

        foreach ($keywords as $keyword) {
            ?>
            <div class="col-sm-1">
                <a href="#" class="mailing_keyword btn btn-info btn-xs"
                   data-keyword="<?= $keyword["key"] ?>"><?= $keyword["label"] ?></a>
            </div>
        <?php
        }
        ?>
    </div>
    <p>&nbsp;</p>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
    if( !$model->isNewRecord ) {
        ?>

        <p>&nbsp;</p>

        <h3>Send test email</h3>

        <?= Html::beginForm("/backend/mailingtemplates/sendtest/".$model->id, "post") ?>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-3">
                    <label>Email</label>
                    <?= Html::input("email", "email", "", ["class" => "form-control"]) ?>
                </div>
                <div class="col-sm-1">
                    <label>&nbsp;</label>
                    <?= Html::submitInput("Send", ["class" => "form-control btn btn-primary"]) ?>
                </div>
            </div>
        </div>

        <?= Html::endForm() ?>

    <?php
    }
    ?>

</div>
