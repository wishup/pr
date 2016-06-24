<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Layouts;
use common\models\WidgetsInLayouts;
use common\models\LayoutsSettings;

/* @var $this yii\web\View */
/* @var $model common\models\Layouts */
/* @var $form yii\widgets\ActiveForm */

?>
<style>
    .portlet>.portlet-title>.tools>a.remove_layout_widget {
        background-image: url(/backend/assets/global/img/portlet-remove-icon.png);
        background-repeat: no-repeat;
        width: 11px;
    }
    .portlet.box>.portlet-title>.tools>a.collapse {background-image: url(/backend/assets/global/img/portlet-collapse-icon.png);}
    .portlet.box>.portlet-title>.tools>a.expand {background-image: url(/backend/assets/global/img/portlet-expand-icon.png);}
    .portlet-disabled .remove_layout_widget,
    .portlet-disabled .layouts_edit_widget{display:none !important;}
    .portlet-disabled .bootstrap-switch-handle-on{float:left !important;}
</style>
<script>
    var current_layout_id = <?= $model->id ?>;
</script>
<div class="layouts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    if( !$model->url && isset($_GET["url"]) ){
        $model->url = $_GET["url"];
    }
    ?>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'homepage')->checkbox() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        </div>
    </div>



    <div class="row">
        <div class="col-sm-6">
                <?php

                function get_layouts($mid, $parent_id = 0, $level = 1){

                    $parent_items = [];

                    if( $parent_id == 0 ) $parent_items[0]='';



                    $layouts = \common\models\Layouts::find()->where("id!=".$mid." AND parent_id=".$parent_id)->all();

                    foreach( $layouts as $layout ) {
                        $parent_items[$layout->id] = $layout->getName(false);

                        $childs = get_layouts($mid, $layout->id, $level+1);

                        foreach( $childs as $child_ind=>$child ){

                            for( $i=0; $i<($level*3); $i++ ) $child = ' '.$child;

                            $parent_items[$child_ind] = $child;

                        }
                    }

                    return $parent_items;

                }

                $parent_items = get_layouts((int)$model->id);
                ?>
                <?= $form->field($model, 'parent_id')->dropDownList($parent_items, ['encodeSpaces'=>true]) ?>
        </div>
        <div class="col-sm-6">
            <?php $file_items = Layouts::getLayoutFiles(); ?>
            <?= $form->field($model, 'layout_file')->dropDownList($file_items) ?>
        </div>
    </div>

    <?php
    if( !$model->isNewRecord ) {
        ?>


        <div class="btns-group form-group margin-top40">
            <a href="#" class="btn btn-primary layouts_add_widget btn-sm">Add widget</a>
        </div>

        <div class="modal fade basic-modal" id="addlayoutwidget" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog" style="width:70%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Add new widget</h4>
                    </div>
                    <div class="modal-body layout_widgets_form_container clearfix">
                        <div class="col-xs-12 form-horizontal">
                            <input type="hidden" value="0" class="layout_sel_widget_id" data-default="0">
                            <div class="form-group form-group-md">
                                <label class="col-sm-2 control-label">Title</label>

                                <div class="col-sm-10">
                                    <input type="text" value="" class="form-control layout_sel_widget_title" data-default="">
                                </div>
                            </div>
                            <div class="form-group form-group-md">
                                <label class="col-sm-2 control-label">Position</label>

                                <div class="col-sm-10">
                                    <select class="form-control layout_sel_widget_position" data-default="">
                                        <option value=""></option>
                                        <?php
                                        $positions = Layouts::getPositions();
                                        foreach ($positions as $position_slug => $position) {
                                            ?>
                                            <option value="<?= $position_slug ?>"><?= $position ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-md">
                                <label class="col-sm-2 control-label">Widget</label>

                                <div class="col-sm-10">
                                    <select class="form-control layout_sel_widget" data-default="">
                                        <option value=""></option>
                                        <?php
                                        foreach ($widgets as $widget) {
                                            ?>
                                            <option value="<?= $widget->slug ?>"><?= $widget->title ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div id="layouts_widgets_container">
                                <?php
                                foreach ($widgets as $widget_index=>$widget) {

                                    $widgetClass = 'common\\components\\widgets\\' . ucfirst($widget->slug);

                                    $params = $widgetClass::params();

                                    ?>
                                    <div class="layout_widget_cont" data-widget-slug="<?= $widget->slug ?>"
                                         style="display: none">
                                        <hr class="light">
                                        <?php
                                        foreach ($params as $param_index=>$param) {

                                            ?>
                                            <div class="form-group form-group-md" data-param-index="<?= $widget->slug.'_'.$param["slug"] ?>">
                                                <label class="col-sm-2 control-label"
                                                       for="formGroupInputLarge"><?= $param["label"] ?></label>

                                                <div class="col-sm-10">
                                                    <?php
                                                    \common\components\Widget::drawParam( $param, $this );
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                            if( $param["type"] == 'group' ){
                                                ?>
                                                <div class="widget_cloned_groups" data-param-index="<?= $widget->slug.'_'.$param["slug"] ?>"></div>
                                                <div class="row margin-bottom10">
                                                    <div class="col-sm-10 col-sm-offset-2">
                                                        <a href="#" class="add_widget_group" data-param-index="<?= $widget->slug.'_'.$param["slug"] ?>">Add group</a>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        <?php

                                        }
                                        ?>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                        <button type="button" class="btn green layout_save_widget" style="display:none">Save</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade basic-modal" id="addlayoutwidgetarea" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog" style="width:70%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Add widget area</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <input type="hidden" value="0" class="layout_sel_widget_area_id" data-default="0">
                            <div class="form-group form-group-md">
                                <label class="col-sm-2 control-label">Title</label>

                                <div class="col-sm-10">
                                    <input type="text" value="" class="form-control layout_sel_widget_area_title" data-default="">
                                </div>
                            </div>
                            <div class="form-group form-group-md">
                                <label class="col-sm-2 control-label">Position</label>

                                <div class="col-sm-10">
                                    <select class="form-control layout_sel_widget_area_position" data-default="">
                                        <option value=""></option>
                                        <?php
                                        $positions = Layouts::getPositions();
                                        foreach ($positions as $position_slug => $position) {
                                            ?>
                                            <option value="<?= $position_slug ?>"><?= $position ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-md">
                                <label class="col-sm-2 control-label">Areas</label>

                                <div class="col-sm-10">
                                    <select class="form-control layouts_sel_widgets_area">
                                        <option value=""></option>
                                        <?php
                                        $areas = \backend\models\WidgetsAreas::find()->orderBy("title")->all();
                                        foreach ($areas as $area) {
                                            ?>
                                            <option value="<?= $area->id ?>"><?= $area->title ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                        <button type="button" class="btn green layouts_add_widget_area_save" style="display:none">Save</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <?php
        function show_layout_section( $layout_id, $position ){

            if( $widgetsmodels = WidgetsInLayouts::find()->where("`layout_id`=".$layout_id." AND `position`='".$position."'")->orderBy("order")->all() ){
                foreach( $widgetsmodels as $wm ){

                    ?>
                    <div class="portlet portlet-sortable box default layout_widget_portlet <?= $wm->parent_id!=0 ? 'portlet-disabled' : '' ?>" style="display: block;" data-widget-id="<?= $wm->id ?>">
                        <div class="portlet-title">
                            <div class="caption widget_portlet_title"><?= $wm->title ?></div>
                            <div class="tools">
                                <a href="" class="expand"> </a>
                                <a href="" class="remove_layout_widget"></a>
                            </div>
                        </div>
                        <div class="portlet-body" style="display: none;">
                            <ul class="list-unstyled">
                                <?php
                                switch( $wm->type ){

                                    case 'widget':
                                        ?>
                                        <li><span class="font-grey-silver">Widget:</span>  <span class="widget_portlet_widget_title"><?= $wm->widget->title ?></span> </li>
                                        <li><span class="font-grey-silver">Description:</span>  <span class="widget_portlet_widget_desc"><?= $wm->widget->description ?></span> </li>
                                        <?php
                                        break;

                                    case 'area':
                                        ?>
                                        <li><span class="font-grey-silver">Widget Area:</span>  <span class="widget_portlet_widget_title"><?= $wm->widgetarea->title ?></span> </li>
                                        <?php
                                        break;

                                }
                                ?>
                            </ul>
                            <div class="clearfix">
                                <a href="#" class="btn-link pull-left layouts_edit_widget" data-widget-id="<?= $wm->id ?>" data-widget-type="<?= $wm->type ?>">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                <div class="pull-right bootstrap-switch-handle-on bootstrap-switch-success" >
                                    <input type="checkbox" class="make-switch layout_widget_active_check" data-on-color="success" data-size="small" <?= $wm->active ? 'checked' : '' ?>>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php

                }
            }

        }
        ?>

        <section class="well ui-sortable layout_section" id="sortable_category_portlets" data-layout-id="<?= $model->id ?>">
            <!--LAYOUT TOP-->
            <header class="layout-top sortable">
                <div class="portlet-title clearfix">
                    <h4 class="bold uppercase pull-left" style="margin-top:0;">Top </h4>
                    <div class="actions pull-right">
                    </div>
                </div>
                <div class="portlet box blue-hoki">
                    <div class="portlet-title">
                        <div class="caption"><small>Direction: Horizontal</small> </div>
                        <div class="actions bootstrap-switch-handle-on bootstrap-switch-success" >
                            <input type="checkbox" class="make-switch layout_section_active_check" data-section="top" data-on-color="success" data-size="small" <?= LayoutsSettings::isActive($model->id, 'top') ? 'checked' : '' ?>>
                        </div>
                    </div>
                    <div class="portlet-body layout_widgets_section" data-position="top">

                        <?php show_layout_section($model->id, 'top'); ?>


                        <!-- empty sortable porlet required for each columns! -->
                        <div class="portlet-sortable portlet-sortable-empty"> </div>
                    </div>
                </div>
            </header>
            <div class="row">
                <!--LAYOUT LEFT-->
                <div class="col-sm-4 col-lg-3 column sortable">
                    <div class="portlet-title clearfix">
                        <h4 class="bold uppercase pull-left" style="margin-top:0;">Left </h4>
                        <div class="actions pull-right">
                        </div>
                    </div>
                    <div class="portlet box blue-hoki">
                        <div class="portlet-title">
                            <div class="caption"><small>Direction: Vertical </small></div>
                            <div class="actions bootstrap-switch-handle-on bootstrap-switch-success" >
                                <input type="checkbox" class="make-switch layout_section_active_check" data-section="left" data-on-color="success" data-size="small" <?= LayoutsSettings::isActive($model->id, 'left') ? 'checked' : '' ?>>
                            </div>
                        </div>
                        <div class="portlet-body layout_widgets_section" data-position="left">
                            <?php show_layout_section($model->id, 'left'); ?>
                            <!-- empty sortable porlet required for each columns! -->
                            <div class="portlet-sortable portlet-sortable-empty"> </div>
                        </div>
                    </div>
                </div>
                <!--LAYOUT CENTER-->
                <div class="col-sm-4 col-lg-6 column sortable">
                    <div class="portlet-title clearfix">
                        <h4 class="bold uppercase pull-left" style="margin-top:0;">Center </h4>
                        <div class="actions pull-right">
                        </div>
                    </div>
                    <div class="portlet box blue-hoki">
                        <div class="portlet-title">
                            <div class="caption"><small>Direction: Vertical </small></div>
                            <div class="actions bootstrap-switch-handle-on bootstrap-switch-success" >
                                <input type="checkbox" class="make-switch layout_section_active_check" data-section="center" data-on-color="success" data-size="small" <?= LayoutsSettings::isActive($model->id, 'center') ? 'checked' : '' ?>>
                            </div>
                        </div>
                        <div class="portlet-body layout_widgets_section" data-position="center">
                            <?php show_layout_section($model->id, 'center'); ?>
                            <!-- empty sortable porlet required for each columns! -->
                            <div class="portlet-sortable portlet-sortable-empty"> </div>
                        </div>
                    </div>
                </div>

                <!--LAYOUT RIGHT-->
                <div class="col-sm-4 col-lg-3 column sortable">
                    <div class="portlet-title clearfix">
                        <h4 class="bold uppercase pull-left" style="margin-top:0;">Right </h4>
                        <div class="actions pull-right">
                        </div>
                    </div>
                    <div class="portlet box blue-hoki">
                        <div class="portlet-title">
                            <div class="caption"><small>Direction: Vertical </small></div>
                            <div class="actions bootstrap-switch-handle-on bootstrap-switch-success" >
                                <input type="checkbox" class="make-switch layout_section_active_check" data-section="right" data-on-color="success" data-size="small" <?= LayoutsSettings::isActive($model->id, 'right') ? 'checked' : '' ?>>
                            </div>
                        </div>
                        <div class="portlet-body layout_widgets_section" data-position="right">
                            <?php show_layout_section($model->id, 'right'); ?>
                            <!-- empty sortable porlet required for each columns! -->
                            <div class="portlet-sortable portlet-sortable-empty"> </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--LAYOUT BOTTOM-->
            <footer class="layout-bottom">
                <div class="portlet-title clearfix">
                    <h4 class="bold uppercase pull-left" style="margin-top:0;">Bottom </h4>
                    <div class="actions pull-right">
                    </div>
                </div>
                <div class="portlet box blue-hoki">
                    <div class="portlet-title">
                        <div class="caption"><small>Direction: Horizontal</small> </div>
                        <div class="actions bootstrap-switch-handle-on bootstrap-switch-success" >
                            <input type="checkbox" class="make-switch layout_section_active_check" data-section="bottom" data-on-color="success" data-size="small" <?= LayoutsSettings::isActive($model->id, 'bottom') ? 'checked' : '' ?>>
                        </div>
                        <!--   <div class="form-group pull-right">
                         <select class="form-control">
                                <option>Active</option>
                                <option>Disabled</option>
                            </select>
                        </div>-->
                    </div>
                    <div class="portlet-body sortable layout_widgets_section" data-position="bottom">
                        <?php show_layout_section($model->id, 'bottom'); ?>
                        <!-- empty sortable porlet required for each columns! -->
                        <div class="portlet-sortable portlet-sortable-empty"> </div>
                    </div>
                </div>
            </footer>


        </section>

    <?php
    }
    ?>

    <div class="form-group margin-top40">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>