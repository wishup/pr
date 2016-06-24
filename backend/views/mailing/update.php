<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Mailing */

$this->title = 'Update Email: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Communication centre emails', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mailing-update">


    <?= $this->render('_form_'.$step, [
        'model' => $model,
        'step' => $step,
        "usersdataProvider" => $usersdataProvider,
        'mailingusers' => $mailingusers,
        'mailinguserssent' => $mailinguserssent,
    ]) ?>

</div>
