<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\EmailGroups */

$this->title = 'Create Email Groups';
$this->params['breadcrumbs'][] = ['label' => 'Email Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-groups-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
