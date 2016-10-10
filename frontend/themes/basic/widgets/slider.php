<?php
use common\models\Slides;
use yii\db\ActiveQuery;

    if($slider_name){
        $slides = Slides::find()->where("slider_id = {$slider_name}")->orderBy('order')->all();
    ?>
        <div class="mt-main-slider">
            <!-- slider banner-slider start here -->
            <div class="slider banner-slider">
                <!-- holder start here -->
                <?php foreach($slides as $slide):?>
                    <div class="holder text-center" <?= $slide->link ? 'onclick="window.location=\''.$slide->link.'\';"' : '' ?> style="background-image: url(<?php echo Yii::$app->homeUrl;?>upload/<?php echo $slide->slide;?>); <?= $slide->link ? 'cursor:pointer' : '' ?>">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="text centerize" style="height:500px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
                <!-- holder end here -->

            </div>
            <!-- slider regular end here -->
        </div><!-- mt main slider end here -->
    <?php }
?>


