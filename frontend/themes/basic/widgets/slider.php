<?php
use common\models\Slides;
use yii\db\ActiveQuery;

    if($slider_name){
        $slides = Slides::find()->where("slider_id = {$slider_name}")->orderBy('order')->all();
    ?>
        <section id="md-slider-block" class="md-slide-items main-slider" data-thumb-width="100" data-thumb-height="75">
            <?php foreach($slides as $slide):?>
                <div class="md-slide-item" data-timeout="8000" data-transition="right-curtain" data-thumb-type="image" data-thumb-alt="" data-thumb="<?php echo Yii::$app->homeUrl;?>upload/<?php echo $slide->slide;?>" >
                    <div class="md-mainimg">
                        <?php if($slide->link):?>
                            <a href="<?php echo $slide->link;?>">
                        <?php endif;?>
                            <img src="<?php echo Yii::$app->homeUrl;?>upload/<?php echo $slide->slide;?>" alt="<?php echo $slide->slide;?>" >
                        <?php if($slide->link):?>
                            </a>
                        <?php endif;?>
                    </div>
                </div>
            <?php endforeach;?>
        </section>
    <?php }
?>