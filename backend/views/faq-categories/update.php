<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FaqCategories */

$this->title = 'Update Faq Categories: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Faq Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="faq-categories-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
