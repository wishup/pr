<?php
use yii\helpers\Html;
use common\models\Layouts;

?>

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-cogs"></i>Page Settings</div>
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
        </div>
    </div>
    <div class="portlet-body">
        <input type="hidden" name="ps[default_url_template]" value="<?= $default_url_template ?>">
        <div id="blockui_sample_3_2_element">
            <div class="form-group field-pages-name required">
                <?= Html::label('System Url <small>(Read-only)</small>', 'default_url') ?>
                <?= Html::textInput('ps[default_url]', ( $model_id != '' ? str_replace('{model_id}', $model_id, $default_url_template) : '' ), ['class'=>'form-control', 'readonly'=>true]) ?>

                <div class="help-block"></div>
            </div>

            <div class="form-group field-pages-name required">
                <?= Html::label('Rewrite Url', 'rewrite_url') ?>
                <?= Html::textInput('ps[rewrite_url]', $rewrite_url, ['class'=>'form-control']) ?>

                <div class="help-block"></div>
            </div>

            <div class="form-group field-pages-name required">
                <?= Html::label('Title', 'title') ?>
                <?= Html::textInput('ps[title]', $title, ['class'=>'form-control']) ?>

                <div class="help-block"></div>
            </div>

            <div class="form-group field-pages-name required">
                <?= Html::label('Meta description', 'meta_description') ?>
                <?= Html::textarea('ps[meta_description]', $meta_description, ['class'=>'form-control', 'rows'=>3]) ?>

                <div class="help-block"></div>
            </div>

            <div class="form-group field-pages-name required">
                <?= Html::label('Meta keywords', 'meta_keywords') ?>
                <?= Html::textarea('ps[meta_keywords]', $meta_keywords, ['class'=>'form-control', 'rows'=>3]) ?>

                <div class="help-block"></div>
            </div>
            <?php
            if( $model_id ) {

                if( $layout = Layouts::find()->where("url='".str_replace('{model_id}', $model_id, $default_url_template)."'")->one() ){

                    $layout_url = '/backend/layouts/update/'.$layout->id;
                    $layout_wrd = 'Change';

                } else {

                    $layout_url = '/backend/layouts/create?url='.str_replace('{model_id}', $model_id, $default_url_template);
                    $layout_wrd = 'Create';

                }

                ?>
                <div class="form-group field-pages-name required">
                    <?= $layout_wrd ?> layout for this particular page: <a href="<?= $layout_url ?>" target="_blank" class="btn btn-info btn-xs"><?= $layout_wrd ?></a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>