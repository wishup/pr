<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ShopCategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shop Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-categories-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="action_buttons">
        <?= Html::a('Create Shop Categories', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <?=  Html::beginForm('./','get', ['class'=>'gridform']) ?>
    <?= $grid_view ?>
    <?=  Html::endForm() ?>
</div>
