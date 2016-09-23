<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ShopCategories */

$this->title = 'Create Shop Categories';
$this->params['breadcrumbs'][] = ['label' => 'Shop Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-categories-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
