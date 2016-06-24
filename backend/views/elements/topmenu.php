<?php
    use yii\helpers\Url;
use common\components\LiveEdit;
use common\models\Seasons;
?>
<div class="top-menu">
    <ul class="nav navbar-nav pull-right">
        <li class="separator hide"> </li>

        <!-- BEGIN USER LOGIN DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

        <li>
            <button style="margin-top:20px" class="btn btn-<?= LiveEdit::status() ? "danger" : "info" ?> btn-sm right <?= LiveEdit::status() ? "live_edit_is_on" : "live_edit_is_off" ?>" id="live_edit_change_status" data-status="<?= LiveEdit::status() ? "off" : "on" ?>">Live Edit <?= LiveEdit::status() ? "Off" : "On" ?></button>
        </li>
        <li class="dropdown dropdown-user dropdown-dark">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <span class="username username-hide-on-mobile"> <?= Yii::$app->user->identity->username ?> </span>
                <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                 </a>
            <ul class="dropdown-menu dropdown-menu-default">
                <li>
                    <a href="<?php echo Url::to(['user/profile']);?>">
                        <i class="icon-user"></i> My Profile </a>
                </li>
                <li class="divider"> </li>
                <li>
                    <a href="<?= Yii::$app->homeUrl; ?>site/logout" data-method="post">
                        <i class="icon-key"></i> Log Out </a>
                </li>
            </ul>
        </li>
        <!-- END USER LOGIN DROPDOWN -->
        <!-- BEGIN QUICK SIDEBAR TOGGLER -->
        <li class="dropdown dropdown-extended quick-sidebar-toggler">
            <span class="sr-only">Toggle Quick Sidebar</span>
            <i class="icon-star"></i>
        </li>
        <!-- END QUICK SIDEBAR TOGGLER -->
    </ul>
</div>