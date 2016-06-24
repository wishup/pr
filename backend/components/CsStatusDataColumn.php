<?php
namespace backend\components;

use common\components\Email;
use common\models\Emailtemplates;
use dosamigos\tinymce\TinyMce;
use yii\grid\DataColumn;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQueryInterface;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Inflector;


class CsStatusDataColumn extends DataColumn
{
    public $hasCheckbox;
    public $allFilters;
    public $cs_types = array('h', 'f', 'v', 'n');

//    protected function renderHeaderCellContent()
//    {
//        $resust  = parent::renderHeaderCellContent();
//        $resust .= ($this->hasCheckbox)?'<input type="checkbox" class="checkall_hosts">':'';
//        return $resust;
//    }
    function __construct($config = [])
    {
        parent::__construct($config);

        $this->cs_types = $this->attribute ? array(substr($this->attribute, 0, 1)) : $this->cs_types;

        $model = $this->grid->filterModel;
        $this->value = function ($model) {

            $cs_statuses = Yii::$app->params["cs_statuses"];

            $emailTemplateAvailable = array();
            $block = '';
            foreach ($this->cs_types as $cs_type) {
                $block .= '<div class="cs-status-checkbox-wrap cs-status' . $model->{$cs_type . '_cs_status'} . '" >
                                    <div class="cs-status-checkbox-list">';
                foreach ($cs_statuses as $index => $value) {

                    $email_slug= $cs_type.'_'.$index;
                    if(!isset($emailTemplateAvailable[$email_slug])){
                        $emailTemplate = Emailtemplates::findBySlug($cs_type.'_'.$index);
                        $emailTemplateAvailable[$email_slug] = ($emailTemplate and $emailTemplate->status);
                    }

                    $block .= '<button class="cs-status-checkbox" id="'.$cs_type . "_cs_status".$model->id.'ind'.$index.'" type="button" data-id="' . $model->id . '" data-status="cs-status' . $index . '" data-index="' . $index . '" data-type="' . $cs_type . '" data-notify="'.($emailTemplateAvailable[$email_slug]?"true":"false").'"></button>';
                }
                $block .= '</div>';
                $block .= $this->hasCheckbox ?'<input type="checkbox" name="bulk_action[]" value="' . $model->id . '" class="bulk_act">':'<span>' . strtoupper($cs_type) . '</span>';
                $block .= '</div>';

            }
            return $block;
        };

        $this->contentOptions = ['class' => 'cs_status_td'];
        $this->headerOptions = ['class' => 'cs_status_td'];
        $this->filterOptions = ['class' => 'cs_status_td'];

        $this->format = "raw";

        $cs_statuses = Yii::$app->params["cs_statuses"];
        unset($cs_statuses[0]);
        $this->filter = array_filter($cs_statuses);
    }

    protected function renderHeaderCellContent()
    {
        $result = '<div id="popover-data"></div>';

        foreach ($this->cs_types as $cs_type) {
            $this->attribute = $cs_type . '_cs_status';
            $this->label = strtoupper($cs_type);
            $result .= parent::renderHeaderCellContent();
            $result .= ($this->hasCheckbox) ? '<input type="checkbox" class="checkall_hosts">' : '';
        }
        return $result;
    }

    protected function renderFilterCellContent()
    {

        if (is_string($this->filter)) {
            return $this->filter;
        }

        $model = $this->grid->filterModel;
        $options = array_merge(['prompt' => ''], $this->filterInputOptions);

        ob_start(); ?>

        <div style="display: none;">

            <?php foreach ($this->cs_types as $cs_type) {
                $cs_statuses = Yii::$app->params["cs_statuses"];
                foreach ($cs_statuses as $index => $cs_status) { ?>
                    <?php   $email = Emailtemplates::findBySlug($cs_type.'_'.$index);
                    if($email and $email->status) {                    ?>
                        <span id="cs_email_<?php echo $cs_type.'_'.$index; ?>"><?php echo $email->content; ?></span>
                    <?php }?>

                <?php }
            }
            ?>

        </div>
        <div class="modal fade basic-modal" id="status_change_email" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog" style="width:70%">
                <div class="modal-content">
                    <div class="modal-body cs_email_form_container clearfix">
                        <div class="col-xs-12 form-horizontal">
                            <input type="hidden" value="0" class="layout_sel_widget_id" data-default="0">

                            <div id="layouts_widgets_container">
                                <div class="layout_widget_cont">
                                    <hr class="light">
                                    <div class="form-group form-group-md">
                                        <label class="col-sm-2 control-label"
                                               for="formGroupInputLarge">Email content</label>

                                        <div class="col-sm-10">
                                            <?php Yii::$app->getView()->registerJsFile("/backend/js/tinymce_plugin.js", ["depends" => "dosamigos\\tinymce\\TinyMceAsset"]); ?>
                                            <?php
                                            echo TinyMce::widget(['id' => 'status_change_email_content', 'name' => 'status_change_email_content', 'value' => 'gfdsgfdsgfd', 'options' => ['data-default' => 'gfdgfdsg', "data-wysiwyg" => '1', "style" => "height:200px"], 'clientOptions' => [
                                                'plugins' => [
                                                    'bb_media advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                                                    'insertdatetime media nonbreaking save table contextmenu directionality',
                                                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                                                ],
                                                'toolbar1' => "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image bb_media",
                                                'toolbar2' => "print preview media | forecolor backcolor",
                                                "content_css" => "/css/main.min.css"
                                            ]]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn green cs_email_save">Save</button>
                    </div>
                </div>
            </div>
        </div>


        <?php
        $result = ob_get_clean();


        foreach ($this->cs_types as $cs_type) {
            $this->attribute = $cs_type . '_cs_status';

            $result .= '<div class="cs-status-filter">' . Html::activeDropDownList($model, $this->attribute, $this->filter, array_merge(['data-type' => strtoupper($cs_type)], $options)) . '</div>';
        }


        return $result;

    }
}
