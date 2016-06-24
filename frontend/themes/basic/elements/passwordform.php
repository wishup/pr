<?php
use yii\helpers\Html;

echo Html::beginForm('', 'post');
echo Html::input('password', 'password', Yii::$app->request->get("search"), ['class' => 'search', 'placeholder'=>'password']);
echo Html::submitButton('Submit', ['class' => 'search_submit']);
echo Html::endForm();

?>