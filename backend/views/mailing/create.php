<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Mailing */

$this->title = 'Create Email';
$this->params['breadcrumbs'][] = ['label' => 'Communication centre emails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mailing-create">

    <?= $this->render('_form_1', [
        'model' => $model,
        'step' => $step,
    ]) ?>

</div>
