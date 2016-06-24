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

        <?= !$hostmodel->isNewRecord ? LiveEdit::text(__FILE__, '<div class="join-box notice-box notice-success2 clearfix">
                <h2 class="text-success2"><a href="https://plus.google.com/communities/109357367166452380844" target="_blank"> Join the Bible Bee Community on Google +</a></h2>
                <div class="learn-box">
                    <span><a href="https://vimeo.com/160120974" target="_blank">Learn how</a></span>
                    <a href="https://vimeo.com/160120974" target="_blank"><img src="/images/gplus_video.jpg" alt=""></a>
                </div>
            </div>', 'div', 'wysiwyg') : '' ?>

        <?= $family ? LiveEdit::text(__FILE__, '<div class="join-box notice-box notice-success2 clearfix">
                <h2 class="text-success2"><a href="https://plus.google.com/u/0/communities/107645641301522450881" target="_blank"> Join the Bible Bee Community on Google +</a></h2>
                <div class="learn-box">
                    <span><a href="https://vimeo.com/161116615" target="_blank">Learn how</a></span>
                    <a href="https://vimeo.com/161116615" target="_blank"><img src="/images/gplus_video.jpg" alt=""></a>
                </div>
            </div>', 'div', 'wysiwyg') : '' ?>

        <?= \common\components\Widgetareas::showWidget("adminmessages") ?>

        <?php
        if( !$hostmodel->isNewRecord && in_array( $bgcheckmodel->status, ['','incoming'] ) ) {
            ?>
            <?php $form = ActiveForm::begin(["id" => "dashboard_bgcheck_form","options" => ["class" => "send_ajax", "data-callback" => "dashboard_bgcheck_save_callback", "data-id-prefix" => "userinfo"]]); ?>
            <input type="hidden" name="save_user_check" value="1">
            <section class="info-checker text-center">
                <img src="/images/ssl.png" class="ssl-logo" alt="ssl">

                <h2><?= LiveEdit::text(__FILE__, 'Background Check Information') ?></h2>

                <div class="checker-form">
                    <!--message after background-->
                    <div class="check-msg checked_profile_msg" <?php if( $bgcheckmodel->status == '' ){ ?>style="display:none"<?php } ?>>
                        <h3 class="title text-featured sep-bottom -sm">Thank you.</h3>
                        <h4 class="block-title text-primary2">Your Background Check has been submitted.</h4>
                    </div>

                    <div class="unchecked-profile" <?php if( $bgcheckmodel->status != '' ){ ?>style="display:none"<?php } ?>>
                        <h3 class="checker-logo"><a href=""><img src="/images/trak1-logo.png"></a></h3>

                        <div class="panel">
                            <h3><?= LiveEdit::text(__FILE__, 'Bible Bee does not store your Social Security Number.
                                    Your Social Security Number is sent directly and securely
                                    to') ?> <a href="">trak-1.com.</a>
                            </h3>
                            <!-- firstname/lastname  -->
                            <div class="ssl-fieldset row">
                                <div class="form-group col-sm-6">
                                    <label class="form-label"><?= LiveEdit::text(__FILE__, 'Legal First Name') ?></label>
                                    <?php if( $bgcheckmodel->status == '' ) { ?>
                                        <?= $form->field($bgcheckmodel, 'first_name', ["template"=>'{input}{error}',"options" => ["tag"=>"span", "class"=>""]])->textInput(["placeholder"=>"First Name", "class" => "form-control", 'id'=>'userinfo-legal_first_name']) ?>
                                    <?php
                                    } else {
                                        ?>
                                        <span class="help-block"><?= $bgcheckmodel->first_name ?></span>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="form-label"><?= LiveEdit::text(__FILE__, 'Legal Last Name') ?></label>
                                    <?php if( $bgcheckmodel->status == '' ) { ?>
                                        <?= $form->field($bgcheckmodel, 'last_name', ["template"=>'{input}{error}',"options" => ["tag"=>"span", "class"=>""]])->textInput(["placeholder"=>"Last Name", "class" => "form-control", 'id'=>'userinfo-legal_last_name']) ?>
                                    <?php
                                    } else {
                                        ?>
                                        <span class="help-block"><?= $bgcheckmodel->last_name ?></span>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="ssl-fieldset row">
                                <div class="form-group col-sm-6">
                                    <label class="form-label"><?= LiveEdit::text(__FILE__, 'Social Security Number') ?></label>
                                    <?php if( $bgcheckmodel->status == '' ) { ?>
                                        <?= $form->field($infomodel, 'ssn', ["template" => "{input}{error}", "options" => ["tag" => "span", "class" => ""]])->textInput(["placeholder" => "xxx-xx-xxxx", "value"=>"", "id"=>"userinfo-ssn", "class"=>"form-control ssn_mask"]) ?>
                                    <?php
                                    } else {
                                        ?>
                                        <span class="help-block"><?= $infomodel->ssn ?></span>
                                    <?php
                                    }
                                    ?>
                                    <span id="helpBlock11" class="help-block" data-dont-clear="1">Why is it needed
                                            <a class="tipsy tipsy--s" data-tipsy="As a Volunteer Team Member or Intern you will be working with children enrolled in the National Bible Bee competition. It is our policy to, without exception, require everyone to pass a background check.Your Social Security number is required to process this background check. Your personal information and the results of your background check is strictly confidential.">
                                                <i class="icon-faq"></i>
                                            </a>
                                        </span>
                                </div>
                                <div class="<?php if($infomodel->date_of_birth) echo 'with-info';?> form-group col-sm-6">
                                    <label class="form-label"><?= LiveEdit::text(__FILE__, 'Birthday') ?></label>
                                    <?php if( $bgcheckmodel->status == '' ) { ?>
                                        <?= $form->field($infomodel, 'date_of_birth', ["template"=>'{input}<label class="choose-box -outline dashboard_age_box"><input type="checkbox" name="check_age"><span></span> I’m <strong class="dashboard_age">45</strong> years old.</label>{error}',"options" => ["tag"=>"span", "class"=>""]])->textInput(["placeholder"=>"mm/dd/yyyy", "class" => "form-control date_mask dashboard_birthdate"]) ?>
                                    <?php
                                    } else {
                                        ?>
                                        <span class="help-block"><?= $infomodel->date_of_birth ?></span>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php if( $bgcheckmodel->status == '' ){ ?><button class="btn btn-lg btn-success submit_dashboard_bgcheck" type="submit">Securely Submit</button><?php } ?>
                    </div>
                </div>

            </section>
            <?php ActiveForm::end(); ?>
        <?php
        }
        ?>
        <a name="contact_info"></a>
        <?php $form = ActiveForm::begin(["id" => "dashboard_contact_info_form","options" => ["class" => "send_ajax", "data-callback" => "dashboard_contact_save_callback", "data-id-prefix" => "userinfo"]]); ?>
        <input type="hidden" name="save_contact_info" value="1">
        <section class="panel-light mode-section <?= $infomodel->getErrors() ? 'edit' : 'view' ?>-mode contact_info_edit_section">
            <a href="" class="edit-btn toggle-mode hidden-edit"><i class="icon-edit"></i>edit</a>
            <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Contact Information') ?></h3>

            <p class="subtitle"><?= LiveEdit::text(__FILE__, 'This information is private and is provided to Bible Bee in order to contact you.') ?></p>
            <div class="row">
                <div class="form-part  col-lg-11">
                    <h5 class="group-label hidden-edit renew_host_user_name"><?= $infomodel->first_name.' '.$infomodel->last_name ?></h5>
                    <ul class="block-sm-2 clearfix renew_host_info">
                        <?= $form->field($infomodel, 'first_name', ["options" => ["tag"=>"li", "class"=>"form-group hidden-view"]])->textInput(["placeholder"=>$infomodel->getAttributeLabel( 'first_name' )])->label($infomodel->getAttributeLabel( 'first_name' ),["class"=>"form-label"]) ?>

                        <?= $form->field($infomodel, 'last_name', ["options" => ["tag"=>"li", "class"=>"form-group hidden-view"]])->textInput(["placeholder"=>$infomodel->getAttributeLabel( 'last_name' )])->label($infomodel->getAttributeLabel( 'last_name' ),["class"=>"form-label"]) ?>

                        <?= $form->field($infomodel, 'address_1', ["options" => ["tag"=>"li", "class"=>"form-group"]])->textInput(["placeholder"=>$infomodel->getAttributeLabel( 'address_1' )])->label($infomodel->getAttributeLabel( 'address_1' ),["class"=>"form-label"]) ?>

                        <?= $form->field($infomodel, 'address_2', ["options" => ["tag"=>"li", "class"=>"form-group"]])->textInput(["placeholder"=>$infomodel->getAttributeLabel( 'address_2' )])->label($infomodel->getAttributeLabel( 'address_2' ),["class"=>"form-label"]) ?>

                        <?= $form->field($infomodel, 'city', ["options" => ["tag"=>"li", "class"=>"form-group"]])->textInput(["placeholder"=>$infomodel->getAttributeLabel( 'city' )])->label($infomodel->getAttributeLabel( 'city' ),["class"=>"form-label"]) ?>

                        <?= $form->field($infomodel, 'state', ["template"=>"{label}{input}{error}<span class='form-control hidden-edit renew_host_state_view'>".((isset(\Yii::$app->params["us_states"][$infomodel->state]) && $infomodel->state) ? \Yii::$app->params["us_states"][$infomodel->state] : '&nbsp;')."</span>","options" => ["tag"=>"li", "class"=>"form-group"]])->dropDownList(array_merge([''=>$infomodel->getAttributeLabel( 'state' )],\Yii::$app->params["us_states"]),["class"=>"form-control custom-select-state hidden-view","placeholder"=>"", "data-default-val"=>$infomodel->state])->label($infomodel->getAttributeLabel( 'state' ),["class"=>"form-label"]) ?>

                        <?= $form->field($infomodel, 'zip', ["options" => ["tag"=>"li", "class"=>"form-group"]])->textInput(["placeholder"=>$infomodel->getAttributeLabel( 'zip' )])->label($infomodel->getAttributeLabel( 'zip' ),["class"=>"form-label"]) ?>

                        <?= $form->field($infomodel, 'phone', ["options" => ["tag"=>"li", "class"=>"form-group"]])->textInput(["placeholder"=>$infomodel->getAttributeLabel( 'phone' ), "class"=>"form-control phone_mask"])->label($infomodel->getAttributeLabel( 'phone' ),["class"=>"form-label"]) ?>

                        <?= $form->field($infomodel, 'cell_phone', ["options" => ["tag"=>"li", "class"=>"form-group"]])->textInput(["placeholder"=>$infomodel->getAttributeLabel( 'cell_phone' ), "class"=>"form-control phone_mask"])->label($infomodel->getAttributeLabel( 'cell_phone' ),["class"=>"form-label"]) ?>

                    </ul>
                    <div class="btns-group hidden-view text-center">
                        <button class="btn btn-success" type="submit">Save</button>
                        <button class="btn btn-brd-success reset_renew_host_info toggle-mode">Cancel</button>
                    </div>
                </div>
            </div>
        </section>
        <?php ActiveForm::end(); ?>


        <?php if( $family || !$hostmodel->isNewRecord ) { ?>
            <section class="panel-box fm-contestants">
                <div class="panel-head">
                    <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Participants - Family') ?></h3>
                </div><!-- .panel-head -->

                <div class="panel-cont">
                    <div class="fm-contestant-list">
                        <?php
                        if( $children )
                            foreach( $children as $hchild ){
                                if( $hchild->status == 0 ) continue;

                                $form = ActiveForm::begin(["id" => "dashboard_contestant_info_form_".$hchild->id,"options" => ["class" => "send_ajax", "data-callback" => "dashboard_contestant_save_callback", "data-id-prefix" => "contestants"]]);
                                ?>
                                <input type="hidden" name="save_contestant_info" value="1">
                                <input type="hidden" name="contestant_id" value="<?= $hchild->id ?>">
                                <div class="fm-contestant-box">
                                    <div class="mode-section view-mode">
                                        <a href="" class="edit-btn toggle-mode hidden-edit"><i class="icon-edit"></i>edit</a>

                                        <div class="fm-contestant-child">
                                            <div class="data-list">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="data-list-item">
                                                            <span class="data-list-value contestant-view-name"><?= $hchild->first_name.' '.$hchild->last_name ?></span>
                                                            <?= $form->field($hchild, 'first_name', ["template" => "{input}{error}", "options" => ["class" => ""]] )->textInput() ?>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="data-list-item">
                                                            <span class="data-list-value">&nbsp;</span>
                                                            <?= $form->field($hchild, 'last_name', ["template" => "{input}{error}", "options" => ["class" => ""]] )->textInput() ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="data-list-item">
                                                            <span class="data-list-name">Date of Birth</span>
                                                            <span class="data-list-value contestant-view-dob"><?= $hchild->date_of_birth ?> <?= $hchild->age_group != '' ? '('.$hchild->age_group.')' : '' ?></span>
                                                            <?= $form->field($hchild, 'date_of_birth', ["template" => "{input}{error}", "options" => ["class" => ""]] )->textInput(["class" => "form-control date_mask"]) ?>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="data-list-item">
                                                                    <span class="data-list-name">Gender</span>
                                                                    <span class="data-list-value contestant-view-gender"><?= substr(( isset(Yii::$app->params["gender"][ $hchild->gender ]) ? Yii::$app->params["gender"][ $hchild->gender ] : '' ), 0, 1) ?></span>
                                                                    <?= $form->field($hchild, 'gender', ["template" => "{input}{error}", "options" => ["class" => ""]] )->dropDownList(Yii::$app->params["gender"]) ?>

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="data-list-item">
                                                                    <span class="data-list-name">Version</span>
                                                                    <span class="data-list-value contestant-view-version"><?= isset(Yii::$app->params["versions"][ $hchild->version ]) ? Yii::$app->params["versions"][ $hchild->version ] : '' ?></span>
                                                                    <?= $form->field($hchild, 'version', ["template" => "{input}{error}", "options" => ["class" => ""]] )->dropDownList(Yii::$app->params["versions"]) ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .fm-contestant-child -->


                                        <div class="btns-group hidden-view text-center">
                                            <input type="submit" value="Save" class="btn btn-success">
                                            <input type="reset" value="Cancel" class="btn btn-brd-success reset_contestants toggle-mode">
                                        </div>
                                    </div>
                                </div><!-- .fm-contestant-box -->
                                <?php ActiveForm::end(); ?>

                            <?php
                            }
                        ?>
                        <div class="contestant-form-btn">
                            <?php echo Html::a('<span>+</span> Add Children', $family ? \yii\helpers\Url::to(['user/addchildren']) : \yii\helpers\Url::to(['user/familydirectregistration']), array('class' => 'btn btn-md btn-success')); ?>
                        </div>
                    </div><!-- .fm-contestant-list -->
                </div><!-- .panel-cont -->
            </section><!-- .panel-box -->
        <?php

        }
        ?>


        <?php if( !$hostmodel->isNewRecord ) { ?>
            <?php $form = ActiveForm::begin(["id" => "dashboard_host_info_form", "options" => ["class" => "send_ajax", "data-callback" => "dashboard_host_save_callback", "data-id-prefix" => "usershosts"]]); ?>
            <input type="hidden" name="save_host_info" value="1">
            <section
                class="panel-light mode-section with-collapse <?= $hostmodel->getErrors() ? 'edit' : 'view' ?>-mode">
                <a href="" class="edit-btn toggle-mode hidden-edit"><i class="icon-edit"></i>edit</a>

                <div class="switcher-heading">
                    <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Contact Details for Contestants') ?></h3>
                    <?php
                    if( in_array($hostmodel->status, [1,2]) ) {
                        ?>
                        <div class="switcher">
                            <input id="switcher-1" class="sw-toggle change_host_status" type="checkbox" <?= $hostmodel->status == 1 ? 'checked' : '' ?>>
                            <label for="switcher-1">
                                <span class="sw-on">Active</span>
                                <span class="sw-off">Inactive</span>
                            </label>
                        </div>
                    <?php
                    } else {
                        ?>
                        <div class="switcher">
                            <input id="switcher-1" class="sw-toggle" type="checkbox" disabled>
                            <label for="switcher-1">
                                <span class="sw-on">Active</span>
                                <span class="sw-off">Inactive</span>
                            </label>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="dsh-info">
                        <a class="tipsy tipsy--s"
                           data-tipsy="This switch makes your Local Bible Bee Location unable to receive Participant signups. And it changes your status on the host map to 'inactive'. This toggle will be switched to 'active' once your background check has been approved.">
                            <i class="icon icon-faq"></i>
                        </a>
                    </div>
                </div>

                <p class="subtitle"><?= LiveEdit::text(__FILE__, 'This information is private and will only be used by Bible Bee staff to contact the Host.') ?></p>
                <hr>
                <div class="row renew_host_info2 collapse" id="hostSummer">
                    <div class="form-part  col-lg-11">
                        <ul class="host-form block-sm-2 clearfix ">
                            <?= $form->field($hostmodel, 'summer_event_location', ["options" => ["tag" => "li", "class" => "form-group"]])->textInput(["placeholder" => "Location Name"])->label("Location Name", ["class" => "form-label"]) ?>
                            <?= $form->field($hostmodel, 'summer_event_address', ["options" => ["tag" => "li", "class" => "form-group"]])->textInput(["placeholder" => "Address1"])->label("Address1", ["class" => "form-label"]) ?>
                            <?= $form->field($hostmodel, 'summer_event_address_2', ["options" => ["tag" => "li", "class" => "form-group"]])->textInput(["placeholder" => "Address2"])->label("Address2", ["class" => "form-label"]) ?>
                            <?= $form->field($hostmodel, 'summer_event_city', ["options" => ["tag" => "li", "class" => "form-group"]])->textInput(["placeholder" => "City"])->label("City", ["class" => "form-label"]) ?>
                            <?= $form->field($hostmodel, 'summer_event_state', ["template" => "{label}{input}{error}<span class='form-control hidden-edit renew_host_state_view2'>" . ((isset(\Yii::$app->params["us_states"][$hostmodel->summer_event_state]) && $hostmodel->summer_event_state) ? \Yii::$app->params["us_states"][$hostmodel->summer_event_state] : '&nbsp;') . "</span>", "options" => ["tag" => "li", "class" => "form-group"]])->dropDownList(array_merge(['' => 'State'], \Yii::$app->params["us_states"]), ["class" => "form-control custom-select-state hidden-view", "placeholder" => "", "data-default-val"=>$hostmodel->summer_event_state])->label("State", ["class" => "form-label"]) ?>
                            <?= $form->field($hostmodel, 'summer_event_zip', ["options" => ["tag" => "li", "class" => "form-group"]])->textInput(["placeholder" => "Zip"])->label("Zip", ["class" => "form-label"]) ?>

                        </ul>
                        <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Maximum number of contestants you are willing to host') ?></h3>

                        <div class="number-select host-form  clearfix ">
                            <span>up to</span>
                            <?= $form->field($hostmodel, 'willing_to_host', ["template" => "{input}{error}<span class='form-control hidden-edit renew_host_whost_view'>" . (isset(\Yii::$app->params["willing_to_host"][$hostmodel->willing_to_host]) ? \Yii::$app->params["willing_to_host"][$hostmodel->willing_to_host] : '') . "</span>", "options" => ["tag" => "div", "class" => "form-group select-wrap "]])->dropDownList(\Yii::$app->params["willing_to_host"], ["class" => "form-control custom-select-whost hidden-view", "placeholder" => "", "data-default-val" => $hostmodel->willing_to_host])->label($hostmodel->getAttributeLabel('willing_to_host'), ["class" => "form-label"]) ?>
                        </div>

                        <div class="btns-group hidden-view text-center">
                            <button class="btn btn-success" type="submit">Save</button>
                            <button class="btn btn-brd-success reset_renew_host_info2 toggle-mode">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
                <button class="collapse-btn collapsed" type="button" data-toggle="collapse" data-target="#hostSummer"
                        aria-expanded="false" aria-controls="hostSummer">
                </button>
            </section>
            <?php ActiveForm::end(); ?>


            <section class="panel-box fm-contestants">
                <div class="panel-head">
                    <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Participants - Local Bee') ?></h3>
                </div><!-- .panel-head -->

                <div class="panel-cont">
                    <div class="fm-contestant-list">
                        <?php
                        foreach( $hostJoinedFamilies as $hostfamily ){
                            foreach( $hostfamily->children as $hchild ){
                                if( $hchild->status == 0 ) continue;

                                $form = ActiveForm::begin(["id" => "dashboard_contestant_info_form_".$hchild->id,"options" => ["class" => "send_ajax", "data-callback" => "dashboard_contestant_save_callback", "data-id-prefix" => "contestants"]]);
                                ?>
                                    <input type="hidden" name="save_contestant_info" value="1">
                                    <input type="hidden" name="contestant_id" value="<?= $hchild->id ?>">
                                    <div class="fm-contestant-box">
                                        <div class="mode-section view-mode">
                                            <!-- a href="" class="edit-btn toggle-mode hidden-edit"><i class="icon-edit"></i>edit</a -->

                                            <div class="fm-contestant-child">
                                                <div class="data-list">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="data-list-item">
                                                                <span class="data-list-value contestant-view-name"><?= $hchild->first_name.' '.$hchild->last_name ?></span>
                                                                <?= $form->field($hchild, 'first_name', ["template" => "{input}{error}", "options" => ["class" => ""]] )->textInput() ?>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="data-list-item">
                                                                <span class="data-list-value">&nbsp;</span>
                                                                <?= $form->field($hchild, 'last_name', ["template" => "{input}{error}", "options" => ["class" => ""]] )->textInput() ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="data-list-item">
                                                                <span class="data-list-name">Date of Birth</span>
                                                                <span class="data-list-value contestant-view-dob"><?= $hchild->date_of_birth ?> <?= $hchild->age_group != '' ? '('.$hchild->age_group.')' : '' ?></span>
                                                                <?= $form->field($hchild, 'date_of_birth', ["template" => "{input}{error}", "options" => ["class" => ""]] )->textInput(["class" => "form-control date_mask"]) ?>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="data-list-item">
                                                                        <span class="data-list-name">Gender</span>
                                                                        <span class="data-list-value contestant-view-gender"><?= substr(( isset(Yii::$app->params["gender"][ $hchild->gender ]) ? Yii::$app->params["gender"][ $hchild->gender ] : '' ), 0, 1) ?></span>
                                                                        <?= $form->field($hchild, 'gender', ["template" => "{input}{error}", "options" => ["class" => ""]] )->dropDownList(Yii::$app->params["gender"]) ?>

                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <div class="data-list-item">
                                                                        <span class="data-list-name">Version</span>
                                                                        <span class="data-list-value contestant-view-version"><?= isset(Yii::$app->params["versions"][ $hchild->version ]) ? Yii::$app->params["versions"][ $hchild->version ] : '' ?></span>
                                                                        <?= $form->field($hchild, 'version', ["template" => "{input}{error}", "options" => ["class" => ""]] )->dropDownList(Yii::$app->params["versions"]) ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="fm-contestant-parent-toggle"><span data-txt-more="Show More" data-txt-less="Show Less">Show More</span><i class="icon icon-arrow-down"></i></button>
                                            </div><!-- .fm-contestant-child -->

                                            <div class="fm-contestant-parent">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th><strong class="table-head"><span>Parents</span></strong></th>
                                                                <th>Email</th>
                                                                <th>Home Phone</th>
                                                                <th>Cell Phone</th>
                                                                <th>City</th>
                                                                <th>State</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><strong><?= $hchild->user->user->user->userInfos->first_name.' '.$hchild->user->user->user->userInfos->last_name ?></strong></td>
                                                                <td><?= $hchild->user->user->user->email ?></td>
                                                                <td><?= $hchild->user->user->user->userInfos->phone ?></td>
                                                                <td><?= $hchild->user->user->user->userInfos->cell_phone ?></td>
                                                                <td><?= $hchild->user->user->user->userInfos->city ?></td>
                                                                <td><?= Yii::$app->params['us_states'][ $hchild->user->user->user->userInfos->state ] ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div><!-- .fm-contestant-parent -->

                                            <div class="btns-group hidden-view text-center">
                                                <input type="submit" value="Save" class="btn btn-success">
                                                <input type="reset" value="Cancel" class="btn btn-brd-success reset_contestants toggle-mode">
                                            </div>
                                        </div>
                                    </div><!-- .fm-contestant-box -->
                                <?php ActiveForm::end(); ?>
                                <?php
                            }
                        }
                        ?>
                    </div><!-- .fm-contestant-list -->
                </div><!-- .panel-cont -->
            </section><!-- .panel-box -->
        <?php } ?>



        <!--
        <section class="review-box panel-light">
             <h3>Please review and sign each of the following forms</h3>
             <div class="panel-gray text-center">
                 <ul class="choose-group ">
                     <li >
                         <label class="choose-box">
                             <input type="checkbox" name="options2" checked=""><span></span> Host Agreement
                         </label>
                     </li>
                     <li>
                         <label class="choose-box">
                             <input type="checkbox" name="options2"  autocomplete="off"><span></span> Statement of Faith
                         </label>
                     </li>
                     <li>
                         <label class="choose-box">
                             <input type="checkbox" name="options2" autocomplete="off"><span></span> Culture Agreement
                         </label>
                     </li>
                 </ul>
             </div>
             <div class="btn-wrap text-center">
                 <button class="btn btn-lg btn-success"  type="submit">Submit</button>
             </div>
        </section>
        -->
    </div>
</section>