<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ShopProductsAttributes */

$this->title = 'Create Shop Products Attributes';
$this->params['breadcrumbs'][] = ['label' => 'Shop Products Attributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-products-attributes-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
