<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Emailtemplates */

$this->title = 'Create Email template';
$this->params['breadcrumbs'][] = ['label' => 'Email templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emailtemplates-create">

    <?= $this->render('_form', [
        'model' => $model,
        'leyouts' => $leyouts
    ]) ?>

</div>
