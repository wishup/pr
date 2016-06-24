<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Mailing */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mailing-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="profile">
        <div class="tabbable-line tabbable-full-width">
            <?= $this->render("//mailing/steps", ["step"=>$step, "model_id" => ( $model->isNewRecord ? '' : $model->id )]) ?>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">

                    <iframe frameborder="0" allowtransparency="1" width="100%" height="600" marginheight="0" marginwidth="0" src="/backend/mailing/preview/<?= $model->id ?>"></iframe>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="hidden" name="submit_preview" value="1">
                                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Next step &rarr;', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
