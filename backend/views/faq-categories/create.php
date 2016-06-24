<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FaqCategories */

$this->title = 'Create Faq Categories';
$this->params['breadcrumbs'][] = ['label' => 'Faq Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-categories-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
