<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ShopProducts */

$this->title = 'Update Shop Products: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Shop Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="shop-products-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
