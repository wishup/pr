<?php
use yii\bootstrap\Nav;
use common\models\MenuItems;

$menuItems = MenuItems::getNavHierarchy( 2 );
$params = yii::$app->params['settings'];
?>
<footer class="footer">
    <div class="container-lg">
        <div class="row">
            <div class="copyright col-md-5">
                C) <?php echo date('Y '); if(isset($params['footer_copyrights'])): echo $params['footer_copyrights']; endif;?>
            </div>
            <?php
            echo Nav::widget([
                'options' => ['class' => 'nav col-md-7'],
                'items' => $menuItems,
            ]);
            ?>
        </div>
    </div>
</footer>