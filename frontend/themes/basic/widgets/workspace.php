<section class="mt-workspace-sec wow fadeInUp" data-wow-delay="0.4s">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2>OUR WORKSPACE</h2>
            </div>
        </div>
    </div><?= count($image) ?>
    <!-- Work Slider of the Page -->
    <ul class="list-unstyled work-slider">
        <li style="outline:none;">
            <?php
            $ii=0;
            foreach( $image as $img ){
                ?>
                    <div class="img-holder" style="width:48%; height:450px;">
                        <img src="<?= $img['base_url'] ?>" alt="">
                    </div>
                <?php
                $ii++;
                if( fmod($ii, 2) == 0 && count($image) > $ii ){
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