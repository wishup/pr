<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Glossary */

$this->title = 'Create Glossary Item';
$this->params['breadcrumbs'][] = ['label' => 'Glossary', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

