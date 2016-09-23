<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ShopProductsAttributes */

$this->title = 'Update Shop Products Attributes: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Shop Products Attributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="shop-products-attributes-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
