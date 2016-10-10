<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GalleryItem */

$this->title = 'Create Gallery Item';
$this->params['breadcrumbs'][] = ['label' => 'Gallery Items', 'url' => ['index', 'id' => Yii::$app->request->get('id')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-item-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
