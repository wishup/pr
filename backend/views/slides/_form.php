<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Slides */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slides-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'slide')->fileInput() ?>
    <?php if(isset($model['slide'])):?>
        <p><?php echo $model['slide'];?></p>
    <?php endif;?>
    <?= $form->field($model, 'link')->textInput(); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' =>  'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
