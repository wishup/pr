<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EmailGroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Email Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-groups-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="action_buttons">
        <?= Html::a('Create Email Groups', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <?=  Html::beginForm('./','get', ['class'=>'gridform']) ?>
    <?= $grid_view ?>
    <?=  Html::endForm() ?>
</div>
