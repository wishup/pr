<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\ShopCategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shop-categories-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    $items = [
        0 => ""
    ];

    function getCats( &$items, $parent=0, $level=0, $ignorecat_id = 0 ){

        if( $cats = \common\models\ShopCategories::find()->where("parent_id=".$parent)->orderBy("name")->all() ){

            foreach( $cats as $cat ){

                if( $cat->id == $ignorecat_id ) continue;

                $suff = '';

                for( $i=0; $i<$level; $i++ ){
                    $suff .= '     ';
                }

                $items[ $cat->id ] = $suff.$cat->name;

                getCats($items, $cat->id, $level+1, $ignorecat_id);

            }

        }

    }

    getCats( $items, 0, 0, $model->isNewRecord ? 0 : $model->id );
    ?>
    <?= $form->field($model, 'parent_id')->dropDownList( $items, ['encodeSpaces'=>true] ) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
    $this->registerJsFile("/backend/js/tinymce_plugin.js", ["depends"=>"dosamigos\\tinymce\\TinyMceAsset"]);
    ?>
    <?= $form->field($model, 'description')->widget(TinyMce::className(), [
        'options' => ['rows' => 10],
        'clientOptions' => [
            'relative_urls' => false,
            'remove_script_host' => false,
            'convert_urls' => false,
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

    <?= $form->field($model, 'image')->fileInput() ?>

    <?php
    if( $model->image ){
       ?>
        <div>
            <img src="<?= \common\components\attachments::getThumbnailUrl( '/upload/'.$model->image, 150, 150, 'AUTO' ) ?>">
        </div>
        <div style="margin-top:5px;"><a href="/backend/shopcategories/delimg/<?= $model->id ?>" class="btn btn-danger btn-sm">Delete</a> </div>
        <p>&nbsp;</p>
        <?php
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
