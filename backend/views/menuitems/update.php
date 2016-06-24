<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MenuItems */

$this->title = 'Update Menu Item: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['//menu/index']];
$this->params['breadcrumbs'][] = 'Update';
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

