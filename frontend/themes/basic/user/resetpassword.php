<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\components\LiveEdit;

?>
<div class="signin-block inner-wrapper container-lg text-center">
    <h2 class="title text-featured text-center"><?php echo LiveEdit::text(__FILE__, 'Reset password') ?></h2>

    <p>
        <?php echo LiveEdit::text(__FILE__, "Enter your new password bellow") ?>
    </p>

    <?php $form = ActiveForm::begin(); ?>
    <div class="row text-center">
        <div class="col-sm-6 col-sm-offset-3">
            <?= $form->field($model, 'newpass', ['template' => '{input}{error}', 'inputOptions' => [
                'placeholder' => 'New Password'
            ], "options" => ["class" => "form-group"]])->passwordInput() ?>
            <?= $form->field($model, 'repeatnewpass', ['template' => '{input}{error}', 'inputOptions' => [
                'placeholder' => 'Repeat New Password'
            ], "options" => ["class" => "form-group"]])->passwordInput() ?>
        </div>

        <div class="form-group">
            <div class=" col-lg-12">
                <?= Html::submitButton('Submit', [
                    'class' => 'btn btn-success'
                ]) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>