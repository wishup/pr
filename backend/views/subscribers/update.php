<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Subscribers */

$this->title = 'Update Subscribers: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Subscribers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subscribers-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
