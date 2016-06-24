<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SeoSettings */

$this->title = 'Update Rewrite Rule: ' . ' ' . $model->default_url;
$this->params['breadcrumbs'][] = ['label' => 'Rewrite Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->default_url, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

