<?php
use yii\helpers\Html;
use common\components\LiveEdit;
use yii\captcha\Captcha;
use yii\widgets\ActiveForm;
?>
<section class="inner-wrapper container-lg">
    <div class="container">
        <h1 class="title text-featured"><?= LiveEdit::text(__FILE__, 'HAVE A QUESTION?') ?></h1>
        <h2 class="title2"><?= LiveEdit::text(__FILE__, 'For a quick response send us a message below.') ?></h2>
        <div class="col-sm-7  col-sm-offset-2">

                <h3 class="caption text-brown"><?= LiveEdit::text(__FILE__, 'SEND A MESSAGE:') ?></h3>
                <?php
                if( isset($sentEmail) && $sentEmail == 1 ){
                    ?>
                    <p class="text-success" id="message_result">Thank You. Your message has been sent.</p>
                <?php
                }
                ?>
                <?php $form = ActiveForm::begin(["id" => "contact_form"]); ?>
                <?php
                $subject_items = [
                    "" => "Please select",
                    "Study Guide" => "Study Guide",
                    "Contest Day" => "Contest Day",
                    "Online Test" => "Online Test",
                    "Nationals" => "Nationals",
                    "Game Show" => "Game Show",
                    "Hosting" => "Hosting",
                    "Donations" => "Donations",
                    "Volunteer/Internship" => "Volunteer/Internship",
                    "Password Recovery" => "Password Recovery",
                    "Other" => "Other",
                ];
                ?>
                <?= $form->field($model, "subject", ["template" => "{input}{error}"])->dropDownList($subject_items, ["id" => "contact_subject", "class" => "form-control"]) ?>
                <?= $form->field($model, 'first_name', ["template" => "{input}{error}"])->textInput(["id" => "contact_name", "placeholder" => "First name", "class" => "form-control", "autocomplete" => "off"]) ?>
                <?= $form->field($model, 'last_name', ["template" => "{input}{error}"])->textInput(["id" => "contact_last_name", "placeholder" => "Last name", "class" => "form-control", "autocomplete" => "off"]) ?>
                <?= $form->field($model, 'email', ["template" => "{input}{error}"])->textInput(["id" => "contact_email_phone", "placeholder" => "E-Mail", "class" => "form-control", "autocomplete" => "off"]) ?>
                <?= $form->field($model, 'message', ["template" => "{input}{error}"])->textarea(["id" => "contact_message", "placeholder" => "Message...", "class" => "form-control", "rows" => "3"]) ?>

                <?= $form->field($model, 'captcha', ["template" => "{input}{error}"])->widget(\yii\captcha\Captcha::classname(), [
                'imageOptions' => [
                    "id" => "captcha",
                    "alt" => "CAPTCHA Image",
                    "class" => "captcha-obj"
                ],
                "options" => ["id" => "captcha_code", "placeholder" => "Enter Code", "class" => "form-control"],
                "template" => '{image}<a href="#" class="reload_captcha"><i class="icon-repeat"></i></a>{input}',
            ]) ?>

                <div class="form-group"><input type="submit" name="send_contact_form" id="btn_contact_submit"
                                               class="btn btn-success" value="Send"></div>

                <div
                    class="notice form-group"><?= LiveEdit::text(__FILE__, 'You can also contact us via phone here: 210-489-7311. At times we experience high call volumes we recommend you send a message in the form above for a quick response.') ?></div>
                <?php ActiveForm::end() ?>

        </div>
    </div>
</section>