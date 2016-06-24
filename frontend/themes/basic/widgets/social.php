<?php
$this->registerJsFile('http://w.sharethis.com/button/buttons.js');
$this->registerJsFile(Yii::$app->homeUrl.'js/share.js');
?>
<div class="share-box well clearfix">
    <?php if($title):?>
        <h4 class="no-bold pull-left"><?php echo $title;?> </h4>
    <?php endif;?>
    <div class="soc-share pull-right">
        <span class='st_facebook_large' displayText='Facebook'></span>
        <span class='st_googleplus_large' displayText='Google +'></span>
        <span class='st_twitter_large' displayText='Tweet'></span>
        <span class='st_email_large' displayText='Email'></span>
        <span class='share-additional-btn st_sharethis_large' displayText='ShareThis'></span>
    </div>
</div>