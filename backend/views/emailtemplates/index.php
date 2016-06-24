<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Email templates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emailtemplates-index">
    <p class="action_buttons">
        <?= Html::a('Create Emailtemplate', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?= Html::beginForm('./','get', ['class'=>'gridform']) ?>
    <?= $grid_view ?>
    <?= Html::endForm() ?>
</div>
