<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Faq Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-categories-index">

    <p class="action_buttons">
        <?= Html::a('Create Faq Categories', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= Html::beginForm('./','get', ['class'=>'gridform']) ?>
    <?= $grid_view ?>
    <?= Html::endForm() ?>

</div>
