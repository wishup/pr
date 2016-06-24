<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ResourcesCategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resources-categories-form">

    <?php $form = ActiveForm::begin(["options" => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'subtitle')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row margin-bottom20">

        <div class="col-sm-12">
            <?= $form->field($model, 'image')->fileInput() ?>
            <?php
            if( $model->image ){
                ?>
                <div><img src="<?= \common\components\attachments::getThumbnailUrl( '/upload/resources/'.$model->image, 168, 104, 'CROP' ) ?>"> </div>
                <div><a href="/backend/resources-categories/delthumb?id=<?= $model->id ?>" class="btn btn-danger btn-xs" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0">Delete</a> </div>
            <?php
            }
            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
