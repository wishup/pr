<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\sliders */

$this->title = 'Update Sliders: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sliders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sliders-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
