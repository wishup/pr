<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Subscribers */

$this->title = 'Create Subscribers';
$this->params['breadcrumbs'][] = ['label' => 'Subscribers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscribers-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
