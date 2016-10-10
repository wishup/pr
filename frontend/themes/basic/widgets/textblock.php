<?php
use common\components\LiveEdit;
?>
    <section class="mt-about-sec">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <?php
                    echo LiveEdit::widgetField( $content, "content", $widget_id, "wysiwyg", "div" );
                    ?>

                </div>
            </div>
        </div>
    </section>
