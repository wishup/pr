<?php
use \common\components\Email;
use \common\models\Mailing;

?>
<?= Email::renderFromText($model->message, \Yii::$app->params["mailing_email_layout_id"], Mailing::emailParams($user, $model)) ?>
