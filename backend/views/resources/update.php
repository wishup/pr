<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Resources */

$this->title = 'Update Resources: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Resources', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="resources-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
