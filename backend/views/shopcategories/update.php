<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ShopCategories */

$this->title = 'Update Shop Categories: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Shop Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="shop-categories-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
