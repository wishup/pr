<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SeoParameters */

$this->title = 'Seo Parameters';
$this->params['breadcrumbs'][] = ['label' => 'Seo Parameters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'url:url',
            'title',
            'meta_description:ntext',
            'meta_keywords:ntext',
        ],
        'options' =>['class' => 'table table-striped table-bordered detail-view table-white-bg'],
    ]) ?>

