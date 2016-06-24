<?php
use yii\helpers\Html;
use common\components\LiveEdit;
?>
<div class="registration-block main-box text-center col-sm-7">
    <i class="email-icon"></i>
    <h2 class="h4 bottom-border -md"><?php echo LiveEdit::text(__FILE__, 'Thank you. Your email has been verified.')?></h2>
    <h6><?php echo LiveEdit::text(__FILE__, 'Now, can you tell us a bit more about yourself?')?></h6>
    <?= Html::beginForm('', 'post', ["class" => "registration-form"]) ?>
        <div class="block-sm-2">
            <div class="form-group <?= isset($errors["first_name"]) ? 'tipsy tipsy--n has-error' : '' ?>" data-tipsy="<?= isset($errors["first_name"]) ? $errors["first_name"] : '' ?>">
                <?= Html::textInput('first_name', ( Yii::$app->request->post("first_name") ) ? Yii::$app->request->post("first_name") : '', ["class" => "form-control", "placeholder" => "First Name"]) ?>
            </div>
            <div class="form-group <?= isset($errors["last_name"]) ? 'tipsy tipsy--n has-error' : '' ?>" data-tipsy="<?= isset($errors["last_name"]) ? $errors["last_name"] : '' ?>">
                <?= Html::textInput('last_name', ( Yii::$app->request->post("last_name") ) ? Yii::$app->request->post("last_name") : '', ["class" => "form-control", "placeholder" => "Last Name"]) ?>
            </div>
        </div>
        <hr class="divider">
        <div class="form-group <?= isset($errors["password"]) ? 'tipsy tipsy--n has-error' : '' ?>" data-tipsy="<?= isset($errors["password"]) ? $errors["password"] : '' ?>">
            <?= Html::passwordInput('password', '', ["class" => "form-control", "placeholder" => "Create Password"]) ?>
        </div>
        <div class="form-group <?= isset($errors["password_confirm"]) ? 'tipsy tipsy--n has-error' : '' ?>" data-tipsy="<?= isset($errors["password_confirm"]) ? $errors["password_confirm"] : '' ?>">
            <?= Html::passwordInput('password_confirm', '', ["class" => "form-control", "placeholder" => "Confirm Password"]) ?>
        </div>
        <?= Html::submitInput('Continue to your Free Account',  ["class" => "btn btn-success", "name" => "reg"]) ?>
    <?= Html::endForm() ?>
    <div class="sep -circle center-block">or</div>
    <div class="fb-login">
        <a href="/user/fbauth?authclient=facebook" class="login-btn btn">
            <i class="icon-facebook"></i>
            <span>Login with <strong>Facebook</strong></span>
        </a>
    </div>
</div>