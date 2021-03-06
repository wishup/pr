<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\GalleryItem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Gallery Items', 'url' => ['index', 'id' => $model->gallery_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-item-view">


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
            'name',
            'description:ntext',
            'image' => [
                "label" => "Image",
                "value" => $model->image ? '<img src="'.\common\components\attachments::getThumbnailUrl( '/upload/'.$model->image, 150, 150, 'AUTO' ).'" class="thumbimg">' : '',
                "format" => "html"
            ],
        ],
    ]) ?>

</div>
