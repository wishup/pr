<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\LiveEditTexts */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Update Live Edit Texts';
$this->params['breadcrumbs'][] = "Live Edit Texts";
?>

<div class="live-edit-texts-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <label>Content</label>
    <?php
    if( Yii::$app->request->get("format") == 'wysiwyg' ) {
        $this->registerJsFile("/backend/js/tinymce_plugin.js", ["depends" => "dosamigos\\tinymce\\TinyMceAsset"]);

        echo TinyMce::widget(['name' => 'field_value', 'value' => $field_val, 'options' => ['data-default' => $field_val, "data-wysiwyg" => '1', "style" => "height:200px"], 'clientOptions' => [
            'plugins' => [
                'bb_media advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools'
            ],
            'toolbar1' => "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image bb_media",
            'toolbar2' => "print preview media | forecolor backcolor",
            "content_css" => "/css/main.min.css"
        ]]);

    } else {

        ?>
        <div class="form-group">
            <?= Html::textarea('field_value',$field_val,["class" => "form-control", "rows" => "10"]) ?>
        </div>
        <?php

    }
    ?>
    </div>

    <div class="form-group margin-top20">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
