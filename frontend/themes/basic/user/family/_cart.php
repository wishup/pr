
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\LiveEdit;
?>
<div class="row">
    <div class="col-lg-offset-3 col-lg-4 col-md-offset-2 col-md-5">
        <section class="reg-total">
            <h3><?= LiveEdit::text(__FILE__, 'Registration Totals') ?></h3>
            <?php

            $cart = Yii::$app->session->get('family_cart');

            $children =@$cart['children'];
            $donation_count =@$cart['donation_count'];
            $donation =@$cart['donation'];

            $discount =@$cart['discount'];
            $discount_code =@$cart['discount_code'];
            $discount_error =@$cart['discount_error'];

            $total = isset($cart['total'])?$cart['total']:0;

            ?>

            <div class="reg-total-data">
                <table id="cart">
                    <?php $forChildrenTotal = 0; ?>
                    <?php if(count($children) >  0 ) { ?>
                        <?php foreach ($children as $index => $child){ ?>
                            <tr id="item<?php echo $index; ?>">
                                <td class="reg-name"><?php echo isset($child['name']) ? $child['name'] : ''; ?></td>
                                <td class="reg-status"><?php  echo (isset($child['age_group']) and $child['age_group'])?"(".$child['age_group'].")":""; ?></td>
                                <?php if(isset($child['price'])) { ?>
                                <td class="reg-price">$
                                    <?php
                                    echo $child['price'];
                                    ?>
                                </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($donation > 0){ ?>
                        <tr>
                            <td class="reg-name">Sponsoring</td>
                            <td class="reg-status"></td>
                            <td class="reg-price">$<?php  echo $donation;  ?></td>
                        </tr>
                    <?php }?>
                    <?php if($discount> 0){
                        ?>
                    <tr>
                        <td class="reg-name">Discount</td>
                        <td class="reg-status"></td>
                        <td class="reg-price">-$<?php echo $discount;  ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="row">
                <div class="form-group col-md-12 <?php echo ($discount_error)?'has-error':''; ?>">
                    <?php echo \yii\bootstrap\Html::textInput('discount_code', $discount_code, array('onchange'=>'updateCart("discount", "", $(this).val());', 'class'=>'form-control', 'placeholder'=>'Coupon Code'))?>
                    <?php if($discount_error) {?>
                    <div class="help-block"><?php echo $discount_error; ?></div>
                    <?php } ?>
                </div>
            </div>
            <div class="reg-total-amount">Total<span id="total_payment">$<?php echo $total; ?></span></div>
        </section>
    </div>
    <div class="panel-gray">
        <div class="row">
            <div class="col-lg-offset-7 col-lg-2 col-md-offset-7 col-md-3">
                <button type="submit"
                        class="btn btn-lg btn-success"><?= LiveEdit::text(__FILE__, 'Checkout') ?></button>
            </div>
        </div>
    </div>
</div>