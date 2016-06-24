<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MailingTemplates */

$this->title = 'Create Email Template';
$this->params['breadcrumbs'][] = ['label' => 'Email Template', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mailing-templates-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
