<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Emails */

$this->title = 'Update Email: ' . ' ' . $model->subject;
$this->params['breadcrumbs'][] = ['label' => 'Emails', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->subject, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="emails-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
