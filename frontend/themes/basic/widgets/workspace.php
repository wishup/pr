<?php
if( $galitems = \common\models\GalleryItem::find()->where("gallery_id=".(int)$gallery_id)->all() ) {
    ?>
    <section class="mt-workspace-sec wow fadeInUp" data-wow-delay="0.4s">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2>OUR WORKSPACE</h2>
                </div>
            </div>
        </div>
        <!-- Work Slider of the Page -->
        <ul class="list-unstyled work-slider">
            <li style="outline:none;">
                <?php
                $ii = 0;
                foreach ($galitems as $galitem){
                    ?>
                    <div class="img-holder" style="width:48%; height:450px;">
                        <img src="<?= \common\components\attachments::getThumbnailUrl( '/upload/'.$galitem->image, 500, 500, 'AUTO' ) ?>" alt="">
                    </div>
                    <?php
                    $ii++;
                    if (fmod($ii, 2) == 0 && count($galitems) > $ii){
                        ?>
                        </li>
                        <li style="outline:none;">
                        <?php
                    }
                }
                ?>
            </li>
        </ul>
        <!-- Work Slider of the Page end -->
    </section>
<?php
}
?>