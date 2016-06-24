<?php
use common\components\LiveEdit;
use \common\components\attachments;
?>
<section class="create-section section">
    <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'BB acount') ?></h3>

    <div class="text-center">
        <div class="gplus-item soc-item">
            <div class="fb-account">
                <div class="media">
                    <div class="media-left">
                        <img class="media-object"
                             src="<?= $userinfomodel->avatar ? attachments::getThumbnailUrl('/upload/avatar/' . $userinfomodel->user_id . '/' . $userinfomodel->avatar, 100, 95, 'CROP') : '/images/avatar.jpg' ?>"
                             width="50" height="50">
                    </div>
                    <div class="media-body">
                        <h4 class="text-primary fb_user_name"><?php echo $userinfomodel->first_name . " " . $userinfomodel->last_name; ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>