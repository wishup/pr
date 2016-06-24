<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Emailtemplates */

$this->title = 'Update Email template: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Email templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;
?>
<div class="emailtemplates-update">

    <?= $this->render('_form', [
        'model' => $model,
        'leyouts' => $leyouts,
    ]) ?>

</div>
