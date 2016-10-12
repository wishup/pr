<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PostComments */

$this->title = 'Create Post Comments';
$this->params['breadcrumbs'][] = ['label' => 'Post Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-comments-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
