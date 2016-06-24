<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Unsubscribe */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Unsubscribes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unsubscribe-view">


    <div class="action_buttons">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'email:email',
            'group_id',
        ],
    ]) ?>

</div>
