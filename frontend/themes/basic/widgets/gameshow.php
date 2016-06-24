<?php
use common\components\LiveEdit;
?>
<section class="gameshow-block bg-block"<?php if($bg):?> style = "background-image: url(<?php echo addslashes($bg[0]["base_url"]);?>)"<?php endif;?>">
    <?php if($gameshow_logo):?>
        <div class="gs-obj col-md-4"><img title="Gameshow Logo" src="<?php echo addslashes($gameshow_logo[0]["base_url"]);?>" alt="Gameshow Logo" /></div>
    <?php endif;?>
    <div class="gs-body col-md-6  col-lg-5 text-right">
        <h2 class="text-left"><?php echo LiveEdit::text(__FILE__, "season2")?></h2>
        <h3><?php echo LiveEdit::text(__FILE__, "Coming soon")?></h3>
        <h4><?php echo LiveEdit::text(__FILE__, "THE REALITY GAME SHOW that proclaims God's word")?></h4>
        <div class="text-left"><a class="btn" href="/gameshow"><?php echo LiveEdit::text(__FILE__, "Learn more")?></a></div>
        <div class="clearfix">
            <p class="text-center"><small><?php echo LiveEdit::text(__FILE__, "with co-hosts")?></small></p>
            <ul class="gs-list">
                <li><small><?php echo LiveEdit::text(__FILE__, "the")?></small><strong><?php echo LiveEdit::text(__FILE__, "Benham")?></strong> <?php echo LiveEdit::text(__FILE__, "Brothers")?></li>
                <li><?php echo LiveEdit::text(__FILE__, "Hannah")?> <strong><?php echo LiveEdit::text(__FILE__, "Leary")?></strong></li>
                <li><?php echo LiveEdit::text(__FILE__, "Emeal")?> <strong><?php echo LiveEdit::text(__FILE__, "Zwayne")?></strong></li>
            </ul>
        </div>
        <div class="gs-starring text-right">
            <h4><small><?php echo LiveEdit::text(__FILE__, "starring")?></small> <?php echo LiveEdit::text(__FILE__, "Kirk")?><br /> <?php echo LiveEdit::text(__FILE__, "Cameron")?></h4>
        </div>
    </div>
</section>