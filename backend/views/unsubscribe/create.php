<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Unsubscribe */

$this->title = 'Create Unsubscribe';
$this->params['breadcrumbs'][] = ['label' => 'Unsubscribes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unsubscribe-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
