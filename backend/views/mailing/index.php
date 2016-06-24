<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Communication centre emails';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mailing-index">

    <p class="action_buttons">
        <?= Html::a('Create Email', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Email templates', ['mailingtemplates/index'], ['class' => 'btn btn-info', 'style' => 'margin-left:20px']) ?>
    </p>
    <?= Html::beginForm('./','get', ['class'=>'gridform']) ?>
    <?= $grid_view ?>
    <?= Html::endForm() ?>
</div>
