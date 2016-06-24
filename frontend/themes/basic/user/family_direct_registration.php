<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\LiveEdit;
use \common\components\attachments;

?>

    <!-- login form -->
    <div class="gen-box inner-wrapper text-center container-lg family-reg-form">
        <h2 class="title text-featured sep-bottom"><?= LiveEdit::text(__FILE__, 'Welcome to Family Registration') ?></h2>

        <h3 class="caption text-primary2"><?= LiveEdit::text(__FILE__, 'Text/Summary') ?></h3>

        <div class="gen-text sep-bottom -sm">
            <p><?= LiveEdit::text(__FILE__, 'Please review the fields below. After checkout is completed you will be directed to your Dashboard.') ?></p>
        </div>

        <?php $form = ActiveForm::begin(["options" => ["class" => "family_registration_form long_form", 'id' => 'family-registration-form']]);
        ?>

        <?php if ($usermodel->status == 0) { ?>
            <section class="create-section section">

                <div class="create-password">
                    <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Create a Password') ?></h3>
                    <input type="hidden" id="family_direct_reg">

                    <div class="form-part centered col-lg-11 view-mode text-left">
                        <div class="pass-wrap row">
                            <?= $form->field($usermodel, 'email', ["template" => "{input}{error}", "enableAjaxValidation" => true, "options" => ["tag" => "div", "class" => "form-group stay-edit col-md-6"]])->textInput(['type' => 'email', "placeholder" => "Email",]) ?>
                            <?= $form->field($usermodel, 'email_confirm', ["template" => "{input}{error}", "options" => ["tag" => "div", "class" => "form-group stay-edit col-md-6"]])->textInput(['value' => $usermodel->email,'type' => 'email', "placeholder" => "Email confirmation",]) ?>
                        </div>
                        <div class="pass-wrap row">
                            <?= $form->field($usermodel, 'password', ["template" => "{input}{error}", "options" => ["tag" => "div", "class" => "form-group stay-edit col-md-6"]])->passwordInput(["placeholder" => "New Password", 'value' => '', "autocomplete" => "new-password"]) ?>
                            <?= $form->field($usermodel, 'password_repeat', ["template" => "{input}{error}", "options" => ["tag" => "div", "class" => "form-group stay-edit col-md-6"]])->passwordInput(["placeholder" => "Repeat Password", 'value' => '', "autocomplete" => "new-password"]) ?>
                        </div>
                        <div class="help-block clearfix text-center">
                            <h4 class="text-brown"><?= LiveEdit::text(__FILE__, 'Password Requirements') ?></h4>
                            <?= LiveEdit::text(__FILE__, 'Minimum 6 characters in length', 'div', 'wysiwyg') ?>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <h3 class="title -md text-featured"><span
                            class="text-success"><?= LiveEdit::text(__FILE__, 'or') ?></span> <?= LiveEdit::text(__FILE__, 'Connect with Google') ?>
                    </h3>

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
                            <button class="btn btn-outline btn-sm btn-success host_renew_restore_fb">Remove connection
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        <?php } else { ?>
            <!-- ************  bb_account   ***************   -->
            <?php echo $this->render("family/_bb_account", array('userinfomodel' => $userinfomodel)) ?>

        <?php } ?>



        <!-- ************  user info   ***************   -->
        <?php echo $this->render("family/_info", array('userinfomodel' => $userinfomodel, 'form' => $form, 'model' =>  $model)) ?>



        <section class="section create-section mode-section edit-mode">
            <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Contestant Information') ?></h3>

            <p class="subtitle"><?= LiveEdit::text(__FILE__, 'This information is private and and will only be used by Bible Bee staff.') ?></p>

            <div class="form-part centered col-lg-11">
                <h5 class="group-label hidden-edit text-left renew_host_user_name"></h5>

                <div id="contestant-form-wrap">
                    <div id="contestant-form-list">
                        <?php
                        $index = 0;
                        if ($model->children) {
                            foreach ($model->children as $child) {
                                if($child->order->status == 0) {
                                    echo $this->render("family/_child", array("model" => $child, "index" => $index, "form" => $form, "include_js" => false));
                                    $index++;
                                }
                            }
                        } else {
                            $index = 0;
                        }

                        ?>
                    </div>

                    <div class="contestant-form-btn">
                        <?php
                        echo Html::a('<span>+</span> Add Children', '#', array('id' => 'loadChildByAjax', 'class' => 'btn btn-lg btn-success'));
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="section create-section">
            <div class="form-part centered col-lg-11">
                <label class="form-control-checkbox next-year-interest">
                    <input type="checkbox" name="next_year_interested" value="1"><span
                        class="form-checkbox"></span>
                    <?= LiveEdit::text(__FILE__, '<strong>I would like to receive information about becoming a Bible Bee Host in 2017</strong>') ?>
                </label>
            </div>
        </section>

        <!-- ************  donation   ***************   -->
        <?php echo $this->render("family/_donation", array('donate_count' => $donate_count)) ?>


        <!-- ************  agreement   ***************   -->
        <?php echo $this->render("family/_agreement", array('parent_agreement' => $parent_agreement)) ?>


        <!-- ************  hear about   ***************   -->
        <?php echo $this->render("family/_hear_about", array('userinfomodel' => $userinfomodel, 'hear_about' => $hear_about, 'form' => $form)); ?>



        <div class="family-reg-checkout" id="family-reg-cart">
            <?php
                echo $this->context->actionUpdatecartbyajax();
            ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

<?php $this->render("family/_script", array('index' => $index)); ?>