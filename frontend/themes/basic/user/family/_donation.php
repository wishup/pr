<?php
use common\components\LiveEdit;
use yii\helpers\Html;
?>
<section class="section create-section">
    <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Would you like to sponsor another contestant ?') ?></h3>

    <div class="form-part centered col-lg-11">
        <div class="row">
            <div class="col-sm-6">
                <p class="note-box">
                    <i class="icon icon-faq"></i>
                    <?= LiveEdit::text(__FILE__, 'There are many children that would love the opportunity to participate in the National Bible Bee. Please consider sponsoring a contestant.') ?>
                </p>
            </div>
            <div class="col-sm-6">
                <div class="choose-box-multi clearfix">
                    <label class="choose-box -outline">
                        <input type="checkbox" checked class="agreement_popup_check" id="donate_agree"
                               name="donate_agree" data-child-id="" autocomplete="off"><span></span>
                    </label>
                            <span
                                class="choose-box-text">$<span>25</span>/<?= LiveEdit::text(__FILE__, 'each') ?></span>
                    <?php echo Html::dropDownList('donate_count', $donate_count, [0 => 0, 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10], array('id' => 'donate_count', 'class' => 'choose-box-select')); ?>
                </div>
            </div>
        </div>
    </div>
</section>