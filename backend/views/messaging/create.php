<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Messaging */

$this->title = 'Create Message';
$this->params['breadcrumbs'][] = ['label' => 'Communication centre messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messaging-create">

    <?= $this->render('_form', [
        'model' => $model,
        'usersdataProvider' => $usersdataProvider,
        'mailingusers' => $mailingusers,
    ]) ?>

</div>
