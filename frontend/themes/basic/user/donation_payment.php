<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\LiveEdit;
?>

<!-- login form -->
<div class="gen-box inner-wrapper text-center container-lg family-reg-form">
    <?php $form = ActiveForm::begin(["options" => ["autocomplete" => "off"]]); ?>
    <h2 class="title text-featured sep-bottom"><?= LiveEdit::text(__FILE__, 'Title for the Donate Page') ?></h2>

    <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Would you like to make a') ?></h3>

    <h3 class="caption text-primary2"></h3>

    <div class="gen-text sep-bottom -sm">

        <div class="donation-btn-group">
            <?php if($model->dyn_id) { ?>
                <div class="btn btn-primary btn-checkbox">
                    <label class=" form-control-checkbox">
                        <input type="checkbox" name="donation_monthly" <?php echo (!$model->donation_type || $model->donation_type == 'm')?"checked":""?> value="1"><span class="form-checkbox"></span>
                        <?= LiveEdit::text(__FILE__, 'Monthly Donation') ?>
                    </label>
                </div>
            <?php } ?>

            <div class="btn btn-primary btn-checkbox">
                <label class="form-control-checkbox">
                    <input type="checkbox" name="donation_one" <?php echo ($model->donation_type == 'o' || !$model->dyn_id)?"checked":""?> value="1"><span class="form-checkbox"></span>
                    <?= LiveEdit::text(__FILE__, 'One Time Donation') ?>
                </label>
            </div>
        </div>

        <div class="donation-select">
            <div class="price-select">
                <div class="select-val">
                    <span class="sign">$</span>
                    <span class="amount">1</span>
                    <span class="arrow"><i class="icon icon-arrow-down"></i></span>
                </div>
                <?php echo Html::activeDropDownList($model, 'amount', Yii::$app->params['donation_amounts']) ?>
            </div>
            <?php echo $form->field($model, 'amount_other', ['enableClientValidation'=>false, "template" => "{input}"])->textInput(array('id'=> 'familypayment-amount_other', 'class'=>'form-control' )) ?>
        </div>
    </div>
    <section class="section edit-mode">
        <div class="row">
            <div class="col-md-6">
                <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Your Information') ?></h3>

                <?= $form->field($model, 'first_name', ["template" => "{input}{error}"])->textInput(["placeholder" => $model->getAttributeLabel("first_name")]) ?>
                <?= $form->field($model, 'last_name', ["template" => "{input}{error}"])->textInput(["placeholder" => $model->getAttributeLabel("last_name")]) ?>
                <?= $form->field($model, 'email', ["template" => "{input}{error}"])->textInput(["placeholder" => $model->getAttributeLabel("email")]) ?>

            </div>

            <div class="col-md-6">
                <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Billing Address') ?></h3>

                <?= $form->field($model, 'address_1', ["template" => "{input}{error}"])->textInput(["placeholder" => $model->getAttributeLabel("address_1")]) ?>
                <?= $form->field($model, 'address_2', ["template" => "{input}{error}"])->textInput(["placeholder" => $model->getAttributeLabel("address_2")]) ?>

                <div class="row gutter-10">
                    <div class="col-md-5">
                        <?= $form->field($model, 'city', ["template" => "{input}{error}"])->textInput(["placeholder" => $model->getAttributeLabel("city")]) ?>
                    </div>

                    <div class="col-md-3">
                        <?= $form->field($model, 'state', ["template" => "{input}{error}"])->dropDownList(\Yii::$app->params["us_states"]) ?>
                    </div>

                    <div class="col-md-4">
                        <?= $form->field($model, 'zip', ["template" => "{input}{error}"])->textInput(["placeholder" => $model->getAttributeLabel("zip")]) ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section edit-mode">
        <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Credit Card Information') ?></h3>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'card_number', ["template" => "{input}{error}"])->textInput(["placeholder" => $model->getAttributeLabel("card_number"), "autocomplete" => "off"]) ?>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-7">
                        <?= $form->field($model, 'card_date', ["template" => "{input}{error}"])->textInput(["placeholder" => $model->getAttributeLabel("card_date"), "class" => "form-control mm_yy_mask", "autocomplete" => "off"]) ?>
                    </div>

                    <div class="col-md-5">
                        <?= $form->field($model, 'card_cvv', ["template" => "{input}{error}"])->textInput(["placeholder" => $model->getAttributeLabel("card_cvv"), "autocomplete" => "off"]) ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section edit-mode">
        <h3 class="caption-sm text-primary2"><?= LiveEdit::text(__FILE__, 'If you would rather donate by check, please mail to') ?></h3>

        <p><strong><?= LiveEdit::text(__FILE__, 'National Bible Bee</strong><br/>18615 Tuscany Stone Ste. 200<br/>San Antonio, TX 78258</p>') ?>
    </section>

    <div class="fm-pay-panel panel-gray">
        <span class="fm-panel-badge"></span>
        <?= Html::submitButton("Submit", ["class" => "btn btn-success btn-bold"]) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
