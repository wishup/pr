<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Help */

$this->title = "Help";
?>
<div class="help-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
