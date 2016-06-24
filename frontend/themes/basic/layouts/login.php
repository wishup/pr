<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\components\LiveEdit;


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
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <?php $this->head() ?>
    <link href='<?php echo Yii::$app->homeUrl;?>icon_fonts/style.css' rel='stylesheet' type='text/css'>
    <link href="<?php echo Yii::$app->homeUrl;?>js/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::$app->homeUrl;?>css/main.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="<?= isset($this->params["bodyClass"]) ? $this->params["bodyClass"] : '' ?>">
<?= Yii::$app->params["settings"]["google_analytics"] ?>
<?php $this->beginBody() ?>

<!-- get started form -->
<div id="getStartedPopup" class="get-started-popup-wrap mfp-hide">
    <div class="get-started-popup popup-block popup-has-close main-box text-center popup-step3 getstarted-popup">
        <h2 class="heading-md color-featured"><?php echo LiveEdit::text(__FILE__, 'Account information was successfully sent')?></h2>
        <hr class="line-sm">
        <h3 class="heading-xs color-primary2 text-uppercase text-uppercase"><?php echo LiveEdit::text(__FILE__, 'Please Verify Your Email Account')?></h3>
        <hr class="line-xs">
        <p class="color-primary2"><?php echo LiveEdit::text(__FILE__, 'You will receive an email to the address you provided. Please click on the link provided in that email to continue.')?></p>
    </div>
</div>

    <div id="restorePopup" class=" popup-block main-box text-center popup-step3 getstarted-popup popup-has-close mfp-hide">
        <h2 class="title -md text-featured"><?php echo LiveEdit::text(__FILE__, 'New password was sent')?></h2>
        <h3 class="heading-xs color-primary2 text-uppercase"><?php echo LiveEdit::text(__FILE__, 'Check your email address')?></h3>
        <p class="text-primary2"><?php echo LiveEdit::text(__FILE__, 'You will receive an email to the address you provided. Please click on the link provided in that email to continue.')?></p>
    </div>
<!--end get started form -->
<header class="header container clearfix">
    <h1 class="logo"><a href="<?php echo Yii::$app->homeUrl;?>"><img src="/images/logo2.png" alt="" title=""></a></h1>
</header>
<?= $content ?>

<?php if( common\components\LiveEdit::admin() ) $this->registerJsFile("/backend/js/tinymce_plugin.js", ["depends"=>"\\dosamigos\\tinymce\\TinyMceAsset"]); ?>

<?php $this->endBody() ?>
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="<?php echo Yii::$app->homeUrl;?>js/magnific-popup/jquery.magnific-popup.js"></script>
<script src="<?php echo Yii::$app->homeUrl;?>js/modernizer/modernizr.js"></script>
<script src="<?php echo Yii::$app->homeUrl;?>js/jquery.customSelect.min.js"></script>
<script src="<?php echo Yii::$app->homeUrl;?>js/validation.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->homeUrl;?>js/inputmask.js"></script>
<script type="text/javascript" src="<?php echo Yii::$app->homeUrl;?>js/script.js?token=<?= md5( filemtime(Yii::getAlias('@webroot').'/js/script.js') ) ?>"></script>
<script type="text/javascript" src="<?php echo Yii::$app->homeUrl;?>js/widgets.js"></script>
<?= $this->render("//elements/adminpanel") ?>
</body>
</html>
<?php $this->endPage() ?>
