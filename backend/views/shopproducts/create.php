<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ShopProducts */

$this->title = 'Create Shop Products';
$this->params['breadcrumbs'][] = ['label' => 'Shop Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-products-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
