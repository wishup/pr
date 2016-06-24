<?php
use common\components\LiveEdit;
?>
<?php if($bg_1 || $text_1 || $text_2 || $button_text_1 || $text_3):?>
    <section class="home-studyguide featured-section container-lg bg-block"<?php if($bg_1):?> style="background-image:url(<?= addslashes($bg_1[0]["base_url"]) ?>)"<?php endif;?>>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 pull-sm-right">
                    <?php if($text_1):?>
                        <h2 class="title text-featured"><?= LiveEdit::widgetField( $text_1, "text_1", $widget_id ) ?></h2>
                    <?php endif;?>
                    <?php if($text_2):?>
                        <h3 class="title2"><?= LiveEdit::widgetField( $text_2, "text_2", $widget_id ) ?></h3>
                    <?php endif;?>
                    <?php if($button_link_1):?>
                    <a href="<?php echo $button_link_1;?>" class="btn btn-lg btn-featured">
                        <?php endif;?>
                        <?php if($button_text_1):?>
                            <span><?= LiveEdit::widgetField( $button_text_1, "button_text_1", $widget_id ) ?></span> <i class="icon-arrow-right" aria-hidden="true"></i>
                        <?php endif;?>
                        <?php if($button_link_1):?>
                    </a>
                <?php endif;?>
                </div>
            </div>
            <?php if($text_3):?>
                <h4 class="block-title text-brown"><?= LiveEdit::widgetField( $text_3, "text_3", $widget_id ) ?></h4>
            <?php endif;?>
        </div>
    </section>
<?php endif;?>
<?php if($bg_2_c || $text2_1_c || $text2_2_c || $quote_c || $quote_author_c || $button_text_2_c):?>
    <section class="host-section container-lg"<?php if($bg_2_c):?> style="background:url(<?= addslashes($bg_2_c[0]["base_url"]) ?>) right top no-repeat #e8deca"<?php endif;?>>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <?php if($text2_1_c):?>
                        <h2 class="caption text-brown"><?= LiveEdit::widgetField( $text2_1_c, "text2_1_c", $widget_id ) ?></h2>
                    <?php endif;?>
                    <?php if($text2_2_c):?>
                        <h3 class="title text-primary"><?= LiveEdit::widgetField( $text2_2_c, "text2_2_c", $widget_id ) ?></h3>
                    <?php endif;?>
                    <?php if($quote_c):?>
                        <blockquote>
                            <?= LiveEdit::widgetField( $quote_c, "quote_c", $widget_id ) ?>
                            <?php if($quote_author_c):?>
                                <div class="blockquote-caption text-brown"> <?= LiveEdit::widgetField( $quote_author_c, "quote_author_c", $widget_id ) ?></div>
                            <?php endif;?>
                        </blockquote>
                    <?php endif;?>
                    <?php if($button_link_2_c):?>
                    <a href="<?php echo $button_link_2_c;?>" class="btn btn-lg btn-primary">
                        <?php endif;?>
                        <?php if($button_text_2_c):?>
                            <span><?= LiveEdit::widgetField( $button_text_2_c, "button_text_2_c", $widget_id ) ?></span> <i class="icon-arrow-right" aria-hidden="true"></i>
                        <?php endif;?>
                        <?php if($button_link_2_c):?>
                    </a>
                <?php endif;?>
                </div>
            </div>
        </div>
    </section>
<?php endif;?>
<?php if($bg_2 || $text2_1 || $text2_2 || $quote || $quote_author || $button_text_2):?>
    <section class="host-section container-lg"<?php if($bg_2):?> style="background:url(<?= addslashes($bg_2[0]["base_url"]) ?>) right top no-repeat #e8deca"<?php endif;?>>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <?php if($text2_1):?>
                        <h2 class="caption text-brown"><?= LiveEdit::widgetField( $text2_1, "text2_1", $widget_id ) ?></h2>
                    <?php endif;?>
                    <?php if($text2_2):?>
                        <h3 class="title text-primary"><?= LiveEdit::widgetField( $text2_2, "text2_2", $widget_id ) ?></h3>
                    <?php endif;?>
                    <?php if($quote):?>
                        <blockquote>
                            <?= LiveEdit::widgetField( $quote, "quote", $widget_id ) ?>
                            <?php if($quote_author):?>
                                <div class="blockquote-caption text-brown"> <?= LiveEdit::widgetField( $quote_author, "quote_author", $widget_id ) ?></div>
                            <?php endif;?>
                        </blockquote>
                    <?php endif;?>
                    <?php if($button_link_2):?>
                    <a href="<?php echo $button_link_2;?>" class="btn btn-lg btn-primary">
                        <?php endif;?>
                        <?php if($button_text_2):?>
                            <span><?= LiveEdit::widgetField( $button_text_2, "button_text_2", $widget_id ) ?></span> <i class="icon-arrow-right" aria-hidden="true"></i>
                        <?php endif;?>
                        <?php if($button_link_2):?>
                    </a>
                <?php endif;?>
                </div>
            </div>
        </div>
    </section>
<?php endif;?>
<?php if($bg_3 || $text3_1 || $text3_2 || $iframe_url):?>
    <section class="video-wrapper text-center" data-stellar-background-ratio="0.2"<?php if($bg_3):?> style="background-image:url(<?= addslashes($bg_3[0]["base_url"]) ?>)"<?php endif;?>>
        <div class="container">
            <?php if($text3_1):?>
                <h2 class="caption text-brown"><?= LiveEdit::widgetField( $text3_1, "text3_1", $widget_id ) ?></h2>
            <?php endif;?>
            <?php if($text3_2):?>
                <h3 class="title -md text-featured"><?= LiveEdit::widgetField( $text3_2, "text3_2", $widget_id ) ?> </h3>
            <?php endif;?>
        </div>
        <?php if($iframe):?>
            <div class="video-box">
                <div class="embed-responsive embed-responsive-16by9">
                    <?= LiveEdit::widgetField( $iframe, "iframe", $widget_id ) ?>
                </div>
            </div>
        <?php endif;?>
    </section>
<?php endif;?>