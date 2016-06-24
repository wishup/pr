<?php
use yii\helpers\Html;
use common\components\LiveEdit;
?>
    <h2 class="title text-featured text-center"><?php echo LiveEdit::text(__FILE__, 'Bible Bee Host Account')?></h2>
<div class="have-account col-sm-6">
    <h3 class="caption text-primary2  sep-bottom -sm"><?php echo LiveEdit::text(__FILE__, 'I have an Account')?></h3>
    <?= Html::beginForm('', 'post', ["class" => "login-form"]) ?>
    <div class="form-group">
        <?= Html::textInput('email', ( Yii::$app->request->post("auth") && Yii::$app->request->post("email") ) ? Yii::$app->request->post("email") : '', ["class" => "form-control login_inp_email", "placeholder" => "email address"]) ?>
    </div>
    <div class="form-group">
        <?= Html::passwordInput('password', '', ["class" => "form-control login_inp_password", "placeholder" => "password"]) ?>
    </div>

    <div class="sign-controls">
        <?= Html::button('Login',  ["class" => "btn btn-success login_btn", "name" => "auth", "type" => "submit"]) ?>
        <div class="login-help">
            <a href="/user/forgot">Forgot password?</a>
        </div>
    </div>
    <?= Html::endForm() ?>
    <div class="sep -circle">or</div>
    <div class="gplus-item fb-login <?= isset($_GET["fbloginerr"]) ? 'has-error tipsy tipsy--n' : '' ?>" <?= isset($_GET["fbloginerr"]) ? 'data-tipsy="'.LiveEdit::text(__FILE__, 'Your Google account is not recognized. Please create a Bible Bee account and then link it to your Google account.').'"' : '' ?>>
        <a href="/user/gauth?authclient=google" class="login-btn btn">
            <i class="icon-google-plus"></i>
            <span>Login with <strong>Google</strong></span>
        </a>
        <div class="fb-login-notice"><?php echo LiveEdit::text(__FILE__, 'We will never post anything without your permission.')?></div>
    </div>
</div>
<?= Html::beginForm('', 'post', ["class" => "need-account col-sm-6"]) ?>
    <h3 class="caption text-primary2  sep-bottom -sm"><?php echo LiveEdit::text(__FILE__, 'I need an account')?></h3>
<p class="welcome-txt">
    <strong class="text-featured"><?php echo LiveEdit::text(__FILE__, 'Welcome!')?></strong> <?php echo LiveEdit::text(__FILE__, 'We are thrilled to help you explore Bible Bee!')?>
</p>
<div class="form-group">
    <?= Html::textInput('email', ( Yii::$app->request->post("get_started") && Yii::$app->request->post("email") ) ? Yii::$app->request->post("email") : '', ["class" => "form-control get_started_popup_email", "placeholder" => "email", "autocomplete" => "new-password"]) ?>
    <?= Html::hiddenInput('family_reg_url', \yii\helpers\Url::toRoute('/user/familydirectregistration'), ['id'=>'family_reg_url']) ?>
</div>

<div class="form-group">
    <label class="form-control-radio" for="family-radio"><input type="radio" id="family-radio" class="get_started_popup_type" name="user_type" value="family" checked /><span></span>Parent / Contestant</label>
    <label class="form-control-radio" for="host-radio"><input type="radio" id="host-radio" class="get_started_popup_type" name="user_type" value="host"  /><span></span>Host</label>
</div>

<p class="welcome-txt">Select one account type now. You can add another later.</p>

<?= Html::button('Get started',  ["class" => "btn btn-success get_started_popup_btn"]) ?>
<?= Html::endForm() ?>