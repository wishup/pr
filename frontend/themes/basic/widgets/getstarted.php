<?php
use common\components\LiveEdit;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

if( $type == 'host' ) {
    ?>
    <section class="newsletter-section text-center">
        <div class="container">
            <h2 class="caption text-brown"><?= LiveEdit::text(__FILE__, 'Get started now - It\'s easy!') ?></h2>

            <?= Html::beginForm('', 'post', ["class" => "newsletter-form form-inline"]) ?>
            <div class="form-group">
                <?= Html::textInput('email', ( Yii::$app->request->post("get_started") && Yii::$app->request->post("email") ) ? Yii::$app->request->post("email") : '', ["class" => "form-control get_started_popup_email", "placeholder" => "email"]) ?>

            </div>
            <?= Html::button('Submit<i class="icon-arrow-right"></i>',  ["class" => "btn btn-success btn-lg get_started_popup_btn", "style"=>"vertical-align:top"]) ?>
            <?= Html::endForm() ?>

        </div>
    </section>

    <div id="getStartedPopup" class="get-started-popup-wrap mfp-hide">
        <div class="get-started-popup popup-block popup-has-close main-box text-center popup-step3 getstarted-popup">
            <h2 class="heading-md color-featured"><?php echo LiveEdit::text(__FILE__, 'Account information was successfully sent')?></h2>
            <hr class="line-sm">
            <h3 class="heading-xs color-primary2 text-uppercase"><?php echo LiveEdit::text(__FILE__, 'Please Verify Your Email Account')?></h3>
            <hr class="line-xs">
            <p class="color-primary2"><?php echo LiveEdit::text(__FILE__, 'You will receive an email to the address you provided. Please click on the link provided in that email to continue.')?></p>
        </div>
    </div>
<?php
}

if( $type == 'family' ) {
    ?>
    <section class="newsletter-section">
        <div class="container">
            <div class="text-center color-primary2">
                <h2 class="heading-light-md color-warning2"><?= LiveEdit::text(__FILE__, 'Registration for the summer study is') ?></h2>
                <h3 class="heading-lg"><?= LiveEdit::text(__FILE__, '$25/Student') ?></h3>
                <p class="mg-btm-0"><strong><?= LiveEdit::text(__FILE__, 'Beginners Study - $5') ?></strong> <?= LiveEdit::text(__FILE__, '(ages 6 and under)') ?></p>
                <p class="mg-btm-0"><strong><?= LiveEdit::text(__FILE__, 'Family discount') ?></strong><?= LiveEdit::text(__FILE__, ' - if you register four students for $25 each,') ?></p>
                <p><?= LiveEdit::text(__FILE__, 'the rest of your students are $5!') ?></p>
                <a href="<?php echo Yii::$app->urlManager->createUrl('/user/familydirectregistration/'); ?>"  class="btn btn-lg btn-success"><?= LiveEdit::text(__FILE__, 'Register now - it\'s easy!') ?><i class="icon-arrow-right"></i></a>
            </div>
        </div>
    </section>
<?php
}
