<?php
use yii\helpers\Html;

echo Html::beginForm(['site/search'], 'get', ['class'=>'sr-box']);
echo Html::input('text', 'search', Yii::$app->request->get("search"), ['class' => 'sr-inp', 'placeholder'=>'Search...']);
echo Html::Button('', ['class' => 'sr-btn icon-glass']);
echo Html::endForm();

?>