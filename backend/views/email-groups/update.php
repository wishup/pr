<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EmailGroups */

$this->title = 'Update Email Groups: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Email Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="email-groups-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
