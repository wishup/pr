<?php

namespace common\components;
use dosamigos\tinymce\TinyMce;

abstract class Widget{

    /*
     * Example params function
     *
     * public function params(){

            $params = [
                [
                    "type" => "group",
                    "label" => "Group label",
                    "slug" => "group_slug",
                    "fields" => [
                        [
                            "slug" => "title",
                            "type" => "text",
                            "label" => "Title",
                            "default" => "Share",
                        ],
                        [
                            "slug" => "type",
                            "type" => "selectbox",
                            "label" => "Type",
                            "values" => [
                                "1" => "With Headings",
                                "2" => "With Quote",
                            ],
                            "default" => "1",
                        ],
                    ]
                ],
                [
                    "slug" => "url",
                    "type" => "text",
                    "label" => "URL",
                    "default" => "",
                ],
                [
                    "slug" => "description",
                    "type" => "textarea",
                    "label" => "Description",
                    "default" => "Example",
                    "wysiwyg" => true
                ],
                [
                    "slug" => "image",
                    "type" => "file",
                    "label" => "Image",
                    "default" => "",
                    "multiple" => true
                ],
                [
                    "slug" => "authed_users",
                    "type" => "checkbox",
                    "label" => "Authorized users",
                    "default" => "1",
                ],
                [
                    "slug" => "group",
                    "type" => "selectbox",
                    "label" => "Group",
                    "values" => [
                        "1" => "Group 1",
                        "2" => "Group 2",
                        "3" => "Group 3",
                        "4" => "Group 4",
                    ],
                    "default" => "2",
                ]
            ];

            return $params;

        }
     */
    abstract function params();

    public function render( $params ){

        $default_params = $this->params();

        foreach( $default_params as $dparam ){

            if( $dparam['type'] != 'group' && isset($dparam["slug"]) && !isset( $params[ $dparam["slug"] ] ) && isset( $dparam["default"] ) ){

                $params[ $dparam["slug"] ] = $dparam["default"];

            }

        }

        $controllerName = ucfirst( str_replace("_","",$this->viewFile) ).'Controller';
        $controllerClass = '\\frontend\\controllers\\widgets\\'.$controllerName;
        $controllerFile = \Yii::getAlias('@frontend').'/controllers/widgets/'.$controllerName.'.php';

        if( file_exists( $controllerFile ) ){

            $widgetController = new $controllerClass();

            $widgetController->init( $params );

        }

        return \Yii::$app->controller->renderPartial('@frontend/views/widgets/'.$this->viewFile, $params);

    }

    public static function drawParam( $param , $obj, $group = false ){

        switch ($param["type"]) {

            case 'group':

                ?>
                <div class="row">
                <?php

                foreach( $param["fields"] as $prm ){

                    ?>

                        <div class="col-sm-4 margin-bottom10">
                            <label><?= $prm["label"] ?></label>
                            <?php self::drawParam( $prm, $obj, $param["slug"] ); ?>
                        </div>

                    <?php

                }

                ?>
                </div>
                <?php

                break;

            case 'text':
                ?>
                <input class="form-control" name="<?= $group ? $group.'['.$param["slug"].'][]' : $param["slug"] ?>"
                       type="text" value="<?= $param["default"] ?>"
                       data-default="<?= $param["default"] ?>">
                <?php
                break;

            case 'textarea':

                if (!isset($param["wysiwyg"]) || $param["wysiwyg"] == false) {
                    ?>
                    <textarea class="form-control"
                              name="<?= $group ? $group.'['.$param["slug"].'][]' : $param["slug"] ?>"
                              data-default="<?= $param["default"] ?>"
                              rows="6"><?= $param["default"] ?></textarea>
                <?php
                } else {

                    $obj->registerJsFile("/backend/js/tinymce_plugin.js", ["depends"=>"dosamigos\\tinymce\\TinyMceAsset"]);

                    echo TinyMCE::widget(['name' => ( $group ? $group.'['.$param["slug"].'][]' : $param["slug"] ), 'value' => $param["default"], 'options' => ['data-default' => $param["default"], "data-wysiwyg" => '1', "style" => "height:200px"], 'clientOptions' => [
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

                }
                break;

            case 'file':
                ?>
                <input class="form-control" name="<?= $group ? $group.'['.$param["slug"].'][]' : $param["slug"] ?>"
                       type="file" <?= (isset($param["multiple"]) && $param["multiple"] == true) ? 'multiple' : '' ?>>
                <?php
                break;

            case 'checkbox':
                ?>
                <input class="form-control" name="<?= $group ? $group.'['.$param["slug"].'][]' : $param["slug"] ?>"
                       type="checkbox" value="<?= $param["default"] ?>"
                       data-default="<?= $param["default"] ?>"
                       <?php if ($param["default"] == 1){ ?>checked<?php } ?>>
                <?php
                break;

            case 'selectbox':
                ?>
                <select class="form-control" name="<?= $group ? $group.'['.$param["slug"].'][]' : $param["slug"] ?>"
                        data-default="<?= $param["default"] ?>">
                    <?php
                    foreach ($param["values"] as $ind => $val) {
                        ?>
                        <option
                            value="<?= $ind ?>" <?php if ($ind == $param["default"]) echo 'selected'; ?>><?= $val ?></option>
                    <?php
                    }
                    ?>
                </select>
                <?php
                break;

        }

    }

}