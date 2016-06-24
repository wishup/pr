<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MailingTemplates */

$this->title = 'Update Email Template: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Email Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mailing-templates-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
