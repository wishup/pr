<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Email Templates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mailing-templates-index">

    <p>
        <?= Html::a('Create Email Template', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Communication centre', ['mailing/index'], ['class' => 'btn btn-info', 'style' => 'margin-left:20px']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            //'message:html',

            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [

                    //view button
                    'view' => function ($url, $model) {
                        return '';
                    },
                ],
            ],
        ],
    ]); ?>

</div>
