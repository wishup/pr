<?php
use common\components\LiveEdit;
use yii\helpers\Html;
?>
<section class="section">
    <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Please review and sign each of the following forms') ?></h3>

    <div class="panel-gray">
        <ul class="choose-group">
            <li>
                <a href="#agreementPopup1" class="choose-box popup-with-form">
                    <input type="checkbox" <?php echo (isset($parent_agreement) and $parent_agreement)?"checked":"";  ?> name="agreement1" id="agreement_1"><span></span>
                    <em class="hidden-xs"><?= LiveEdit::text(__FILE__, 'Please Review and Sign Parent Agreement') ?></em>
                    <em class="visible-xs-inline"><?= LiveEdit::text(__FILE__, 'Please Review ...') ?></em>
                </a>
            </li>
        </ul>
        <!-- agreement popups -->
        <div id="agreementPopup1" class="agreement-popup popup-block popup-has-close main-box -lg mfp-hide">
            <h3 class="no-bold"><?= LiveEdit::text(__FILE__, 'STATEMENT OF FAITH') ?></h3>
            <label class="choose-box -outline">
                <input type="checkbox" class="agreement_popup_check"  data-child-id="agreement_1"
                       autocomplete="off"><span
                    style="border: none;"></span><?= LiveEdit::text(__FILE__, 'I agree that the below statements are true, and agree to abide by these conditions as a Bible Bee volunteer.') ?>
            </label>

            <div class="form-group">
                <input type="text" name="agreement_1_name" placeholder="Parent Name"
                       class="form-control agreement_name">
            </div>
            <div class="form-group clearfix">
                <input type="button" class="btn btn-success agreement_button no-print" value="Submit">
                <input type="button" onclick="window.print()" class="btn btn-primary no-print pull-right" value="Print">
            </div>
            <?= LiveEdit::text(__FILE__, 'Parent Agreement Content', 'div', 'wysiwyg') ?>
        </div>
    </div>
</section>
<style type="text/css">			
	@media print {
		body {
			padding: 0 !important;
		}	
		
		.mfp-wrap,		
		.mfp-content,
		.mfp-container,
		.popup-block {
			top: auto !important;
			left: auto !important;
			right: auto !important;
			bottom: auto !important;
			height: auto !important;
			position: relative !important;
			display: block !important;
			overflow: visible !important;			
		}
		
		.main,
		.mfp-bg,
		.no-print,
		.mfp-close,
		.widget_container {
			display:none !important;
		}
    }
</style>