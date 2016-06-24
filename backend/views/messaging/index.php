<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MessagingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Communication centre messages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messaging-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="action_buttons">
        <?= Html::a('Create Message', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= Html::beginForm('./','get', ['class'=>'gridform']) ?>
    <?= $grid_view ?>
    <?= Html::endForm() ?>

</div>
