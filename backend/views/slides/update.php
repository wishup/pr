<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Slides */

$this->title = 'Update Slides: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Slides', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="slides-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
