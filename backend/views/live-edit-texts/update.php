<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LiveEditTexts */

$this->title = 'Update Live Edit Texts: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Live Edit Texts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="live-edit-texts-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
