<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Layouts */

$this->title = 'Update Layout ';
$this->params['breadcrumbs'][] = ['label' => 'Layouts', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>


    <?= $this->render('_form', [
        'model' => $model,
        'settings' => $settings,
        'widgets_areas' => $widgets_areas,
        'widgets' => $widgets,
        'layout_widgets' => $layout_widgets,
    ]) ?>

