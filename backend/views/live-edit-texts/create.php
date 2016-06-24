<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LiveEditTexts */

$this->title = 'Create Live Edit Texts';
$this->params['breadcrumbs'][] = ['label' => 'Live Edit Texts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="live-edit-texts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
