<?php
use yii\bootstrap\Nav;
use common\models\MenuItems;
use common\models\Users;
use common\components\LiveEdit;

$menuItems = MenuItems::getNavHierarchy(1);
$params = yii::$app->params['settings'];
$image = "logo2.png";
?>

<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "2b97b509-b680-467f-b808-afc20b78e57f", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

<!-- mt header style4 start here -->
<header id="mt-header" class="style4">
    <!-- mt bottom bar start here -->
    <div class="mt-bottom-bar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <!-- mt logo start here -->
                    <div class="mt-logo"><a href="<?php echo Yii::$app->homeUrl; ?>"><img src="<?php echo Yii::$app->homeUrl; ?>images/logo_hanse_lite.png" alt="Hanse Lite" style="height:40px; width:auto;"></a></div>
                    <!-- mt icon list start here -->

                    <ul class="mt-icon-list">
                        <li class="hidden-lg hidden-md">
                            <a href="#" class="bar-opener mobile-toggle">
                                <span class="bar"></span>
                                <span class="bar small"></span>
                                <span class="bar"></span>
                            </a>
                        </li>
                        <li>
                            <span class='st_facebook_large' displayText='Facebook'></span>
                            <span class='st_twitter_large' displayText='Tweet'></span>
                            <span class='st_linkedin_large' displayText='LinkedIn'></span>
                            <span class='st_googleplus_large' displayText='Google +'></span>
                        </li>
                    </ul><!-- mt icon list end here -->
                    <!-- navigation start here -->
                    <nav id="nav">
                        <?= \yii\widgets\Menu::widget([
                            'options' => ['class' => 'head-menu nav'],
                            'items' => $menuItems,

                            'submenuTemplate' => "\n<div class='s-drop'><ul>\n{items}\n</ul></div>\n",
                        ]); ?>
                    </nav>
                    <!-- mt icon list end here -->
                </div>
            </div>
        </div>
    </div>
    <!-- mt bottom bar end here -->
    <span class="mt-side-over"></span>
</header><!-- mt header style4 end here -->
