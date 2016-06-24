<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\LiveEditTextsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Live Edit Texts';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Html::beginForm('./', 'get', ['class' => 'gridform']) ?>
<?= $grid_view ?>
<?= Html::endForm() ?>

