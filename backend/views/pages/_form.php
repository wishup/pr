<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use common\models\User;
use yii\bootstrap\Button;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-sm-8">

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <div class="page_type_cont" data-type-id="0">

                <?= $form->field($model, 'header')->textInput(['maxlength' => true]) ?>
                <?php
                $this->registerJsFile("/backend/js/tinymce_plugin.js", ["depends"=>"dosamigos\\tinymce\\TinyMceAsset"]);
                ?>
                <?= $form->field($model, 'content')->widget(TinyMce::className(), [
                    'options' => ['rows' => 10],
                    'clientOptions' => [
                        'relative_urls' => false,
                        'remove_script_host' => false,
                        'convert_urls' => false,
                        'image_advtab' => true,
                        'plugins' => [
                            'bb_media advlist autolink lists link image charmap print preview hr anchor pagebreak',
                            'searchreplace wordcount visualblocks visualchars code fullscreen',
                            'insertdatetime media nonbreaking save table contextmenu directionality',
                            'emoticons template paste textcolor colorpicker textpattern imagetools'
                        ],
                        'toolbar1' => "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image bb_media",
                        'toolbar2' => "print preview media | forecolor backcolor",
                    ]
                ]) ?>

                <?php
                if( !$model->isNewRecord ){

                    $revisions = \backend\models\PagesRevisions::find()->where("page_id=".$model->id)->with(["user"])->orderBy("date asc")->all();

                    ?>
                    <p>&nbsp;</p>
                    <h4>Revisions</h4>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> Date </th>
                            <th> User </th>
                            <th> Action </th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                    <?php
                    $i=0;
                    foreach( $revisions as $rev ){

                        $i++;
                        ?>
                            <tr class="odd gradeX">
                                <td><?= $i ?></td>
                                <td><?= $rev->date ?></td>
                                <td><?= $rev->user->username ?></td>
                                <td><?= $rev->action ?></td>
                                <td><a href="/backend/pages/restore/<?= $rev->id ?>" class="btn btn-primary btn-xs restore_page">Restore</a> </td>
                            </tr>

                        <?php
                    }
                        ?>
                    </tbody>
                    </table>
                            <?php

                }
                ?>

            </div>
            
        </div>

        <div class="col-sm-4">
            <?php

            $args = [
                "default_url_template" => "site/view/{model_id}",
                "model_id" => $model->id,
            ];

            echo \common\components\Settings::renderSettingsBlock( $args );
            echo \common\components\Settings::renderOptionsBlock('Pages', $model->id);
            ?>
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Configurations</div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <?= $form->field($model, 'exclude_from_search')->checkbox(); ?>
                    <?= $form->field($model, 'status')->dropDownList(['published'=>'Published','draft'=>'Draft','private'=>'Private']); ?>
                    <div class="password_input hidden">
                        <?= $form->field($model, 'password');?>
                        <?php
                        echo Button::widget([
                            'label' => 'Generate Password',
                            'options' => ['class' => 'btn-generate','data-generateto' =>'pages-password'],
                        ]);
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
