<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DiscountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Discounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discount-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="action_buttons">
        <?= Html::a('Create Discount', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= Html::beginForm('./','get', ['class'=>'gridform']) ?>
    <?= $grid_view ?>
    <?= Html::endForm() ?>
</div>
