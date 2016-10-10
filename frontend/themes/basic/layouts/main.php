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
    <!-- include the site stylesheet -->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic%7cMontserrat:400,700%7cOxygen:400,300,700' rel='stylesheet' type='text/css'>
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="/css/bootstrap.css">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="/css/animate.css">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="/css/icon-fonts.css">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="/css/main.css">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="/css/responsive.css">

</head>
<body class="<?= ( !isset($this->params["bodyClassDefault"]) || (isset($this->params["bodyClassDefault"]) && $this->params["bodyClassDefault"]) ) ? 'layout1' : '' ?> <?= isset($this->params["bodyClass"]) ? $this->params["bodyClass"] : '' ?>">
<?= Yii::$app->params["settings"]["google_analytics"] ?>
<?php $this->beginBody() ?>

<!-- main container of all the page elements -->
<div id="wrapper">
    <!-- Page Loader -->
    <div id="pre-loader" class="loader-container">
        <div class="loader">
            <img src="/images/svg/rings.svg" alt="loader">
        </div>
    </div>
    <!-- W1 start here -->
    <div class="w1">
        <?php
        if( !isset($this->params['layout_settings']['settings']['section_top_active']) || $this->params['layout_settings']['settings']['section_top_active'] == 1 ){

            if( isset($this->params['layout_settings']['widgets']['top']) )

                foreach( $this->params['layout_settings']['widgets']['top'] as $wa_id )
                    echo \common\components\Widgetareas::showSectionWidget($wa_id);

        }
        ?>
        <!-- mt side menu start here -->
        <div class="mt-side-menu">
            <!-- mt holder start here -->
            <div class="mt-holder">
                <a href="#" class="side-close"><span></span><span></span></a>
                <strong class="mt-side-title">MY ACCOUNT</strong>
                <!-- mt side widget start here -->
                <div class="mt-side-widget">
                    <header>
                        <span class="mt-side-subtitle">SIGN IN</span>
                        <p>Welcome back! Sign in to Your Account</p>
                    </header>
                    <form action="#">
                        <fieldset>
                            <input type="text" placeholder="Username or email address" class="input">
                            <input type="password" placeholder="Password" class="input">
                            <div class="box">
                                <span class="left"><input class="checkbox" type="checkbox" id="check1"><label for="check1">Remember Me</label></span>
                                <a href="#" class="help">Help?</a>
                            </div>
                            <button type="submit" class="btn-type1">Login</button>
                        </fieldset>
                    </form>
                </div>
                <!-- mt side widget end here -->
                <div class="or-divider"><span class="txt">or</span></div>
                <!-- mt side widget start here -->
                <div class="mt-side-widget">
                    <header>
                        <span class="mt-side-subtitle">CREATE NEW ACCOUNT</span>
                        <p>Create your very own account</p>
                    </header>
                    <form action="#">
                        <fieldset>
                            <input type="text" placeholder="Username or email address" class="input">
                            <button type="submit" class="btn-type1">Register</button>
                        </fieldset>
                    </form>
                </div>
                <!-- mt side widget end here -->
            </div>
            <!-- mt holder end here -->
        </div><!-- mt side menu end here -->
        <!-- mt search popup start here -->
        <div class="mt-search-popup">
            <div class="mt-holder">
                <a href="#" class="search-close"><span></span><span></span></a>
                <div class="mt-frame">
                    <form action="#">
                        <fieldset>
                            <input type="text" placeholder="Search...">
                            <span class="icon-microphone"></span>
                            <button class="icon-magnifier" type="submit"></button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div><!-- mt search popup end here -->
        <main id="mt-main">
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
        </main>
        <?php
        if( !isset($this->params['layout_settings']['settings']['section_bottom_active']) || $this->params['layout_settings']['settings']['section_bottom_active'] == 1 ){

            if( isset($this->params['layout_settings']['widgets']['bottom']) )

                foreach( $this->params['layout_settings']['widgets']['bottom'] as $wa_id )
                    echo \common\components\Widgetareas::showSectionWidget($wa_id);

        }
        ?>
    </div><!-- W1 end here -->
    <span id="back-top" class="fa fa-arrow-up"></span>
</div>


<?php if( common\components\LiveEdit::admin() ) $this->registerJsFile("/backend/js/tinymce_plugin.js", ["depends"=>"\\dosamigos\\tinymce\\TinyMceAsset"]); ?>

<?php $this->endBody() ?>
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- include jQuery -->
<script src="/js/plugins.js"></script>
<!-- include jQuery -->
<script src="/js/jquery.main.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->homeUrl;?>js/widgets.js"></script>
<?= $this->render("//elements/adminpanel") ?>
</body>
</html>
<?php $this->endPage() ?>
