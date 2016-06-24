<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SeoParameters */

$this->title = 'Update Seo Parameters';
$this->params['breadcrumbs'][] = ['label' => 'Seo Parameters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

