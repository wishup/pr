<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ResourcesCategories */

$this->title = 'Create Resources Categories';
$this->params['breadcrumbs'][] = ['label' => 'Resources Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resources-categories-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
