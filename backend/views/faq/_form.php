<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use yii\helpers\ArrayHelper;
use common\models\FaqCategories;

/* @var $this yii\web\View */
/* @var $model common\models\Faq */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-form">
    <div class="row">
        <div class="col-sm-8">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'status')->dropDownList(['draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived']) ?>

            <div class="form-group field-faq-status required">
                <label class="control-label" for="faq-id">Category</label>
            <?= Html::dropDownList('category_id', $model->faqcategories ? $model->faqcategories->id : 0,
                ArrayHelper::map(FaqCategories::find()->all(), 'id', 'name'),['class'=>'form-control']) ?>
            </div>
            <?= $form->field($model, 'question') ?>

            <?= $form->field($model, 'answer')->widget(TinyMce::className(), [
                'options' => ['rows' => 10],
                'clientOptions' => [
                    'plugins' => [
                        "advlist autolink lists link charmap print preview anchor",
                        "searchreplace visualblocks code fullscreen",
                        "insertdatetime media table contextmenu paste"
                    ],
                    'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                ]
            ]); ?>

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
