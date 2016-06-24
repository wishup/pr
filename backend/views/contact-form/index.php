<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ContactFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contact Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-form-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=  Html::beginForm('./','get', ['class'=>'gridform']) ?>
    <?= $grid_view ?>
    <?=  Html::endForm() ?>
</div>
