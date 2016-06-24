<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::$app->params["project_name"].' | CMS';
?>
    <?php $form = ActiveForm::begin(['class' => 'login-form', "fieldConfig" => [
        "labelOptions" => [
            "class" => "control-label visible-ie8 visible-ie9"
        ]
    ],]); ?>

    <h3 class="form-title font-green">Sign In</h3>

    <?= $form->field($model, 'username', [
        'inputOptions' => [
            'placeholder' => $model->getAttributeLabel('username'),
        ],
    ]) ?>

    <?= $form->field($model, 'password', [
        'inputOptions' => [
            'placeholder' => $model->getAttributeLabel('password'),
        ],
    ])->passwordInput() ?>

    <div class="form-actions">
        <?= Html::submitButton('Login', ['class' => 'btn green uppercase', 'name' => 'login-button']) ?>
        <label class="rememberme check">
            <?= $form->field($model, 'rememberMe', [
                'template' => '{input} {label}'
            ])->checkbox(['label'=>'Remember'], false) ?>
        </label>
    </div>

    <?php ActiveForm::end(); ?>
