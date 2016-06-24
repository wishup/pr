<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Emailtemplates */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="emailtemplates-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'from_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'from_email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'description')->textarea(array('style' => 'height:108px')) ?>
        </div>
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-6">
                    <?php
                    $list = array('0' => 'Disabled', '1' => 'Enabled');
                    $options = array();
                    if ($model->status == 2) {
                        $list[2] = 'Enabled';
                        $options['disabled'] = 'disabled';
                    }
                    ?>
                    <?= $form->field($model, 'status')->dropDownList($list, $options); ?>
                </div>
                <div class="col-sm-6">
                    <?php
                    $options = array();
                    if ($model->slug) {
                        $options['disabled'] = 'disabled';
                    }
                    ?>
                    <?= $form->field($model, 'slug')->textInput($options); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <?php
                    $list = array();
                    foreach ($leyouts as $layout) {
                        $list[$layout->id] = $layout->name;
                    }
                    ?>
                    <?= $form->field($model, 'layout_id')->dropDownList($list); ?>
                </div>
                <div class="col-sm-6">
                    <?php
                    $groupmodels = \common\models\EmailGroups::find()->orderBy("title")->all();
                    $group_items = [0=>''];
                    foreach( $groupmodels as $groupmodel )
                             $group_items[ $groupmodel->id ] = $groupmodel->title;
                    ?>
                    <?= $form->field($model, 'group_id')->dropDownList($group_items); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="tabbable tabbable-tabdrop">
        <ul class="nav nav-tabs custom-nav-tabs">
            <li class="active">
                <a href="#tab_html" data-toggle="tab">Html</a>
            </li>
            <li><a href="#tab_text" data-toggle="tab">Text</a></li>
        </ul>
        <div class="tab-content custom-tab-content">
            <div class="tab-pane active" id="tab_html">
                <?php
                $this->registerJsFile("/backend/js/tinymce_plugin.js", ["depends" => "dosamigos\\tinymce\\TinyMceAsset"]);
                $this->registerJsFile("/backend/js/tinymce_email_preview_plugin.js", ["depends" => "dosamigos\\tinymce\\TinyMceAsset"]);
                ?>
                <?= $form->field($model, 'content')->widget(TinyMce::className(), [
                    'options' => ['rows' => 30, 'paste_enable_default_filters' => false],
                    'clientOptions' => [
                        'relative_urls' => false,
                        'remove_script_host' => false,
                        'convert_urls' => false,
                        'plugins' => [
                            'bb_media bb_email_preview advlist autolink lists link image charmap print preview hr anchor pagebreak',
                            'searchreplace wordcount visualblocks visualchars code fullscreen',
                            'insertdatetime media nonbreaking save table contextmenu directionality',
                            'emoticons template paste textcolor colorpicker textpattern imagetools'
                        ],
                        'toolbar1' => "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image bb_media",
                        'toolbar2' => "print preview media | forecolor backcolor bb_email_preview"
                    ]
                ]) ?>
            </div>
            <div class="tab-pane" id="tab_text">
                <?= $form->field($model, 'plaintext')->textarea(['rows' => 30]) ?>
            </div>
            <?php
            if (!$model->isNewRecord) {

                $revisions = \backend\models\EmailtemplatesRevisions::find()->where("emailtemplate_id=" . $model->id)->with(["user"])->orderBy("date asc")->all();

                ?>
                <p>&nbsp;</p>
                <h4>Revisions</h4>
                <table class="table table-striped table-bordered table-hover table-checkable order-column"
                       id="sample_1">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th> Date</th>
                        <th> User</th>
                        <th> Action</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 0;
                    foreach ($revisions as $rev) {

                        $i++;
                        ?>
                        <tr class="odd gradeX">
                            <td><?= $i ?></td>
                            <td><?= $rev->date ?></td>
                            <td><?= $rev->user->username ?></td>
                            <td><?= $rev->action ?></td>
                            <td><a href="/backend/emailtemplates/restore/<?= $rev->id ?>"
                                   class="btn btn-primary btn-xs restore_page">Restore</a></td>
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

    <?php
    if ($model->isNewRecord) {
        echo $form->field($model, 'shortcodes')->textarea(['rows' => 6]);
    } else {
        echo "<p><pre>" . $model->shortcodes . "</pre></p>";
    }
    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
