<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Glossary */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="glossary-form">
    <div class="row">
        <div class="col-sm-8">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'status')->dropDownList(['draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived']) ?>
            <?= $form->field($model, 'word')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'acronim')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-sm-4">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Configurations</div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <?= $form->field($model, 'exclude_from_search')->checkbox(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
