<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SeoParameters */

$this->title = 'Create Seo Parameters';
$this->params['breadcrumbs'][] = ['label' => 'Seo Parameters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

