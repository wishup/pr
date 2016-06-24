<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ResourcesCategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Resources Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resources-categories-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="action_buttons">
        <?= Html::a('Create Resources Categories', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <?=  Html::beginForm('./','get', ['class'=>'gridform']) ?>
    <?= $grid_view ?>
    <?=  Html::endForm() ?>
</div>
