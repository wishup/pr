<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
    var menu_id = <?= $model->id ?>;
</script>

    <h3 class="page-title"><?= Html::encode($this->title) ?> <a href="/backend/menuitems/create/<?= $model->id ?>" class="btn btn-xs btn-primary" style="margin-left:30px">Create menu item</a> </h3>

    <div id="menu_tree" class="tree-demo"> </div>

