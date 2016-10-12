<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PostComments */

$this->title = 'Update Post Comments: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Post Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="post-comments-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
