<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Messaging */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="messaging-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?php
    $this->registerJsFile("/backend/js/tinymce_plugin.js", ["depends"=>"dosamigos\\tinymce\\TinyMceAsset"]);
    ?>
    <?= $form->field($model, 'message')->widget(TinyMce::className(), [
        'options' => ['rows' => 10],
        'clientOptions' => [
            'relative_urls' => false,
            'remove_script_host' => false,
            'convert_urls' => true,
            'image_advtab' => true,
            'plugins' => [
                'bb_media advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools'
            ],
            'toolbar1' => "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image bb_media",
            'toolbar2' => "print preview media | forecolor backcolor",
        ]
    ]) ?>

    <?= $form->field($model, 'start_at')->textInput([ "class"=>"form-control date-picker"]) ?>

    <?= $form->field($model, 'finish_at')->textInput([ "class"=>"form-control date-picker"]) ?>

    <?= $form->field($model, 'can_close')->checkbox() ?>

    <?= $this->render("//mailing/userslist", [
        "usersdataProvider" => $usersdataProvider,
        "mailingusers" => $mailingusers,
    ]) ?>
<p>&nbsp;</p>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
