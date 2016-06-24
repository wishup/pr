<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Unsubscribe */

$this->title = 'Update Unsubscribe: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Unsubscribes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="unsubscribe-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
