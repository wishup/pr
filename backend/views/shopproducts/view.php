<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ShopProducts */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Shop Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-products-view">


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
    <?php
    $categories = $model->categories;

    $cats = [];

    foreach( $categories as $cat ){

        $cats[] = $cat->name;

    }

    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'categories' => [
                "label" => "Categories",
                "value" => implode(", ", $cats)
            ],
            'name',
            'description:html',
            'price',
            'image' => [
                "label" => "Image",
                "value" => $model->image ? '<img src="'.\common\components\attachments::getThumbnailUrl( '/upload/'.$model->image, 150, 150, 'AUTO' ).'" class="thumbimg">' : '',
                "format" => "html"
            ],
        ],
    ]) ?>

</div>
