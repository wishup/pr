<?php
use common\components\attachments;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\LiveEdit;
?>
<section class="newsletter-section sss">
    <div class="container">
        <?php if($title):?>
            <h2 class="caption text-brown"><?php echo LiveEdit::widgetField( $title, "title", $widget_id ); ?></h2>
        <?php endif;?>
        <?php $form = ActiveForm::begin(["id" => "subscribe_form","options" => ["class" => ( $popup ? '' : 'send_ajax' )." newsletter-form form-inline", "data-callback" => "subscribe_callback", "data-id-prefix" => "studyguidesubscribeform", "data-open-popup"=> ($popup ? 1 : 0)]]); ?>
        <input type="hidden" name="widget_ajax" value="Newsletter">
        <input type="hidden" name="studyguide_subscribe" value="1">
        <?php
        if( !$popup ){
            ?>
            <input type="hidden" name="onlyemail" value="1">
            <?php
        }
        ?>
        <div class="form-group">
            <?php
            echo Html::label('Email address', 'exampleInputEmail3',['class' => 'sr-only']);
            echo Html::input('email', 'StudyguideSubscribe[email]', '', ['class' => 'form-control input-lg', 'id' =>'studyguidesubscribeform-email', 'placeholder'=>'Email...']);
            ?>
            <?php
            if( $popup ){
                echo Html::a('subscribe <i class="icon-arrow-right"></i>', '#newsletterPopup', ["class" => "btn btn-success btn-lg popup-with-form get_started_studyguide_submit"]);
            } else {
                echo Html::submitButton('subscribe <i class="icon-arrow-right"></i>', ['class' => 'btn btn-success btn-lg', 'name' => 'subscribe']);

            }

            ?>
            <div class="help-block"></div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <?php
    if( $popup ){

        ?>
        <!-- getstartedPopup -->
        <div class="getstarted-popup popup-block text-center mfp-hide" id="newsletterPopup">
            <h2 class="title -md text-featured">Thanks for your interest!</h2>
            <h3 class="caption text-brown">Can we get to know you a bit better?</h3>
            <div class="popup-form">
                <?php $form = ActiveForm::begin(["id" => "subscribe_form2","options" => ["class" => "send_ajax", "data-callback" => "subscribe_callback2", "data-id-prefix" => "studyguidesubscribe"]]); ?>
                <input type="hidden" name="widget_ajax" value="Newsletter">
                <input type="hidden" name="studyguide_subscribe" value="1">
                <?= $form->field($model, 'first_name', ["template" => "{input}{error}", 'options' => ['tag'=>'span']])->textInput(["placeholder" => "First name", "class" => "form-control"]) ?>
                <?= $form->field($model, 'last_name', ["template" => "{input}{error}", 'options' => ['tag'=>'span']])->textInput(["placeholder" => "Last name", "class" => "form-control"]) ?>
                <?= $form->field($model, 'address', ["template" => "{input}{error}", 'options' => ['tag'=>'span']])->textInput(["placeholder" => "Address", "class" => "form-control"]) ?>
                <?= $form->field($model, 'city', ["template" => "{input}{error}", 'options' => ['tag'=>'span']])->textInput(["placeholder" => "City", "class" => "form-control"]) ?>
                <?= $form->field($model, 'state', ["template" => "{input}{error}", 'options' => ['tag'=>'span']])->dropDownList(Yii::$app->params["us_states"],["placeholder" => "State", "class" => "form-control"]) ?>
                <?= $form->field($model, 'zip', ["template" => "{input}{error}", 'options' => ['tag'=>'span']])->textInput(["placeholder" => "Zip", "class" => "form-control"]) ?>
                <?= $form->field($model, 'phone', ["template" => "{input}{error}", 'options' => ['tag'=>'span']])->textInput(["placeholder" => "Phone Number", "class" => "form-control"]) ?>
                <?= $form->field($model, 'email', ["template" => "{input}{error}", 'options' => ['tag'=>'span']])->textInput(["placeholder" => "E-mail", "class" => "form-control"]) ?>
                <div class="btn-wrap">
                    <?= Html::submitInput("Submit", ["class" => "btn btn-primary", "id" => "new_email_submit_more"]) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <!--getstartedPopup thank you-->

        <!--end getstartedPopup -->
        <?php

    }
    ?>
    <div class="popup-step3 getstarted-popup popup-block text-center mfp-hide popup-has-close" id="newsletterPopupSuccess">
        <h2 class="title -md text-featured">Thank you!</h2>
        <h3 class="caption title2">We look forward to keeping in touch</h3>
        <div class="popup-form"><div class="btn-wrap"><a href="" id="getstartedsubsuccessclose" class="btn btn-success">Close</a></div>
        </div>
    </div>
</section>

