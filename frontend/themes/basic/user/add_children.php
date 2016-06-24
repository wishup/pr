<?php
use yii\widgets\ActiveForm;
use common\components\LiveEdit;
use \common\components\attachments;
use yii\helpers\Html;

?>

    <!-- login form -->
    <div class="gen-box inner-wrapper text-center container-lg family-reg-form">
        <h2 class="title text-featured sep-bottom"><?= LiveEdit::text(__FILE__, 'Add Children') ?></h2>

        <h3 class="caption text-primary2"><?= LiveEdit::text(__FILE__, 'Text/Summary') ?></h3>

        <div class="gen-text sep-bottom -sm">
            <p><?= LiveEdit::text(__FILE__, 'Please review the fields below. After checkout is completed you will be directed to your Dashboard.') ?></p>
        </div>

        <?php $form = ActiveForm::begin(["options" => ["class" => "family_registration_form", 'id' => 'family-registration-form']]); ?>


        <!-- ************  bb_account   ***************   -->
        <?php echo $this->render("family/_bb_account", array('userinfomodel' => $userinfomodel)) ?>


        <section class="section mode-section edit-mode">
            <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Contestant Information') ?></h3>

            <p class="subtitle"><?= LiveEdit::text(__FILE__, 'This information is private and and will only be used by Bible Bee staff.') ?></p>

            <div class="form-part centered col-lg-11">
                <h5 class="group-label hidden-edit text-left renew_host_user_name"></h5>

                <div id="contestant-form-wrap">
                    <div id="contestant-form-list">
                        <?php
                        $index = 0;
                        if ($children) {
                            foreach ($children as $child) {
                                //  <!-- ************  child   ***************   -->
                                    echo $this->render("family/_child", array("model" => $child, "index" => $index, "form" => $form, "include_js" => false));
                                    $index++;
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


        <!-- ************  donation   ***************   -->
        <?php echo $this->render("family/_donation", array('donate_count' => 0)) ?>


        <!-- ************  agreement   ***************   -->
        <?php echo $this->render("family/_agreement", array('parent_agreement' => true)) ?>


        <div class="family-reg-checkout" id="family-reg-cart">
            <!-- ************  cart   ***************   -->
            <?php echo $this->render('family/_cart'); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

<?php $this->render("family/_script", array('index' => $index)); ?>