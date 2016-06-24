<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administrators';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p class="action_buttons">
        <?= Html::a('Create Administrator', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= Html::beginForm('./','get', ['class'=>'gridform']) ?>

    <?= $grid_view ?>


    <?= Html::endForm() ?>

</div>
