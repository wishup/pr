<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rewrite Rules';
$this->params['breadcrumbs'][] = $this->title;
?>

    <p class="action_buttons">
        <?= Html::a('Create Rewrite Rule', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?= Html::beginForm('./','get', ['class'=>'gridform']) ?>

<?= $grid_view ?>


<?= Html::endForm() ?>

