<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\WidgetsAreas */

$this->title = 'Create Widget Area';
$this->params['breadcrumbs'][] = ['label' => 'Widgets', 'url' => ['widget/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="widgets-areas-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
