<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Emails';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emails-index">

    <p>
        <?= Html::a('Create & Send Email', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= Html::beginForm('','get', ['class'=>'gridform']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'from_name',
            'from_email:email',
            //'to_name',
            'to_email:email',
             'subject',
            // 'content:ntext',
            // 'attachments:ntext',
            // 'hash',
            'priority'=>[
                "label" => "Priority",
                "value" => function($model){

                    $prior = [
                        '' => '',
                        1 => 'Low',
                        10 => 'Normal',
                        20 => 'High',
                        30 => 'Very high',
                        100 => 'Send now'
                    ];

                    return $prior[ $model->priority ];
                },
                'filter' => [
                    1 => 'Low',
                    10 => 'Normal',
                    20 => 'High',
                    30 => 'Very high',
                    100 => 'Send now'
                ],
                'attribute' => 'priority'
            ],
            'status'=>[
                "label" => "Status",
                "value" => function($model){

                    $prior = [
                        'outbox' => 'Outbox',
                        'sent' => 'Sent',
                    ];

                    return $prior[ $model->status ];
                },
                'filter' => [
                    'outbox' => 'Outbox',
                    'sent' => 'Sent',
                ],
                'attribute' => 'status'
            ],
            // 'send_date',
             'created_at',
             'sent_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions' =>['class' => 'table table-striped table-bordered table-white-bg'],
    ]); ?>
    <?= Html::endForm() ?>
</div>
