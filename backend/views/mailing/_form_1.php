<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Mailing */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mailing-form">

    <?php $form = ActiveForm::begin(["options"=>[
        "data-disabled" => ( $model->paused == 1 ? '0' : '1' )
    ]]); ?>

    <div class="profile">
        <div class="tabbable-line tabbable-full-width">
            <?= $this->render("//mailing/steps", ["step"=>$step, "model_id" => ( $model->isNewRecord ? '' : $model->id )]) ?>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">

                    <div class="row">
                        <div class="col-sm-4">
                            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'from_name')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'from_email')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <?php
                            $freqitems = [''=>''];

                            for( $m=60; $m<=600; $m+=60 ) $freqitems[$m] = ($m/60)." minute";

                            $freqitems[1800] = "30 minute";
                            $freqitems[3600] = "1 houre";
                            ?>
                            <?= $form->field($model, 'frequency')->dropDownList($freqitems) ?>
                        </div>
                        <div class="col-sm-3">
                            <?= $form->field($model, 'email_count')->textInput() ?>
                        </div>
                        <div class="col-sm-3">
                            <?= $form->field($model, 'final_notification')->dropDownList([0=>"No", 1=>"Yes"]) ?>
                        </div>
                        <div class="col-sm-3">
                            <?= $form->field($model, 'start_at')->textInput([ "class"=>"form-control date-picker"]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <?php
                    $this->registerJsFile("/backend/js/tinymce_plugin.js", ["depends"=>"dosamigos\\tinymce\\TinyMceAsset"]);
                    $this->registerJsFile("/backend/js/tinymce_email_preview_plugin.js", ["depends"=>"dosamigos\\tinymce\\TinyMceAsset"]);
                    ?>
                    <?= $form->field($model, 'message')->widget(TinyMce::className(), [
                        'options' => ['rows' => 10],
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
                            'toolbar2' => "print preview media | forecolor backcolor bb_email_preview",
                            'readonly' => ( $model->paused == 0 ? 1 : 0 )
                        ]
                    ]) ?>
                    <?php
                    if( $model->paused == 1 ) {
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <h4>Insert Keywords</h4>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php

                                        if( $randuser = \common\models\Users::find()->one() ) {

                                            $keywords = \common\models\Mailing::emailParamsInfo($randuser, $model);

                                            foreach ($keywords as $keyword) {
                                                ?>
                                                <a href="#" class="mailing_keyword btn btn-info btn-xs"
                                                   style="margin-right:5px; margin-bottom:10px;"
                                                   data-keyword="<?= $keyword["key"] ?>"><?= $keyword["label"] ?></a>
                                            <?php
                                            }

                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h4>Use template</h4>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php
                                        $template_items = [
                                            '' => ''
                                        ];

                                        $template_models = \backend\models\MailingTemplates::find()->orderBy("title")->all();

                                        foreach( $template_models as $template_model ) $template_items[ $template_model->id ] = $template_model->title;
                                        ?>
                                        <?= Html::dropDownList("template_id", null, $template_items, ["class" => "form-control", "id" => "mailing_template_id"]) ?>
                                    </div>
                                </div>
                                <div class="row margin-top10">
                                    <div class="col-sm-12">
                                        <a href="#" class="btn btn-info btn-sm mailing_use_template">Use</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <p>&nbsp;</p>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Next step &rarr;', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
