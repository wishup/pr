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
                    <?php
                    if( $model->paused == 1 ) {
                        ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <?php
                                    if ($model->validate() && count($mailingusers) > 0) {
                                        ?>
                                        <input type="hidden" name="send_email" value="1">
                                        <?php
                                        echo Html::submitButton("Send", ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);

                                    } else {
                                        ?>
                                        <div class="text-danger">
                                            <i class="fa fa-warning"></i> For sending the emails, please select users
                                            and/or fill the mandatory fields of template.
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <h4>Once you hit the "Send" button, your email will be send to the following email
                            addresses.</h4>
                    <?php
                    } else {
                        if( $model->finished == 0 ){

                            ?>
                            <h4>Sent <?= count($mailinguserssent) ?> of <?= count($mailingusers) ?> users</h4>
                            <?php

                        } else {

                            ?>
                            <h4>Finished!</h4>
                            <?php

                        }
                    }
                    ?>
                    <hr class="light">
                    <div class="row">
                        <?php
                        if( $mailingusers )
                        foreach( $mailingusers as $muser ){

                            ?>
                            <div class="col-lg-3 col-sm-6 col-xs-12 send_email_to <?= isset( $mailinguserssent[ $muser->user_id ] ) ? 'text-success' : '' ?>">
                                <?= isset( $mailinguserssent[ $muser->user_id ] ) ? '<i class="fa fa-check"></i> ' : '' ?>
                                <?= $muser->user->email ?>
                            </div>
                            <?php

                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
