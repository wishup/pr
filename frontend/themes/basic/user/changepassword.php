<?php
use common\components\LiveEdit;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\attachments;

?>
<section class="main gen-box container-lg">
    <div class="account-primary">

        <?= $this->render("//elements/dashboard_head", [
            "infomodel" => $infomodel,
            "hostmodel" => $hostmodel,
            "usermodel" => $usermodel,
            "bgcheckmodel" => $bgcheckmodel,
            "family" => $family
        ]) ?>

        <section class="panel-box dsh-emails mg-btm-100">
            <a name="additemail"></a>
            <div class="panel-head">
                <h3 class="title -md text-featured">Your Emails</h3>
            </div><!-- .panel-head -->

            <div class="panel-cont">
                <div class="data-list">
                    <div class="data-list-item">
                        <div class="data-list-name">Primary Account</div>
                        <div class="data-list-value">
                            <span class="email-text"><?= $usermodel->email ?></span>
                            <strong class="email-status">Primary</strong>
                        </div>
                    </div>

                    <?php
                    foreach( $usermodel->userEmails as $addit_email ){
                        ?>
                        <div class="data-list-item">
                            <div class="data-list-name">Additional Account</div>
                            <div class="data-list-value">
                                <span class="email-text"><?= $addit_email->email ?></span>
                                <a href="/user/additemailprimary/<?= $addit_email->id ?>" class="btn btn-brd-success" data-method="post">Make Primary</a>
                                <a href="/user/deladditemail/<?= $addit_email->id ?>" class="btn btn-brd-success" data-method="post">Delete</a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                    <?php $form = ActiveForm::begin(["action" => "/user/changepassword#additemail"]); ?>
                        <div class="data-list-item">
                            <div class="data-list-name">Add Email</div>
                            <div class="data-list-value">
                                <div class="email-form">
                                    <?= $form->field($additional_email, 'email', ["template" => "{input}{error}","options" => ["placeholder" => "New Email"]]) ?>
                                    <button class='btn btn-success'>Add</button>
                                </div>
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
                <p>You can sign in to Bible Bee using any of your email address you have associated with your account (using your existing password).</p>
            </div><!-- .panel-cont -->
        </section><!-- .panel-box -->

        <?php $form = ActiveForm::begin(); ?>
        <section class="panel-light mode-section edit-mode contact_info_edit_section">
            <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Change password') ?></h3>

            <div class="row">
                <div class="form-part">
                    <div class="clearfix renew_host_info">
                        <div class="col-sm-6 col-sm-offset-3">
                            <?= $form->field($model, 'oldpass', ["options" => ["class" => "form-group"]])->passwordInput(["placeholder" => $model->getAttributeLabel('oldpass')])->label($model->getAttributeLabel('oldpass'), ["class" => "form-label"]) ?>

                            <?= $form->field($model, 'newpass', ["options" => ["class" => "form-group"]])->passwordInput(["placeholder" => $model->getAttributeLabel('newpass')])->label($model->getAttributeLabel('newpass'), ["class" => "form-label"]) ?>

                            <?= $form->field($model, 'repeatnewpass', ["options" => ["class" => "form-group"]])->passwordInput(["placeholder" => $model->getAttributeLabel('repeatnewpass')])->label($model->getAttributeLabel('repeatnewpass'), ["class" => "form-label"]) ?>
                        </div>

                    </div>
                    <div class="btns-group hidden-view text-center">
                        <?= Html::submitButton('Save', [
                            'class' => 'btn btn-success btn-sm'
                        ]) ?>
                    </div>
                </div>
            </div>
        </section>
        <?php ActiveForm::end(); ?>
    </div>
</section>