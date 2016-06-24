<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\LiveEdit;
?>

<!-- login form -->
<div class="gen-box inner-wrapper text-center container-lg family-reg-form">
    <h2 class="title text-featured sep-bottom"><?= LiveEdit::text(__FILE__, 'Title for the Payment Page') ?></h2>
    <h3 class="caption text-primary2"><?= LiveEdit::text(__FILE__, 'Text/Summary') ?></h3>
    <div class="gen-text sep-bottom -sm">
        <p><?= LiveEdit::text(__FILE__, 'Please review the fields below. After checkout is completed you will be directed to your Dashboard.') ?></p>
    </div>
    <?php $form = ActiveForm::begin(["options"=>["autocomplete"=>"off", "class"=>"long_form"]]); ?>
        <section class="section edit-mode">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Your Information') ?></h3>

                    <?= $form->field($model, 'first_name', ["template"=>"{input}{error}"])->textInput(["placeholder" => $model->getAttributeLabel("first_name")]) ?>
                    <?= $form->field($model, 'last_name', ["template"=>"{input}{error}"])->textInput(["placeholder" => $model->getAttributeLabel("last_name")]) ?>
                    <?= $form->field($model, 'email', ["template"=>"{input}{error}"])->textInput(["placeholder" => $model->getAttributeLabel("email")]) ?>

                </div>

                <div class="col-md-6">
                    <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Billing Address') ?></h3>

                    <?= $form->field($model, 'address_1', ["template"=>"{input}{error}"])->textInput(["placeholder" => $model->getAttributeLabel("address_1")]) ?>
                    <?= $form->field($model, 'address_2', ["template"=>"{input}{error}"])->textInput(["placeholder" => $model->getAttributeLabel("address_2")]) ?>

                    <div class="row gutter-10">
                        <div class="col-md-5">
                            <?= $form->field($model, 'city', ["template"=>"{input}{error}"])->textInput(["placeholder" => $model->getAttributeLabel("city")]) ?>
                        </div>

                        <div class="col-md-3">
                            <?= $form->field($model, 'state', ["template"=>"{input}{error}"])->dropDownList( \Yii::$app->params["us_states"] ) ?>
                        </div>

                        <div class="col-md-4">
                            <?= $form->field($model, 'zip', ["template"=>"{input}{error}"])->textInput(["placeholder" => $model->getAttributeLabel("zip")]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section edit-mode">
            <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Credit Card Information') ?></h3>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'card_number', ["template"=>"{input}{error}"])->textInput(["placeholder" => $model->getAttributeLabel("card_number"), "autocomplete"=>"off"]) ?>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-7">
                            <?= $form->field($model, 'card_date', ["template"=>"{input}{error}"])->textInput(["placeholder" => $model->getAttributeLabel("card_date"), "class" => "form-control mm_yy_mask", "autocomplete"=>"off"]) ?>
                        </div>

                        <div class="col-md-5">
                            <?= $form->field($model, 'card_cvv', ["template"=>"{input}{error}"])->textInput(["placeholder" => $model->getAttributeLabel("card_cvv"), "autocomplete"=>"off"]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section edit-mode">
            <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Your total cart') ?></h3>

            <div class="fm-cart-total">
                <?php
                foreach( $order_items as $item ){

                    ?>
                    <div class="fm-cart-row clearfix">
                        <div class="fm-cart-name"><?= $item->title ?></div>
                        <div class="fm-cart-status"><?= $item->description ?></div>
                        <div class="fm-cart-price">$<?= $item->subtotal ?></div>
                    </div>
                    <?php

                }
                ?>

                <?php if($order->discount > 0 ) { ?>
                    <div class="fm-cart-foot clearfix">
                        <div class="fm-cart-price">-$<?= $order->discount ?></div>
                        <div class="fm-cart-status"><?= LiveEdit::text(__FILE__, 'Discount:') ?></div>
                    </div>
                <?php }?>

                <div class="fm-cart-foot clearfix">
                    <div class="fm-cart-price">$<?= $order->final_price; ?></div>
                    <div class="fm-cart-status"><?= LiveEdit::text(__FILE__, 'Order Total:') ?></div>
                    <!--
                    <div class="fm-cart-form">
                        <?= $form->field($model, 'admin_code', ["template"=>"{input}"])->textInput(["placeholder" => $model->getAttributeLabel("admin_code")]) ?>
                        <button class="btn btn-brd btn-bold" type="button">Update</button>
                    </div>
                    -->
                </div>
            </div>
        </section>

        <div class="fm-pay-panel panel-gray">
            <span class="fm-panel-badge"></span>
            <?php
            if($from = "d"){
                $familyRegUrl = "/user/familydirectregistration/".$usermodel->id;
            } else if ($from  = "c"){
                $familyRegUrl = "/user/addchildren/".$usermodel->id;
            } else {
                $familyRegUrl = "/user/familyregistration/".$usermodel->id."?token=".$tokenmodel->token;
            }

            ?>
            <a href="<?php echo $familyRegUrl; ?>" class="btn btn-brd-success btn-bold">go back to edit</a>
            <?= Html::submitButton("Submit", ["class" => "btn btn-success btn-bold"]) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
