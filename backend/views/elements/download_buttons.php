<?php
use yii\helpers\Html;
?>
    <?= Html::a('CSV', null, ['class' => 'dt-button buttons-excel buttons-flash btn yellow btn-outline pull-right','data' => [
        'method' => 'post',
        'params' => [
            'action' => 'download_xls',
        ]]]) ?>