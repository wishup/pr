<?php
use yii\bootstrap\Nav;
use common\models\MenuItems;

$menuItems = MenuItems::getNavHierarchy( 2 );
$params = yii::$app->params['settings'];
?>

<!-- footer of the Page -->
<footer id="mt-footer" class="style1 wow fadeInUp" data-wow-delay="0.4s">
    <!-- Footer Holder of the Page -->
    <div class="footer-holder dark">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm">
                    <!-- F Widget About of the Page -->
                    <div class="f-widget-about">
                        <div class="logo">
                            <a href="#"><img src="/images/logo.png" alt="Schon"></a>
                        </div>
                        <p>
                            <?= \common\components\LiveEdit::text(__FILE__, 'Exercitation ullamco laboris nisi ut aliquip ex commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.') ?>
                        </p>
                        <!-- Social Network of the Page -->
                        <ul class="list-unstyled social-network">
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
                        </ul>
                        <!-- Social Network of the Page end -->
                    </div>
                    <!-- F Widget About of the Page end -->
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm">
                    <div class="f-widget-news">
                        <h3 class="f-widget-heading">Twitter</h3>
                        <div class="news-articles">
                            <div class="news-column">
                                <i class="fa fa-twitter"></i>
                                <div class="txt-box">
                                    <p>Laboris nisi ut <a href="#">#schön</a> aliquip econse- <br>quat. <a href="#">https://t.co/vreNJ9nEDt</a></p>
                                </div>
                            </div>
                            <div class="news-column">
                                <i class="fa fa-twitter"></i>
                                <div class="txt-box">
                                    <p>Ficia deserunt mollit anim id est labo- <br>rum. incididunt ut labore et dolore <br><a href="#">https://t.co/vreNJ9nEDt</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomxs">
                    <!-- Footer Tabs of the Page -->
                    <div class="f-widget-tabs">
                        <h3 class="f-widget-heading"><?= \common\components\LiveEdit::text(__FILE__, 'Informatives') ?></h3>
                        <?php
                        echo Nav::widget([
                            'options' => ['class' => 'list-unstyled'],
                            'items' => $menuItems,
                        ]);
                        ?>
                    </div>
                    <!-- Footer Tabs of the Page -->
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 text-right">
                    <!-- F Widget About of the Page -->
                    <div class="f-widget-about">
                        <h3 class="f-widget-heading"><?= \common\components\LiveEdit::text(__FILE__, 'Contacts') ?></h3>
                        <ul class="list-unstyled address-list align-right">
                            <li><i class="fa fa-map-marker"></i><address><?= \common\components\LiveEdit::text(__FILE__, 'Connaugt Road Central Suite 18B, 148<br>New Yankee') ?></address></li>
                            <li><i class="fa fa-phone"></i><?= \common\components\LiveEdit::text(__FILE__, '+1 (555) 333 22 11') ?></li>
                            <li><i class="fa fa-envelope-o"></i><a href="mailto:">info@hanse-lite.de</a></li>
                        </ul>
                    </div>
                    <!-- F Widget About of the Page end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Holder of the Page end -->
    <!-- Footer Area of the Page -->
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 text-center">
                    <p>© <a href="/">Hanse Lite</a> <?= \common\components\LiveEdit::text(__FILE__, '- All rights Reserved') ?></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Area of the Page end -->
</footer><!-- footer of the Page end -->