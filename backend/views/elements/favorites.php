<?php
$fav = 0;
if( $favorite_model = \backend\models\FavoriteUrls::find()->where("user_id=".Yii::$app->user->identity->id." and url='".$_SERVER["REQUEST_URI"]."'")->one() ){
    $fav = 1;
}
?>

<div class="theme-panel hidden-xs hidden-sm">
    <div class="toggler add_to_favorites_btn fa fa-star"> </div>
    <div class="toggler-close"> </div>
    <div class="theme-options">
        <div class="theme-option theme-colors clearfix">
            <span> FAVORITES </span>
        </div>
        <div class="theme-option">
            <?php
            if( $fav == 0 ) {
                ?>
                <span style="width:250px"><input type="text" name="" value="" class="form-control input-sm favorite_title"></span>
                <input type="button" value="Add" class="btn btn-success btn-sm add_favorite">
            <?php
            } else {
                ?>
                <input type="button" value="Remove from favorites" class="btn btn-success btn-sm remove_favorite">
                <?php
            }
            ?>
        </div>

    </div>
</div>