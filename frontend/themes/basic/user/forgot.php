<?php
use yii\helpers\Html;
use common\components\LiveEdit;
?>
<div class="signin-block inner-wrapper container-lg text-center">
    <h2 class="title text-featured text-center"><?php echo LiveEdit::text(__FILE__, 'Forgot your password?')?></h2>
    <h3 class="caption text-primary2"><?php echo LiveEdit::text(__FILE__, 'Let us help you')?></h3>
    <p >
        <?php echo LiveEdit::text(__FILE__, "Enter your email address below and we'll send you password reset instructions")?>
    </p>
    <?= Html::beginForm('/user/forgot', 'post', ["class" => "forgot-pass send_ajax", "id"=>"forgot_pass_form", "data-callback" => "forgot_pass_callback", "data-id-prefix" => "user"]) ?>
        <input type="hidden" name="forgot_pass" value="1">
        <div class="form-group">
            <?= Html::textInput('email', '', ["class" => "form-control", "placeholder" => "email", "type" => "email", "id" => "user-email"]) ?>
            <span class="help-block"></span>
        </div>
        <input type="submit" class="btn btn-success" value="Submit">
    <?= Html::endForm() ?>

</div>