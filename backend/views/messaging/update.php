<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Messaging */

$this->title = 'Update Message: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Communication centre messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="messaging-update">

    <?= $this->render('_form', [
        'model' => $model,
        'usersdataProvider' => $usersdataProvider,
        'mailingusers' => $mailingusers,
    ]) ?>

</div>
