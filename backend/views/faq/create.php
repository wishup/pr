<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Faq */

$this->title = 'Create FAQ';
$this->params['breadcrumbs'][] = ['label' => 'FAQ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

