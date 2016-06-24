<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Layouts */

$this->title = 'Create Layout';
$this->params['breadcrumbs'][] = ['label' => 'Layouts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
        'widgets_areas' => $widgets_areas,
        'widgets' => $widgets,
        'layout_widgets' => $layout_widgets,
    ]) ?>

