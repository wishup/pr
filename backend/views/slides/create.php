<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Slides */

$this->title = 'Create Slides';
$this->params['breadcrumbs'][] = ['label' => 'Slides', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slides-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
