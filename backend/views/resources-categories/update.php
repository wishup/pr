<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ResourcesCategories */

$this->title = 'Update Resources Categories: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Resources Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="resources-categories-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
