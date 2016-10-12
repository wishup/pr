<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PostComments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-comments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $posts = \common\models\Posts::find()->indexBy("id")->orderBy("date desc")->all();

    $postitems = [];

    foreach( $posts as $post )
        $postitems[ $post->id ] = $post->name;
    ?>

    <?= $form->field($model, 'post_id')->dropDownList($postitems) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'answer')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([0 => "Inactive", 1=>"Active"]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
