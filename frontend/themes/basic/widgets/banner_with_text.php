<?php
use common\components\attachments;
use common\components\LiveEdit;

    if( $url == '' || $url == 'http://' ) $url_tag = false; else $url_tag = true;
    if($type == '2'){
        $class = "footer-featured";
    }else{
        $class = "featured";
    }
    ?>
    <section class="<?php echo $class;?> bg-block" <?php if( isset($image[0]["base_url"]) ) {?> style = "background-image: url(<?= addslashes($image[0]["base_url"]) ?>);" <?php }?>>
        <?php if( $url_tag ){ ?><a href="<?= $url ?>" <?= $target_blank == 1 ? 'target="_blank"' : '' ?>></a><?php } ?>
        <div class="container">
            <?php
                if($text_filed_1) {
                    if ($type == '2') {
                        ?>
                        <blockquote class="text-center -brand-warning"><?= LiveEdit::widgetField( $text_filed_1, "text_filed_1", $widget_id ) ?></blockquote>
                    <?php
                    } else {
                        ?>
                        <h2 class="h1"><?= LiveEdit::widgetField( $text_filed_1, "text_filed_1", $widget_id ) ?></h2>
                    <?php
                    }
                }
                if($text_filed_2) {
                    if ($type == '2') {
                        ?>
                        <h6 class="blockquote-caption"><?= LiveEdit::widgetField( $text_filed_2, "text_filed_2", $widget_id ) ?></h6>
                    <?php } else { ?>
                        <h4 class="no-bold"><?= LiveEdit::widgetField( $text_filed_2, "text_filed_2", $widget_id ) ?></h4>
                    <?php
                    }
                }
            ?>
        </div>
    </section>