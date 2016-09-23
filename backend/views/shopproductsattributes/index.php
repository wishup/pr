<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ShopProductsAttributesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shop Products Attributes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-products-attributes-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="action_buttons">
        <?= Html::a('Create Shop Products Attributes', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <?=  Html::beginForm('./','get', ['class'=>'gridform']) ?>
    <?= $grid_view ?>
    <?=  Html::endForm() ?>
</div>
