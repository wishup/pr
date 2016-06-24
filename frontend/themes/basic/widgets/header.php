<?php
use yii\bootstrap\Nav;
use common\models\MenuItems;
use common\models\Users;
use common\components\LiveEdit;

$menuItems = MenuItems::getNavHierarchy(1);
$params = yii::$app->params['settings'];
$image = "logo2.png";
?>

<header class="header clearfix">
    <div class="container-lg">
        <?php
        if (!$user_id = \common\models\Users::user_id()) {
            ?>
            <a href="/user/login" class="host-login"> <?= LiveEdit::text(__FILE__, 'Host login') ?> <i
                    class="icon-arrow-right"></i></a>
        <?php
        } else {

            $userInfo = \common\models\UserInfo::find()->where("user_id=" . $user_id)->one();
            ?>
            <!--<a href="/user/logout" class="host-login"><strong>Rami Ta</strong>--><? //= LiveEdit::text(__FILE__, 'Log Out') ?><!--</a>-->

            <div class="host-login dropdown">
                <button class="text-primary dropdown-toggle" type="button" id="dropdownMenu1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <?= $userInfo->first_name . ' ' . $userInfo->last_name; ?>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li>
                        <a href="<?php echo \yii\helpers\Url::toRoute('user/dashboard') ?>"><?= LiveEdit::text(__FILE__, 'Dashboard') ?></a>
                    </li>
                    <li>
                        <a href="<?php echo \yii\helpers\Url::toRoute('user/changepassword') ?>"><?= LiveEdit::text(__FILE__, 'Change password') ?></a>
                    </li>
                    <li>
                        <a href="<?php echo \yii\helpers\Url::toRoute('user/logout') ?>"><?= LiveEdit::text(__FILE__, 'Log Out') ?></a>
                    </li>
                </ul>
            </div>
        <?php
        }
        ?>
        <div class="container">
            <h1 class="logo"><a href="<?php echo Yii::$app->homeUrl; ?>"><img
                        src="<?php echo Yii::$app->homeUrl; ?>images/<?php echo $image; ?>" alt="" title=""></a>
            </h1>
            <button class="menu-btn" id="menuButton">
                <span class="burger-icon"></span>
            </button>
            <nav class="head-nav">
                <?= \yii\widgets\Menu::widget([
                    'options' => ['class' => 'head-menu nav'],
                    'items' => $menuItems,
                    'submenuTemplate' => "\n<ul class='subnav'>\n{items}\n</ul>\n",
                ]); ?>
            </nav>
        </div>
    </div>
</header>
