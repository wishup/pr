<?php
use common\components\LiveEdit;
?>
<section class="main gen-box container-lg">
    <div class="account-primary">
    <?= $this->render("//elements/dashboard_head", [
        "infomodel" => $infomodel,
        "hostmodel" => $hostmodel,
        "usermodel" => $usermodel,
        "bgcheckmodel" => $bgcheckmodel,
        "family" => $family
    ]) ?>

        <div class="dash-resources">

            <?php
            $i=0;
            foreach( $children as $child ){

                ?>
                <div class="panel-box mg-btm-15">
                    <?php
                    if( $i == 0 ){
                        ?>
                        <div class="panel-head">
                            <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Participants - Family') ?></h3>
                        </div><!-- .panel-head -->
                        <?php
                    }
                    ?>

                    <div class="panel-cont">
                        <h4><strong><?= $child->first_name.' '.$child->last_name ?></strong> <small>/<?= $child->age_group ?> <?= Yii::$app->params["versions"][ $child->version ] ?></small></h4>
                        <div class="dash-resource-list">
                            <div class="row">
                                <?php
                                if( $resources = \common\models\Resources::find()->where("( version=".$child->version." OR version IS NULL or version='' ) and ( age_group='".$child->age_group."' OR age_group IS NULL or age_group='' )")->all() ){

                                    foreach( $resources as $resource ){

                                        ?>
                                        <div class="col-sm-2">
                                            <h5 class="color-info"><strong><?= $resource->category->title ?></strong> <small><?= $resource->category->subtitle ? $resource->category->subtitle : '&nbsp;' ?></small></h5>
                                            <div class="item">
                                                <div class="item-media">
                                                    <?php
                                                    if( $resource->thumbnail ){
                                                        ?><img src="<?= \common\components\attachments::getThumbnailUrl( '/upload/resources/'.$resource->thumbnail, 168, 104, 'CROP' ) ?>" alt=""/><?php
                                                    } else {
                                                        if( $resource->category->image ){
                                                            ?><img src="<?= \common\components\attachments::getThumbnailUrl( '/upload/resources/'.$resource->category->image, 168, 104, 'CROP' ) ?>" alt=""/><?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php if( $resource->overlay_text ){ ?><span class="item-date"><?= $resource->overlay_text ?></span><?php } ?>
                                                </div>
                                                <?php
                                                if( $resource->button_type == 'link' ){

                                                    if( $resource->url ) {
                                                        ?>
                                                        <div class="item-bar bg-success" style="background-color: <?= isset(Yii::$app->params["resource_button_colors"][ $child->age_group ]) ? Yii::$app->params["resource_button_colors"][ $child->age_group ] : '' ?>">
                                                            <a href="<?= $resource->url ?>" class="resources_discount_popup"><strong>Discount</strong></a>
                                                        </div>
                                                    <?php
                                                    }

                                                } else {

                                                    if( $resource->file ) {
                                                        ?>
                                                        <div class="item-bar bg-success" style="background-color: <?= isset(Yii::$app->params["resource_button_colors"][ $child->age_group ]) ? Yii::$app->params["resource_button_colors"][ $child->age_group ] : '' ?>">
                                                            <a href="/upload/resources/<?= $resource->file ?>"
                                                               target="_blank"><i class="icon icon-download"></i><strong>Download</strong>
                                                                <small>
                                                                    (<?= round((filesize(\Yii::getAlias('@webroot') . '/upload/resources/' . $resource->file) / 1024 / 1024), 1) ?>
                                                                    MB)
                                                                </small>
                                                            </a>
                                                        </div>
                                                    <?php
                                                    }

                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <?php

                                    }

                                } else {
                                    ?>
                                    <div class="col-sm-12">
                                        <p>&nbsp;</p>
                                        <p>No resource yet</p>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div><!-- .panel-cont -->
                </div><!-- .panel-box -->
                <?php

                $i++;

            }

            ?>

        </div><!-- .dash-resources -->

    </div>
    </section>


<div id="discountPopup" class="mfp-hide popup-block popup-has-close text-center">
    <!--a class="popup-alert">Alert</a-->
    <h2 class="heading-xs color-primary2 text-uppercase"><?php echo LiveEdit::text(__FILE__, 'Please use the following code to receive a discount at Amazon checkout.')?></h2>
    <h3 class="heading-lg color-featured"><?php echo LiveEdit::text(__FILE__, 'N5DEOQ5X')?></h3>
    <p class="color-primary2"><?php echo LiveEdit::text(__FILE__, 'If you continue, you will be leaving <a class="link" href="https://biblebee.org">BibleBee.org</a>. Before making any purchases, please review your order and make sure you are purchasing the correct materials for your respective age division. If you have questions, please contact customer service before purchasing.')?></p>
    <div class="row">
        <div class="col-sm-6">
            <a href="#" class="btn btn-brd-success btn-block resources_dp_close">Stay at BibleBee.org</a>
        </div>
        <div class="col-sm-6">
            <a href="#" class="btn btn-success btn-block resources_amazon_link" target="_blank">Continue to Amazon</a>
        </div>
    </div>
</div>