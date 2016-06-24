<?php
use common\components\LiveEdit;

if( isset( $partner ) && count( $partner ) > 0 ) {
    ?>
    <section class="ministry-partners">
        <h2 class="sep-border no-bold"><?= LiveEdit::text(__FILE__, 'Ministry Partners') ?></h2>
        <ul class="partner-list block-md-2 list-bordered clearfix">
            <?php
            foreach( $partner as $p_index=>$p ){
                ?>
                <li>
                    <h5><?= LiveEdit::widgetField( $p["name"], "partner%".$p_index."%name", $widget_id ) ?></h5>

                    <p><?= LiveEdit::widgetField( $p["description"], "partner%".$p_index."%description", $widget_id ) ?></p>
                    <?php if( $p["url"] != '' ){ ?><a href="<?= substr($p["url"],0,7)!='http://' ? 'http://'.$p["url"] : $p["url"] ?>" class="link"> <?= $p["url"] ?></a><?php } ?>
                </li>
                <?php
            }
            ?>
        </ul>
    </section>
<?php
}
?>