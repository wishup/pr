<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Glossary */

$this->title = $model->word;
$this->params['breadcrumbs'][] = ['label' => 'Glossary', 'url' => ['index']];
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
            'status',
            'word',
            'acronim',
            'description:ntext',
        ],
        'options' =>['class' => 'table table-striped table-bordered detail-view table-white-bg'],
    ]) ?>
