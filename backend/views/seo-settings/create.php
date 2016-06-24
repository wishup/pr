<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SeoSettings */

$this->title = 'Create Rewrite Rule';
$this->params['breadcrumbs'][] = ['label' => 'Rewrite Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

