<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;


AppAsset::register($this);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jquery-notific8/jquery.notific8.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/cubeportfolio/css/cubeportfolio.css" rel="stylesheet" type="text/css" />

    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?= Yii::$app->homeUrl; ?>assets/pages/css/profile-2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/pages/css/portfolio.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="<?= Yii::$app->homeUrl; ?>../css/map.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/layouts/layout4/css/themes/light.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link href="<?= Yii::$app->homeUrl; ?>css/site.css" rel="stylesheet" type="text/css" />
    <link href="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" type="text/css" />

    <link rel="shortcut icon" href="<?= Yii::$app->homeUrl; ?>favicon.ico" />
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
<?php $this->beginBody() ?>

<!-- BEGIN CONTAINER -->
<div class="page-container" style="margin-top:0px;">
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <?= Alert::widget() ?>

            <?= $content ?>
        </div>
        <style>
            .page-content{
                margin-left:0px!important;
            }
        </style>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<?php \yii\bootstrap\BootstrapPluginAsset::register($this);?>
<?php $this->endBody() ?>

<!--[if lt IE 9]>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/respond.min.js"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jquery-notific8/jquery.notific8.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/gmaps/gmaps.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js" type="text/javascript"></script>


<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?= Yii::$app->homeUrl; ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?= Yii::$app->homeUrl; ?>assets/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/pages/scripts/table-datatables-buttons.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>../js/map.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/pages/scripts/ui-notific8.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/pages/scripts/portfolio-1.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?= Yii::$app->homeUrl; ?>assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<script src="<?= Yii::$app->homeUrl; ?>js/main.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/global/plugins/jstree/dist/jstree.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/pages/scripts/ui-tree.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->homeUrl; ?>assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>

</body>
</html>
<?php $this->endPage() ?>
