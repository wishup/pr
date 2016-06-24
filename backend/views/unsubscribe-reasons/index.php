<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UnsubscribeReasonsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Unsubscribe Reasons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unsubscribe-reasons-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="action_buttons">
        <?= Html::a('Create Unsubscribe Reasons', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <?=  Html::beginForm('./','get', ['class'=>'gridform']) ?>
    <?= $grid_view ?>
    <?=  Html::endForm() ?>
</div>
