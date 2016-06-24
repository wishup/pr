<?php
use common\components\LiveEdit;

if( isset( $partner ) && count( $partner ) > 0 ) {
    ?>
    <section class="board-members">
        <h2 class="sep-border no-bold"><?= LiveEdit::text(__FILE__, 'Board members') ?></h2>
        <ul class="member-list block-md-2 clearfix">
            <?php
            foreach( $partner as $p_index=>$p ){
                ?>
                <li>
                    <a href="<?= (substr($p["url"],0,7)!='http://' && $p["url"]!='') ? 'http://'.$p["url"] : $p["url"] ?>">
                        <?= LiveEdit::widgetField( $p["name"], "partner%".$p_index."%name", $widget_id ) ?>
                        <?php if( $p["description"]!='' ){ ?> - <small><?= LiveEdit::widgetField( $p["description"], "partner%".$p_index."%description", $widget_id ) ?></small><?php } ?>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>
    </section>
<?php
}
