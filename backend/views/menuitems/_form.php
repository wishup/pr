<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MenuItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $urls = [''=>''];

    $routes = \backend\models\MenuRoutes::find()->orderBy("title")->all();


    foreach( $routes as $route ){

        $route_urls = [];

        $rmodel = new $route->model();

        $route_models = $rmodel::find()->all();

        foreach( $route_models as $route_model ){

            $curr_url = str_replace('{id}', $route_model->id , $route->url_template);


            $route_urls[ $curr_url ] = $route_model->{$route->field};

        }

        $urls[ $route->title ] = $route_urls;

    }

    $urls[''] = '';
    $urls['other'] = 'Other';

    if( $model->other_url != '' )  $model->url = 'other';
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->dropDownList($urls, ["id"=>"menu_url"]) ?>

    <?= $form->field($model, 'other_url')->textInput(['maxlength' => true, 'id'=>'menu_url_other']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
