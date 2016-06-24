<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$this->params["main_content"] = $content;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php
    $params = yii::$app->params['settings'];
    if( isset($params['favicon'])): ?>
        <link rel="icon" href="<?php echo Yii::$app->homeUrl;?>upload/<?php echo $params['favicon'];?>" type="image/x-icon" />
    <?php endif;?>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic' rel='stylesheet' type='text/css'>
    <?php $this->head() ?>
    <link href='<?php echo Yii::$app->homeUrl;?>icon_fonts/style.css' rel='stylesheet' type='text/css'>
    <link href="<?php echo Yii::$app->homeUrl;?>js/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->homeUrl;?>css/md-slider.css" />
    <link href="<?php echo Yii::$app->homeUrl;?>css/main.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="layout1 <?= isset($this->params["bodyClass"]) ? $this->params["bodyClass"] : '' ?>">
<?= Yii::$app->params["settings"]["google_analytics"] ?>
<?php $this->beginBody() ?>
<?php
if( !isset($this->params['layout_settings']['settings']['section_top_active']) || $this->params['layout_settings']['settings']['section_top_active'] == 1 ){

    if( isset($this->params['layout_settings']['widgets']['top']) )

        foreach( $this->params['layout_settings']['widgets']['top'] as $wa_id )
            echo \common\components\Widgetareas::showSectionWidget($wa_id);

}
?>
<section class="main container-lg">
    <div class="row">
        <?php
        if( !isset($this->params['layout_settings']['settings']['section_left_active']) || $this->params['layout_settings']['settings']['section_left_active'] == 1 ){

            echo '<div class="col-sm-3">';

            if( isset($this->params['layout_settings']['widgets']['left']) )

                foreach( $this->params['layout_settings']['widgets']['left'] as $wa_id )
                    echo \common\components\Widgetareas::showSectionWidget($wa_id);

            echo '</div>';

        }

        $center_width = 12;

        if( !isset($this->params['layout_settings']['settings']['section_left_active']) || $this->params['layout_settings']['settings']['section_left_active'] == 1 ) $center_width-=4;
        if( !isset($this->params['layout_settings']['settings']['section_right_active']) || $this->params['layout_settings']['settings']['section_right_active'] == 1 ) $center_width-=4;

        ?>
        <div class="col-sm-<?= $center_width ?>">
            <?php
            // echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],])
            ?>
            <?= Alert::widget() ?>
            <?php
            if( !isset($this->params['layout_settings']['settings']['section_center_active']) || $this->params['layout_settings']['settings']['section_center_active'] == 1 ){

                if( isset($this->params['layout_settings']['widgets']['center']) )

                    foreach( $this->params['layout_settings']['widgets']['center'] as $wa_id )
                        echo \common\components\Widgetareas::showSectionWidget($wa_id);

            }
            ?>

        </div>
        <?php
        if( !isset($this->params['layout_settings']['settings']['section_right_active']) || $this->params['layout_settings']['settings']['section_right_active'] == 1 ){

            echo '<aside class="sidebar col-sm-4">';

            if( isset($this->params['layout_settings']['widgets']['right']) )

                foreach( $this->params['layout_settings']['widgets']['right'] as $wa_id )
                    echo \common\components\Widgetareas::showSectionWidget($wa_id);

            echo '</aside>';

        }
        ?>
    </div>
</section>
<?php
if( !isset($this->params['layout_settings']['settings']['section_bottom_active']) || $this->params['layout_settings']['settings']['section_bottom_active'] == 1 ){

    if( isset($this->params['layout_settings']['widgets']['bottom']) )

        foreach( $this->params['layout_settings']['widgets']['bottom'] as $wa_id )
            echo \common\components\Widgetareas::showSectionWidget($wa_id);

}
?>

<?php if( common\components\LiveEdit::admin() ) $this->registerJsFile("/backend/js/tinymce_plugin.js", ["depends"=>"\\dosamigos\\tinymce\\TinyMceAsset"]); ?>

<?php $this->endBody() ?>
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?php echo Yii::$app->homeUrl;?>js/magnific-popup/jquery.magnific-popup.js"></script>
<script src="<?php echo Yii::$app->homeUrl;?>js/modernizer/modernizr.js"></script>
<script src="<?php echo Yii::$app->homeUrl;?>js/jquery.easing.js"></script>
<script src="<?php echo Yii::$app->homeUrl;?>js/jquery.touchswipe.js"></script>
<script src="<?php echo Yii::$app->homeUrl;?>js/md-slider.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->homeUrl;?>js/inputmask.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->homeUrl;?>js/script.js?token=<?= md5( filemtime(Yii::getAlias('@webroot').'/js/script.js') ) ?>"></script>
<script type="text/javascript" src="<?php echo Yii::$app->homeUrl;?>js/widgets.js"></script>
<?= $this->render("//elements/adminpanel") ?>
</body>
</html>
<?php $this->endPage() ?>
