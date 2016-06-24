<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\sliders */
//$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sliders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sliders-view">

    <p>
        <?= Html::a('Create Slide', ['slides/create', 'id' => $id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' =>['class' => 'table table-striped table-bordered table-white-bg', 'id' => 'reorder'],
        'columns' => $grid_fields
    ]); ?>


</div>
