<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Resources */
/* @var $form yii\widgets\ActiveForm */

$categories = \common\models\ResourcesCategories::find()->orderBy("title, subtitle")->all();

$categories_items = [];

$categories_items[''] = '';

foreach( $categories as $cat )
    $categories_items[ $cat->id ] = $cat->title.( $cat->subtitle ? ' - '.$cat->subtitle : '' );
?>

<div class="resources-form">

    <?php $form = ActiveForm::begin(["options" => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'category_id')->dropDownList($categories_items) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'age_group')->dropDownList(array(''=>'All', 'Beginner' => 'Beginner', 'Junior' => 'Junior', 'Senior' => 'Senior', 'Primary' => 'Primary')) ?>
        </div>
        <div class="col-sm-3">
            <?php
            $versions_items = Yii::$app->params["versions"];
            $versions_items[''] = 'All';
            ?>

            <?= $form->field($model, 'version')->dropDownList($versions_items) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'overlay_text')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row margin-bottom20">

        <div class="col-sm-12">
            <?= $form->field($model, 'thumbnail')->fileInput() ?>
            <?php
            if( $model->thumbnail ){
                ?>
                <div><img src="<?= \common\components\attachments::getThumbnailUrl( '/upload/resources/'.$model->thumbnail, 168, 104, 'CROP' ) ?>"> </div>
                <div><a href="/backend/resources/delthumb/<?= $model->id ?>" class="btn btn-danger btn-xs" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0">Delete</a> </div>
                <?php
            }
            ?>
        </div>
    </div>
    <div class="row margin-bottom20 margin-top40">
        <div class="col-sm-12">
            <input type="checkbox" name="button_type" class="make-switch switch_resource" data-on-color="success" data-off-color="primary" data-size="small" <?= $model->button_type != 'link' ? 'checked' : '' ?> data-off-text="Link"	data-on-text="File">
        </div>
    </div>

    <div class="row file_row" style="display:<?= $model->button_type != 'link' ? 'block' : 'none' ?>">
        <div class="col-sm-12">
            <?= $form->field($model, 'file')->fileInput() ?>
            <?php
            if( $model->file ){
                ?>
                <div><a href="/upload/resources/<?= $model->file ?>" target="_blank"><?= $model->file ?></a> </div>
                <div><a href="/backend/resources/delfile/<?= $model->id ?>" class="btn btn-danger btn-xs" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0">Delete</a> </div>
            <?php
            }
            ?>
        </div>
    </div>

    <div class="row url_row" style="display:<?= $model->button_type == 'link' ? 'block' : 'none' ?>">
        <div class="col-sm-12">
            <?= $form->field($model, 'url')->textInput() ?>
        </div>
    </div>


<p>&nbsp;</p>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
