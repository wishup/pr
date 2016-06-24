<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Layouts */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="layouts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    if( !$model->url && isset($_GET["url"]) ){
        $model->url = $_GET["url"];
    }
    ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <h4>Layout Configuration</h4>
    <div class="row">
        <div class="col-xs-6">
                <?php

                function get_layouts($mid, $parent_id = 0, $level = 1){

                    $parent_items = [];

                    if( $parent_id == 0 ) $parent_items[0]='';



                    $layouts = \common\models\Layouts::find()->where("id!=".$mid." AND parent_id=".$parent_id)->all();

                    foreach( $layouts as $layout ) {
                        $parent_items[$layout->id] = $layout->url == '' ? 'Main layout' : $layout->url;

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
                <?= $form->field($model, 'parent_id')->dropDownList($parent_items, ['id'=>'extand_layout', 'encodeSpaces'=>true]) ?>
        </div>
    </div>
    <p>
        <table width="100%">
            <tr>
                <td class=" layout_section layout_header" colspan="3">
                    <label>Header section <small>(header_section)</small></label>
                    <?php $section_slug = 'header'; ?>
                    <div class="disable_section">
                        <div class="disable_section_cont">
                            <input type="hidden" name="ls[header_disable]" value="<?= isset($settings["header_disable"]) ? $settings["header_disable"]->value : 0 ?>" class="disable_section_check_inp">
                            <input type="checkbox" class="disable_section_check disable_<?= $section_slug ?>" <?= ( isset($settings["header_disable"]) && $settings["header_disable"]->value==1 ) ? 'checked' : '' ?>> Disable section
                        </div>
                    </div>
                    <div class="section_widget_area">
                        <div class="section_widget_area_tmpl">
                            <div class="row wdg_area_s">
                                <div class="col-xs-3">
                                    <select name="wd[<?= $section_slug ?>][]" class="form-control">
                                        <option value="0"></option>
                                        <?php
                                        foreach( $widgets_areas as $wa ){
                                            ?>
                                            <option value="<?= $wa->id ?>"><?= $wa->title; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-xs-3">
                                    <a href="#" class="remove_widget_area_fs btn btn-warning btn-xs">Remove</a>
                                </div>
                            </div>
                        </div>
                        <div class="section_widget_area_extanded section_widget_area_extanded_<?= $section_slug ?>"></div>
                        <div class="section_widget_area_cont">
                            <?php
                            foreach( $layout_widgets as $lw ){

                                if( $lw->section != $section_slug ) continue;

                                ?>
                                <div class="row wdg_area_s">
                                    <div class="col-xs-3">
                                        <select name="wd[<?= $section_slug ?>][]" class="form-control">
                                            <option value="0"></option>
                                            <?php
                                            foreach( $widgets_areas as $wa ){
                                                ?>
                                                <option value="<?= $wa->id ?>" <?= $wa->id == $lw->widget_area_id ? 'selected' : '' ?>><?= $wa->title; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-3">
                                        <a href="#" class="remove_widget_area_fs btn btn-warning btn-xs">Remove</a>
                                    </div>
                                </div>
                                <?php

                            }
                            ?>
                        </div>
                        <p>
                            <a href="#" class="add_widget_area_to_section btn btn-primary btn-xs">Add widgets</a>
                        </p>
                    </div>
                </td>
            </tr>
            <tr>
                <td class=" layout_section layout_left">
                    <label>Left section <small>(left_section)</small></label>
                    <?php $section_slug = 'left'; ?>
                    <div class="disable_section">
                        <div class="disable_section_cont">
                            <input type="hidden" name="ls[left_disable]" value="<?= isset($settings["left_disable"]) ? $settings["left_disable"]->value : 0 ?>" class="disable_section_check_inp">
                            <input type="checkbox" class="disable_section_check disable_<?= $section_slug ?>" <?= ( isset($settings["left_disable"]) && $settings["left_disable"]->value==1 ) ? 'checked' : '' ?>> Disable section
                        </div>
                    </div>

                    <div class="section_widget_area">
                        <div class="section_widget_area_tmpl">
                            <div class="row wdg_area_s">
                                <div class="col-xs-9">
                                    <select name="wd[<?= $section_slug ?>][]" class="form-control">
                                        <option value="0"></option>
                                        <?php
                                        foreach( $widgets_areas as $wa ){
                                            ?>
                                            <option value="<?= $wa->id ?>"><?= $wa->title; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-xs-3">
                                    <a href="#" class="remove_widget_area_fs btn btn-warning btn-xs">Remove</a>
                                </div>
                            </div>
                        </div>
                        <div class="section_widget_area_extanded section_widget_area_extanded_<?= $section_slug ?>"></div>
                        <div class="section_widget_area_cont">
                            <?php
                            foreach( $layout_widgets as $lw ){

                                if( $lw->section != $section_slug ) continue;

                                ?>
                                <div class="row wdg_area_s">
                                    <div class="col-xs-9">
                                        <select name="wd[<?= $section_slug ?>][]" class="form-control">
                                            <option value="0"></option>
                                            <?php
                                            foreach( $widgets_areas as $wa ){
                                                ?>
                                                <option value="<?= $wa->id ?>" <?= $wa->id == $lw->widget_area_id ? 'selected' : '' ?>><?= $wa->title; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-3">
                                        <a href="#" class="remove_widget_area_fs btn btn-warning btn-xs">Remove</a>
                                    </div>
                                </div>
                            <?php

                            }
                            ?>
                        </div>
                        <p>
                            <a href="#" class="add_widget_area_to_section btn btn-primary btn-xs">Add widgets</a>
                        </p>
                    </div>
                </td>
                <td class=" layout_section layout_center">
                    <label>Center section <small>(center_section)</small></label>
                    <?php $section_slug = 'center'; ?>
                    <div class="disable_section">
                        <div class="disable_section_cont">
                            <input type="hidden" name="ls[center_disable]" value="<?= isset($settings["center_disable"]) ? $settings["center_disable"]->value : 0 ?>" class="disable_section_check_inp">
                            <input type="checkbox" class="disable_section_check disable_<?= $section_slug ?>" <?= ( isset($settings["center_disable"]) && $settings["center_disable"]->value==1 ) ? 'checked' : '' ?>> Disable section
                        </div>
                    </div>

                    <div class="section_widget_area">
                        <div class="section_widget_area_tmpl">
                            <div class="row wdg_area_s">
                                <div class="col-xs-3">
                                    <select name="wd[<?= $section_slug ?>][]" class="form-control">
                                        <option value="0"></option>
                                        <?php
                                        foreach( $widgets_areas as $wa ){
                                            ?>
                                            <option value="<?= $wa->id ?>"><?= $wa->title; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-xs-3">
                                    <a href="#" class="remove_widget_area_fs btn btn-warning btn-xs">Remove</a>
                                </div>
                            </div>
                        </div>
                        <div class="section_widget_area_extanded section_widget_area_extanded_<?= $section_slug ?>"></div>
                        <div class="section_widget_area_cont">
                            <?php
                            foreach( $layout_widgets as $lw ){

                                if( $lw->section != $section_slug ) continue;

                                ?>
                                <div class="row wdg_area_s">
                                    <div class="col-xs-3">
                                        <select name="wd[<?= $section_slug ?>][]" class="form-control">
                                            <option value="0"></option>
                                            <?php
                                            foreach( $widgets_areas as $wa ){
                                                ?>
                                                <option value="<?= $wa->id ?>" <?= $wa->id == $lw->widget_area_id ? 'selected' : '' ?>><?= $wa->title; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-3">
                                        <a href="#" class="remove_widget_area_fs btn btn-warning btn-xs">Remove</a>
                                    </div>
                                </div>
                            <?php

                            }
                            ?>
                        </div>
                        <p>
                            <a href="#" class="add_widget_area_to_section btn btn-primary btn-xs">Add widgets</a>
                        </p>
                    </div>
                </td>
                <td class=" layout_section layout_right">
                    <label>Right section <small>(right_section)</small></label>
                    <?php $section_slug = 'right'; ?>
                    <div class="disable_section">
                        <div class="disable_section_cont">
                            <input type="hidden" name="ls[right_disable]" value="<?= isset($settings["right_disable"]) ? $settings["right_disable"]->value : 0 ?>" class="disable_section_check_inp">
                            <input type="checkbox" class="disable_section_check disable_<?= $section_slug ?>" <?= ( isset($settings["right_disable"]) && $settings["right_disable"]->value==1 ) ? 'checked' : '' ?>> Disable section
                        </div>
                    </div>

                    <div class="section_widget_area">
                        <div class="section_widget_area_tmpl">
                            <div class="row wdg_area_s">
                                <div class="col-xs-9">
                                    <select name="wd[<?= $section_slug ?>][]" class="form-control">
                                        <option value="0"></option>
                                        <?php
                                        foreach( $widgets_areas as $wa ){
                                            ?>
                                            <option value="<?= $wa->id ?>"><?= $wa->title; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-xs-3">
                                    <a href="#" class="remove_widget_area_fs btn btn-warning btn-xs">Remove</a>
                                </div>
                            </div>
                        </div>
                        <div class="section_widget_area_extanded section_widget_area_extanded_<?= $section_slug ?>"></div>
                        <div class="section_widget_area_cont">
                            <?php
                            foreach( $layout_widgets as $lw ){

                                if( $lw->section != $section_slug ) continue;

                                ?>
                                <div class="row wdg_area_s">
                                    <div class="col-xs-9">
                                        <select name="wd[<?= $section_slug ?>][]" class="form-control">
                                            <option value="0"></option>
                                            <?php
                                            foreach( $widgets_areas as $wa ){
                                                ?>
                                                <option value="<?= $wa->id ?>" <?= $wa->id == $lw->widget_area_id ? 'selected' : '' ?>><?= $wa->title; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-3">
                                        <a href="#" class="remove_widget_area_fs btn btn-warning btn-xs">Remove</a>
                                    </div>
                                </div>
                            <?php

                            }
                            ?>
                        </div>
                        <p>
                            <a href="#" class="add_widget_area_to_section btn btn-primary btn-xs">Add widgets</a>
                        </p>
                    </div>
                </td>
            </tr>
            <tr>
                <td class=" layout_section layout_footer" colspan="3">
                    <label>Footer section <small>(footer_section)</small></label>
                    <?php $section_slug = 'footer'; ?>
                    <div class="disable_section">
                        <div class="disable_section_cont">
                            <input type="hidden" name="ls[footer_disable]" value="<?= isset($settings["footer_disable"]) ? $settings["footer_disable"]->value : 0 ?>" class="disable_section_check_inp">
                            <input type="checkbox" class="disable_section_check disable_<?= $section_slug ?>" <?= ( isset($settings["footer_disable"]) && $settings["footer_disable"]->value==1 ) ? 'checked' : '' ?>> Disable section
                        </div>
                    </div>

                    <div class="section_widget_area">
                        <div class="section_widget_area_tmpl">
                            <div class="row wdg_area_s">
                                <div class="col-xs-3">
                                    <select name="wd[<?= $section_slug ?>][]" class="form-control">
                                        <option value="0"></option>
                                        <?php
                                        foreach( $widgets_areas as $wa ){
                                            ?>
                                            <option value="<?= $wa->id ?>"><?= $wa->title; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-xs-3">
                                    <a href="#" class="remove_widget_area_fs btn btn-warning btn-xs">Remove</a>
                                </div>
                            </div>
                        </div>
                        <div class="section_widget_area_extanded section_widget_area_extanded_<?= $section_slug ?>"></div>
                        <div class="section_widget_area_cont">
                            <?php
                            foreach( $layout_widgets as $lw ){

                                if( $lw->section != $section_slug ) continue;

                                ?>
                                <div class="row wdg_area_s">
                                    <div class="col-xs-3">
                                        <select name="wd[<?= $section_slug ?>][]" class="form-control">
                                            <option value="0"></option>
                                            <?php
                                            foreach( $widgets_areas as $wa ){
                                                ?>
                                                <option value="<?= $wa->id ?>" <?= $wa->id == $lw->widget_area_id ? 'selected' : '' ?>><?= $wa->title; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-3">
                                        <a href="#" class="remove_widget_area_fs btn btn-warning btn-xs">Remove</a>
                                    </div>
                                </div>
                            <?php

                            }
                            ?>
                        </div>
                        <p>
                            <a href="#" class="add_widget_area_to_section btn btn-primary btn-xs">Add widgets</a>
                        </p>
                    </div>
                </td>
            </tr>
        </table>
    </p>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
