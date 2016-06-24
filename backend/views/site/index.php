<?php

/* @var $this yii\web\View */

$this->title = 'Dashboard';
?>
<div class="row">
    <div class="col-md-4">
        <div class="portlet light bg-inverse white-bg">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-star font-red-flamingo"></i>
                    <span class="caption-subject bold font-red-flamingo uppercase"> Favorites </span>
                    <span class="caption-helper"></span>
                </div>
                <div class="tools">
                    <a href="" class="collapse"> </a>
                </div>
            </div>
            <div class="portlet-body">
                <?php
                if( $favorites = \backend\models\FavoriteUrls::find()->where("user_id=".Yii::$app->user->identity->id)->orderBy("id desc")->limit(10)->all() ){

                    foreach( $favorites as $favorite ){

                        ?>
                        <p class="favorite_row">
                            <a href="<?= $favorite->url ?>"><?= $favorite->title ?></a> <span class="favorite_url_small"><?= $favorite->url ?></span>
                            <a href="#" class="btn btn-warning btn-xs remove_favorite_btn" data-url="<?= $favorite->url ?>">Delete</a>
                        </p>
                    <?php

                    }

                }
                ?>
            </div>

        </div>
    </div>
    <div class="col-md-4">
        <div class="portlet light bg-inverse white-bg">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-red-flamingo"></i>
                    <span class="caption-subject bold font-red-flamingo uppercase"> Recent </span>
                    <span class="caption-helper"></span>
                </div>
                <div class="tools">
                    <a href="" class="collapse"> </a>
                </div>
            </div>
            <div class="portlet-body">
                <?php
                if( $favorites = \backend\models\RecentUrls::find()->where("user_id=".Yii::$app->user->identity->id)->orderBy("id desc")->limit(10)->all() ){

                    foreach( $favorites as $favorite ){

                        ?>
                        <p class="favorite_row">
                            <a href="<?= $favorite->url ?>"><?= $favorite->title ?></a> <span class="favorite_url_small"><?= $favorite->url ?></span>
                        </p>
                    <?php

                    }

                }
                ?>
            </div>
        </div>
    </div>
</div>