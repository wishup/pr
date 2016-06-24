<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UnsubscribeReasons */

$this->title = 'Create Unsubscribe Reasons';
$this->params['breadcrumbs'][] = ['label' => 'Unsubscribe Reasons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unsubscribe-reasons-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
