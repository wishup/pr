<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UnsubscribeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Unsubscribes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unsubscribe-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="action_buttons">
        <?= Html::a('Create Unsubscribe', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <?=  Html::beginForm('./','get', ['class'=>'gridform']) ?>
    <?= $grid_view ?>
    <?=  Html::endForm() ?>
</div>
