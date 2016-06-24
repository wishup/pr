<?php
if( $group->unsubscribe == 1 ){
    ?>
    <p>
        If you don't want to receive notifications like this anymore, please <a href="<?= Yii::$app->params["domainUrl"] ?>site/unsubscribe?email=<?= $to_email ?>&group_id=<?= $group->id ?>&token=<?= md5(Yii::$app->params["unsubscribe_secret_key"].$to_email.$group->id) ?>">Unsubscribe</a>
    </p>
    <?php
}
?>