<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Layouts';
$this->params['breadcrumbs'][] = $this->title;
?>

    <p>
        <?= Html::a('Create Layout', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?= Html::beginForm('','get', ['class'=>'gridform']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'url'=>[
                "label" => "URL".Date('F', strtotime(date('F') . " last month")),
                "value" => function($model){

                    return $model->getName();
                },
                'filter' => true,
                'attribute' => 'url',
                'format' => 'html',

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'rowOptions'=>function ($model, $key, $index, $column){
            return ['data-parent-id'=>$model->parent_id];
        },
        'tableOptions' =>['class' => 'table table-striped table-bordered treeview table-white-bg'],
    ]); ?>
<?= Html::endForm() ?>
