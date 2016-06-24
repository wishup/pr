<?php
use common\components\LiveEdit;

if( LiveEdit::admin() && LiveEdit::status() ){
    ?>

    <div class="adminpanel_container">
                <?php
                if( LiveEdit::status() ){
                    ?>
                    <button class="btn btn-success btn-sm right" style="margin-left:20px" id="save_live_edit_changes">Save changes</button>
                    <?php
                }
                ?>

                <button class="btn btn-<?= LiveEdit::inline_status() ? 'success' : 'primary' ?> btn-sm right" id="live_edit_change_inline_status" style="margin-left:20px" data-status="<?= LiveEdit::inline_status() ? "off" : "on" ?>">Inline: <?= LiveEdit::inline_status() ? 'On' : 'Off' ?></button>

                <button class="btn btn-<?= LiveEdit::status() ? "danger" : "info" ?> btn-sm right <?= LiveEdit::status() ? "live_edit_is_on" : "live_edit_is_off" ?>" id="live_edit_change_status" data-status="<?= LiveEdit::status() ? "off" : "on" ?>">Live Edit <?= LiveEdit::status() ? "Off" : "On" ?></button>

    </div>

    <link href='<?php echo Yii::$app->homeUrl;?>css/adminpanel.css' rel='stylesheet' type='text/css'>
    <script src="<?php echo Yii::$app->homeUrl;?>js/adminpanel.js"></script>

    <?php



}