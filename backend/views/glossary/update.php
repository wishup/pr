<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Glossary */

$this->title = 'Update Glossary: ' . ' ' . $model->word;
$this->params['breadcrumbs'][] = ['label' => 'Glossaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->word, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

