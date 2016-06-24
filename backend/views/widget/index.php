<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Widgets;
use backend\models\WidgetsAreas;
use backend\models\WidgetsInAreas;
use dosamigos\tinymce\TinyMce;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Widgets';
$this->params['breadcrumbs'][] = 'Widgets';
?>

<div class="row">
    <div class="col-sm-12 margin-top20">
        <a href="/backend/widgetsareas/create" class="btn btn-success">Create widget area</a>
    </div>
</div>

<script>
    var wid_params = new Array();
</script>

<div class="row widgets_areas margin-top40">
    <?php
    $wid_count = 0;
    foreach( $areas as $area ){

        ?>
        <div class="col-md-4 col-sm-4 widget_area" data-area-id="<?= $area->id ?>">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption widget_area_title">
                        <i class="icon-equalizer font-yellow"></i>
                        <span class="caption-subject font-yellow bold uppercase"><?= $area->title ?></span>
                        <span class="caption-helper"><?= $area->slug ?></span>
                    </div>
                    <div class="actions">
                        <a href="#addwidget" class="btn btn-sm btn-circle green add_widget_btn" data-toggle="modal" data-area-id="<?= $area->id ?>">Add</a>
                    </div>
                </div>
                <div class="portlet-body" style="display:none">
                    <div class="table-scrollable table-scrollable-borderless">
                        <table class="table table-hover table-light widget_area_table">
                            <thead>
                            <tr class="uppercase">
                                <th> WIDGET </th>
                                <th> DESCRIPTION </th>
                                <th style="width:100px"> ORDER </th>
                                <th style="width:120px"> ACTIONS </th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $areawidgets = WidgetsInAreas::find()->where("area_id=".$area->id)->orderBy('order')->all();
                                foreach( $areawidgets as $areawidget ){

                                    $widget = Widgets::find()->where("id=".$areawidget->widget_id)->one();

                                    $widget_params = unserialize( $areawidget->params );

                                    ?>
                                    <tr class="widget_row" data-widget-in-area="<?= $areawidget->id ?>">
                                        <td style="white-space:nowrap"><small><?= $widget->title ?></small></td>
                                        <td><small><?= $widget->description ?></small></td>
                                        <td class="fit sortnr"><?= $areawidget->order ?></td>
                                        <td class="fit">
                                            <a href="#" class="btn btn-xs btn-primary widget_edit" data-widget-id="<?= $areawidget->id ?>">Edit</a>
                                            <a href="#" class="btn btn-xs btn-primary red widget_delete" data-widget-in-area="<?= $areawidget->id ?>">Delete</a>
                                            <script>
                                                wid_params[<?= $areawidget->id ?>] = new Array();
                                                wid_params[<?= $areawidget->id ?>]['widget_id'] = '<?= $widget->id ?>';
                                                wid_params[<?= $areawidget->id ?>]['widget_slug'] = '<?= $widget->slug ?>';
                                                wid_params[<?= $areawidget->id ?>]['order'] = '<?= $areawidget->order ?>';
                                                wid_params[<?= $areawidget->id ?>]['area'] = '<?= $areawidget->area_id ?>';
                                                wid_params[<?= $areawidget->id ?>]['params'] = new Array();
                                                <?php
                                                foreach( $widget_params as $wparam_index=>$wparam_value ){

                                                    if( is_array($wparam_value) ){
                                                        ?>
                                                        wid_params[<?= $areawidget->id ?>]['params']['<?= $wparam_index ?>'] = new Array();
                                                        <?php
                                                        foreach( $wparam_value as $wpv_index=>$wpv ){
                                                            ?>
                                                            wid_params[<?= $areawidget->id ?>]['params']['<?= $wparam_index ?>']['<?= $wpv_index ?>'] = new Array();
                                                            wid_params[<?= $areawidget->id ?>]['params']['<?= $wparam_index ?>']['<?= $wpv_index ?>']['base_url'] = '<?= $wpv['base_url'] ?>';
                                                            wid_params[<?= $areawidget->id ?>]['params']['<?= $wparam_index ?>']['<?= $wpv_index ?>']['filename'] = '<?= $wpv['filename'] ?>';
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        wid_params[<?= $areawidget->id ?>]['params']['<?= $wparam_index ?>'] = "<?= addslashes(str_replace(PHP_EOL,'',$wparam_value)) ?>";
                                                        <?php
                                                    }

                                                }
                                                ?>
                                            </script>
                                        </td>
                                    </tr>
                                    <?php

                                }

                                if( count($areawidgets) == 0 ){
                                    ?>
                                    <tr class="nowidget_row">
                                        <td colspan="10" style="text-align:center"><small>There is no widget added yet in this area.</small></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $wid_count ++;

        if( fmod($wid_count, 3) == 0 ){
            ?>
            </div><div class="row widgets_areas">
            <?php
        }

    }
    ?>
</div>
<hr class="dark">

<h3 class="page-title">Available Widgets</h3>

<div class="row">
<?php
foreach( $widgets as $widget ){
    ?>
    <div class="col-md-3">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i><?= $widget->title ?> </div>
            </div>
            <div class="portlet-body"><?= $widget->description ?></div>
        </div>
    </div>
    <?php
}
?>
</div>

<div class="modal fade basic-modal" id="addwidget" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog" style="width:70%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add new widget</h4>
            </div>
            <div class="modal-body">
                <div class="row" id="widget_form_container">
                        <input type="hidden" name="area" value="0" id="modal_widget_area" data-default="0">
                        <input type="hidden" name="widget_in_area" value="0" id="modal_widget_in_area" data-default="0">
                        <div class="col-xs-12 form-horizontal">
                            <div class="form-group form-group-md">
                                <label class="col-sm-2 control-label">Widget</label>
                                <div class="col-sm-10">
                                    <select name="widget_slug" id="modal_widget_sel" class="form-control" data-default="">
                                        <option value=""></option>
                                        <?php
                                        foreach( $widgets as $widget ) {
                                            ?>
                                            <option value="<?= $widget->slug ?>"><?= $widget->title ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-md">
                                <label class="col-sm-2 control-label">Order</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="order" type="text" value="1" id="modal_widget_order" data-default="1">
                                </div>
                            </div>
                            <hr class="light">
                            <div id="modal_widgets_container">
                                <?php
                                foreach( $widgets as $widget ){

                                    $widgetClass = 'common\\components\\widgets\\' . ucfirst($widget->slug);

                                    $params = $widgetClass::params();

                                    ?>
                                    <div class="modal_widget_cont" data-widget-slug="<?= $widget->slug ?>" style="display: none">
                                        <?php
                                        foreach( $params as $param ){

                                            ?>
                                            <div class="form-group form-group-md">
                                                <label class="col-sm-2 control-label" for="formGroupInputLarge"><?= $param["label"] ?></label>
                                                <div class="col-sm-10">
                                                    <?php
                                                    switch( $param["type"] ){

                                                        case 'text':
                                                            ?>
                                                            <input class="form-control" name="<?= $param["slug"] ?>" type="text" value="<?= $param["default"] ?>" data-default="<?= $param["default"] ?>">
                                                            <?php
                                                            break;

                                                        case 'textarea':

                                                            if( !isset($param["wysiwyg"]) || $param["wysiwyg"] == false ) {
                                                                ?>
                                                                <textarea class="form-control" name="<?= $param["slug"] ?>" data-default="<?= $param["default"] ?>" rows="6"><?= $param["default"] ?></textarea>
                                                                <?php
                                                            } else {

                                                                echo TinyMCE::widget(['name' => $param["slug"], 'value' => $param["default"], 'options' => ['data-default' => $param["default"], "data-wysiwyg" => '1', "style"=>"height:200px"], 'clientOptions' => [
                                                                    'plugins' => [
                                                                        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                                                        'searchreplace wordcount visualblocks visualchars code fullscreen',
                                                                        'insertdatetime media nonbreaking save table contextmenu directionality',
                                                                        'emoticons template paste textcolor colorpicker textpattern imagetools'
                                                                    ],
                                                                    'toolbar1' => "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                                                                    'toolbar2' => "print preview media | forecolor backcolor"
                                                                ] ]);

                                                            }
                                                            break;

                                                        case 'file':
                                                            ?>
                                                            <input class="form-control" name="<?= $param["slug"] ?>" type="file" <?= ( isset($param["multiple"]) && $param["multiple"] == true ) ? 'multiple' : '' ?>>
                                                            <?php
                                                            break;

                                                        case 'checkbox':
                                                            ?>
                                                            <input class="form-control" name="<?= $param["slug"] ?>" type="checkbox" value="<?= $param["default"] ?>" data-default="<?= $param["default"] ?>" <?php if( $param["default"] == 1 ){ ?>checked<?php } ?>>
                                                            <?php
                                                            break;

                                                        case 'selectbox':
                                                            ?>
                                                            <select class="form-control" name="<?= $param["slug"] ?>" data-default="<?= $param["default"] ?>">
                                                                <?php
                                                                foreach( $param["values"] as $ind=>$val ){
                                                                    ?>
                                                                    <option value="<?= $ind ?>" <?php if( $ind == $param["default"] ) echo 'selected'; ?>><?= $val ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            <?php
                                                            break;

                                                    }
                                                    ?>
                                                </div>
                                            </div>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                <button type="button" class="btn green" id="save_widget_modal" style="display: none">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>