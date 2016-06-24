<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MenuItems */

$this->title = 'Create Menu Items';
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['//menu/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

