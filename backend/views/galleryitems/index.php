<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GalleryItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gallery Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-item-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="action_buttons">
        <?= Html::a('Create Gallery Item', ['create', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-success']) ?>
    </div>
    <?=  Html::beginForm('./','get', ['class'=>'gridform']) ?>
    <?= $grid_view ?>
    <?=  Html::endForm() ?>
</div>
