<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Mailing */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mailing-form">

    <?php $form = ActiveForm::begin(["options"=>[
        "data-disabled" => ( $model->paused == 1 ? '0' : '1' )
    ]]); ?>

    <div class="profile">
        <div class="tabbable-line tabbable-full-width">
            <?= $this->render("//mailing/steps", ["step"=>$step, "model_id" => ( $model->isNewRecord ? '' : $model->id )]) ?>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">

                    <?= $this->render("userslist", [
                        "usersdataProvider" => $usersdataProvider,
                        "mailingusers" => $mailingusers,
                    ]) ?>



                    <p>&nbsp;</p>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <?= Html::submitButton("Next step &rarr;", ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
