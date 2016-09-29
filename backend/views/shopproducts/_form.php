<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ShopProducts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shop-products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $items = [];

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

    getCats( $items, 0, 0, 0 );
    ?>

    <div class="form-group">
        <label>Categories</label>
        <?= Html::dropDownList('categories[]', $model->isNewRecord ? [] : \yii\helpers\ArrayHelper::map(\common\models\ShopProdCat::find()->where("product_id=".$model->id)->all(), 'category_id', 'category_id'), $items, ['encodeSpaces'=>true, 'multiple' => true, 'class'=>'form-control', 'size' => 10]) ?>
    </div>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
    $this->registerJsFile("/backend/js/tinymce_plugin.js", ["depends"=>"dosamigos\\tinymce\\TinyMceAsset"]);
    ?>
    <?= $form->field($model, 'description')->widget(\dosamigos\tinymce\TinyMce::className(), [
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

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'price')->textInput() ?>
        </div>
    </div>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?php
    if( $model->image ){
        ?>
        <div>
            <img src="<?= \common\components\attachments::getThumbnailUrl( '/upload/'.$model->image, 150, 150, 'AUTO' ) ?>">
        </div>
        <div style="margin-top:5px;"><a href="/backend/shopproducts/delimg/<?= $model->id ?>" class="btn btn-danger btn-sm">Delete</a> </div>
        <p>&nbsp;</p>
    <?php
    }
    ?>


    <?php
    if( $attributes = \common\models\ShopProductsAttributes::find()->orderBy("name")->all() ){

        ?>
        <p>&nbsp;</p>
        <h3>Attributes</h3>
        <?php

        foreach( $attributes as $attribute ){

            ?>
            <div class="row">
                <div class="col-sm-2">
                    <?= $attribute->name ?>
                </div>
                <div class="col-sm-4">
                    <?php
                    if( !$model->isNewRecord ){
                        if( $prodattr = \common\models\ShopProductsAttrVals::find()->where("product_id=".$model->id." and attribute_id=".$attribute->id)->one() ){
                            $val = $prodattr->value;
                        } else
                            $val = '';

                    } else
                        $val = '';
                    ?>
                    <div class="form-group">
                        <?= Html::textInput("attributes[".$attribute->id."]", $val, ["class" => "form-control"]) ?>
                    </div>
                </div>
            </div>
            <?php

        }

    }
    ?>
    <p>&nbsp;</p>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
