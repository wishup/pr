<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Administrators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

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
            'username',
            'email:email',
            'status',
            [
                "attribute" => "first_name",
                "value" => $infomodel->first_name
            ],
            [
                "attribute" => "last_name",
                "value" => $infomodel->last_name
            ],
            [
                "attribute" => "created_at",
                "value" => date('Y-m-d H:i:s', $model->created_at)
            ],
            [
                "attribute" => "updated_at",
                "value" => date('Y-m-d H:i:s', $model->created_at)
            ],
            [
                "attribute" => "last_login",
                "value" => $infomodel->last_login
            ],
        ],
    ]) ?>

</div>
