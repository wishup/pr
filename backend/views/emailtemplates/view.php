<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Emailtemplates */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Email templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emailtemplates-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
    <iframe width="100%" height="900px" frameborder="none;" src="<?= Url::to(['emailtemplates/preview/'.$model->id]);?>"></iframe>


</div>
