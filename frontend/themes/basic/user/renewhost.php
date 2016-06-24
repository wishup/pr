<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\LiveEdit;
use \common\components\attachments;
?>
<header class="header container clearfix">
    <h1 class="logo"><a href="/"><img src="/images/logo2.png" alt="" title=""></a></h1>
</header>
<!-- login form -->
<div class="gen-box inner-wrapper text-center container-lg">
    <?php if($is_verification_page) { ?>
    <h2 class="title text-featured"><?= LiveEdit::text(__FILE__, 'Thank you') ?></h2>
    <h3 class="caption text-primary2  sep-bottom"><?= LiveEdit::text(__FILE__, 'Your email ') ?> <a href="" class="text-success"><?= $usermodel->email ?></a> <?= LiveEdit::text(__FILE__, 'has been verified.') ?></h3>
    <div class="gen-text sep-bottom -sm">
        <?= LiveEdit::text(__FILE__, '<p>Being a Bible Bee Host in 2016 is more exciting than ever. We are excited to support you as you share the Word of God.</p>
        <p>Please update the fields below. Once completed, you will be directed to your new Host Dashboard.</p>', 'div', 'wysiwyg') ?>
    </div>
    <?php } else {?>
    <h2 class="title text-featured"><?= LiveEdit::text(__FILE__, 'Thank you ') ?></h2>
    <h3 class="caption text-primary2  sep-bottom"><?= LiveEdit::text(__FILE__, 'Get Ready for 2016!') ?></h3>
    <div class="gen-text sep-bottom -sm">
        <?= LiveEdit::text(__FILE__, '<p>Being a Bible Bee Host in 2016 is more exciting than ever. We are excited to support you as you share the Word of God.</p>
        <p>Please update the fields below. Once completed, you will be directed to your new Host Dashboard.</p> ', 'div', 'wysiwyg') ?>
    </div>
    <?php } ?>
    <?php $form = ActiveForm::begin(["options"=>[ "class" => "renew_host_form" ]]); ?>
    <?php if ($usermodel->status == 0) { ?>
    <section class="create-section section">
        <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Connect with Google') ?></h3>
        <div class="text-center">
            <div class="gplus-item soc-item">
                <div class="fb-login">
                    <a href="/user/hgauth?authclient=google" class="login-btn btn" target="_blank">
                        <i class="icon-google-plus"></i>
                        <span>Login with <strong>Google</strong></span>
                    </a>
                    <div style="font-size:12px; color:#ff0000; display:none" class="fb_error"></div>
                </div>
                <div class="fb-account" style="display: none">
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="" alt="..." width="50" height="50">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="text-primary fb_user_name"></h4>
                        </div>
                    </div>
                    <button class="btn btn-outline btn-sm btn-success host_renew_restore_fb">Remove connection</button>
                </div>
            </div>
        </div>
        <div class="create-password">
            <div class="sep2 text-success">or</div>
            <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Create a Password') ?></h3>
            <div class="form-part centered col-sm-8 col-lg-5 view-mode text-left">
                    <div class="form-group form-group-nocut">
                        <label class="form-label"><?= LiveEdit::text(__FILE__, 'email') ?></label>
                        <input type="text" class="form-control" placeholder="<?= $usermodel->email ?>" value="<?= $usermodel->email ?>">
                        <span class="form-control-value"><?= $usermodel->email ?></span>
                    </div>
                    <hr>
                    <div class="pass-wrap row">
                        <?= $form->field($usermodel, 'password', ["template"=>"{input}{error}","options" => ["tag"=>"div", "class"=>"form-group stay-edit col-md-6"]])->passwordInput(["placeholder"=>"New Password", 'value'=>'', "autocomplete" => "new-password"]) ?>
                        <?= $form->field($usermodel, 'password_repeat', ["template"=>"{input}{error}","options" => ["tag"=>"div", "class"=>"form-group stay-edit col-md-6"]])->passwordInput(["placeholder"=>"Repeat Password", 'value'=>'', "autocomplete" => "new-password"]) ?>
                    </div>
                    <div class="help-block clearfix text-center">
                        <h4 class="text-brown"><?= LiveEdit::text(__FILE__, 'Password Requirements') ?></h4>
                        <?= LiveEdit::text(__FILE__, 'Minimum 6 characters in length', 'div', 'wysiwyg') ?>
                    </div>
            </div>
        </div>
    </section>
<?php } else { ?>
        <section class="create-section section">
            <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'BB acount') ?></h3>

            <div class="text-center">
                <div class="gplus-item soc-item">
                    <div class="fb-account">
                        <div class="media">
                            <div class="media-left">
                                <img class="media-object"
                                     src="<?= $userinfomodel->avatar ? attachments::getThumbnailUrl('/upload/avatar/' . $userinfomodel->user_id . '/' . $userinfomodel->avatar, 100, 95, 'CROP') : '/images/avatar.jpg' ?>"
                                     width="50" height="50">
                            </div>
                            <div class="media-body">
                                <h4 class="text-primary fb_user_name"><?php echo $userinfomodel->first_name . " " . $userinfomodel->last_name; ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
    ?>
    <section class="section mode-section edit-mode">
            <a href="" class="edit-btn toggle-mode hidden-edit"><i class="icon-edit"></i><?= LiveEdit::text(__FILE__, 'edit') ?></a>
            <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Contact Information') ?></h3>
            <p class="subtitle"><?= LiveEdit::text(__FILE__, 'This information is private and is provided to Bible Bee in order to contact you.') ?></p>
            <div class="form-part centered col-lg-11">
                <h5 class="group-label hidden-edit text-left renew_host_user_name"><?= $userinfomodel->first_name.' '.$userinfomodel->last_name ?></h5>
                <ul class="block-sm-2 clearfix text-left renew_host_info">
                    <?= $form->field($userinfomodel, 'first_name', ["options" => ["tag"=>"li", "class"=>"form-group hidden-view"]])->textInput(["placeholder"=>$userinfomodel->getAttributeLabel( 'first_name' )])->label($userinfomodel->getAttributeLabel( 'first_name' ),["class"=>"form-label"]) ?>

                    <?= $form->field($userinfomodel, 'last_name', ["options" => ["tag"=>"li", "class"=>"form-group hidden-view"]])->textInput(["placeholder"=>$userinfomodel->getAttributeLabel( 'last_name' )])->label($userinfomodel->getAttributeLabel( 'last_name' ),["class"=>"form-label"]) ?>

                    <?= $form->field($userinfomodel, 'address_1', ["options" => ["tag"=>"li", "class"=>"form-group"]])->textInput(["placeholder"=>$userinfomodel->getAttributeLabel( 'address_1' )])->label($userinfomodel->getAttributeLabel( 'address_1' ),["class"=>"form-label"]) ?>

                    <?= $form->field($userinfomodel, 'address_2', ["options" => ["tag"=>"li", "class"=>"form-group"]])->textInput(["placeholder"=>$userinfomodel->getAttributeLabel( 'address_2' )])->label($userinfomodel->getAttributeLabel( 'address_2' ),["class"=>"form-label"]) ?>

                    <?= $form->field($userinfomodel, 'city', ["options" => ["tag"=>"li", "class"=>"form-group"]])->textInput(["placeholder"=>$userinfomodel->getAttributeLabel( 'city' )])->label($userinfomodel->getAttributeLabel( 'city' ),["class"=>"form-label"]) ?>

                    <?= $form->field($userinfomodel, 'state', ["template"=>"{label}{input}{error}<span class='form-control hidden-edit renew_host_state_view'>".((isset(\Yii::$app->params["us_states"][$userinfomodel->state]) && $userinfomodel->state) ? \Yii::$app->params["us_states"][$userinfomodel->state] : '&nbsp;')."</span>","options" => ["tag"=>"li", "class"=>"form-group"]])->dropDownList(array_merge([''=>$userinfomodel->getAttributeLabel( 'state' )],\Yii::$app->params["us_states"]),["class"=>"form-control custom-select-state hidden-view","placeholder"=>""])->label($userinfomodel->getAttributeLabel( 'state' ),["class"=>"form-label"]) ?>

                    <?= $form->field($userinfomodel, 'zip', ["options" => ["tag"=>"li", "class"=>"form-group"]])->textInput(["placeholder"=>$userinfomodel->getAttributeLabel( 'zip' )])->label($userinfomodel->getAttributeLabel( 'zip' ),["class"=>"form-label"]) ?>


                    <li>
                        <div class="row">
                            <?= $form->field($userinfomodel, 'cell_phone', ["options" => ["template" => "{input}{error}", "class" => "form-group col-md-6"]])->textInput(["placeholder" => $userinfomodel->getAttributeLabel('cell_phone'), "class" => "form-control phone_mask"])->label($userinfomodel->getAttributeLabel('cell_phone'), ["class" => "form-label"]) ?>
                            <?= $form->field($userinfomodel, 'phone', ["options" => ["template" => "{input}{error}", "class" => "form-group col-md-6"]])->textInput(["placeholder" => $userinfomodel->getAttributeLabel('phone'), "class" => "form-control phone_mask"])->label($userinfomodel->getAttributeLabel('phone'), ["class" => "form-label"]) ?>
                        </div>
                    </li>


                </ul>
            </div>
        </section>

        <section class="section">
            <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Please review and sign each of the following forms') ?></h3>
            <div class="panel-gray">
                <ul class="choose-group">
                    <li >
                        <a href="#agreementPopup1" class="choose-box popup-with-form">
                            <input type="checkbox" name="agreement1" id="agreement_1" ><span></span>
                            <em class="hidden-xs"><?= LiveEdit::text(__FILE__, 'Host Agreement & Statement of Faith') ?></em>
                            <em class="visible-xs-inline"><?= LiveEdit::text(__FILE__, 'Host Agreement & ...') ?></em>
                        </a>
                    </li>
                </ul>
                <!-- agreement popups -->
                <div id="agreementPopup1" class="agreement-popup popup-block popup-has-close main-box mfp-hide -lg">
                    <h3 class="no-bold"><?= LiveEdit::text(__FILE__, 'Host Agreement & Statement of Faith') ?></h3>
                    <label class="choose-box -outline">
                        <input type="checkbox" class="agreement_popup_check" data-child-id="agreement_1" autocomplete="off"><span></span> I agree that the below statements are true, and agree to abide by these conditions as a Bible Bee volunteer.
                    </label>
                    <div class="form-group">
                        <input type="text" name="agreement_1_name" placeholder="Name" class="form-control agreement_name">
                    </div>
                    <input type="button" class="btn btn-success agreement_button" value="Submit">
                    <?= LiveEdit::text(__FILE__, 'Host Agreement & Statement of Faith content', 'div', 'wysiwyg') ?>
                </div>
            </div>
        </section>

        <section class="section">
            <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Maximum number of contestants you are willing to host') ?></h3>
            <div class="number-select form-group">
                <span>up to</span>
                <?= $form->field($userhostmodel, 'willing_to_host', ["template"=>"{input}{error}","options" => ["tag"=>"div", "class"=>"select-wrap stay-edit text-left", "style"=>"max-width:170px;margin:0 auto;"]])->dropDownList(\Yii::$app->params["willing_to_host"],["class"=>"form-control custom-select"]) ?>
            </div>
        </section>
    <?php if ($is_verification_page) { ?>
        <section class="section">
            <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'How did you hear about us?') ?></h3>
            <?= $form->field($userinfomodel, 'hear_about_us', ["template" => "{input}{error}", "options" => ["tag" => "div", "class" => "form-group stay-edit text-left", "style" => "max-width:370px;margin:0 auto;"]])->dropDownList($hear_about, ["class" => "form-control custom-select hear_about_us_select"]) ?>
            <?= $form->field($userinfomodel, 'hear_about_us_other', ["template" => "{input}{error}", "options" => ["style" => "max-width:370px;margin:0 auto;", "class" => "field-userinfo-hear_about_us_other hear_about_us_other"]])->textInput(["placeholder" => "Other"]) ?>
        </section>
    <?php } ?>

        <div class="panel-gray">
            <button class="btn btn-success">Continue</button>
        </div>
    <?php ActiveForm::end(); ?>
</div>