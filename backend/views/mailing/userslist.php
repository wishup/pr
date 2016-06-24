<?php
use yii\grid\GridView;
use dosamigos\tinymce\TinyMce;
?>

<?= GridView::widget([
    'dataProvider' => $usersdataProvider,
    'tableOptions' =>['class' => 'table table-striped table-bordered table-hover order-column'],
    'summary' => '',
    'columns' => [
        [
            'class' => 'yii\grid\CheckboxColumn',
            'checkboxOptions' => function ($model, $key, $index, $column) use ($mailingusers) {

                $options = ['value' => $model->id, 'class' => 'users_list_check'];

                return $options;
            },
            'name' => 'userslist'
        ],
        'email',
    ],
]); ?>