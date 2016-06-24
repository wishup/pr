<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UnsubscribeReasons */

$this->title = 'Update Unsubscribe Reasons: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Unsubscribe Reasons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="unsubscribe-reasons-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
