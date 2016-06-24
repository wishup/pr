<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Emails */

$this->title = 'Create & Send Email';
$this->params['breadcrumbs'][] = ['label' => 'Emails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emails-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
