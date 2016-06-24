<?php
use common\components\attachments;

if( isset($image[0]["base_url"]) ) {
?>
<section class="home-gameshow text-center">

    <?php if( $url == '' || $url == 'http://' ) $url_tag = false; else $url_tag = true; ?>
    <?php if( $url_tag ){ ?><a href="<?= $url ?>" <?= $target_blank == 1 ? 'target="_blank"' : '' ?>><?php } ?>
        <img src="<?= $image[0]["base_url"] ?>">
    <?php if( $url_tag ){ ?></a><?php } ?>
</section>
    <?php
}
?>