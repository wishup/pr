<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\LiveEdit;

?>

<?php


$cart = Yii::$app->session->get('family_cart');
$cart['children'][$index] = array('name' => $model->first_name, 'age_group' => $model->age_group);
Yii::$app->session->set('family_cart', $cart);

?>

<?php

$create_form = false;
if (!isset($form)) {
    $create_form = true;
}

if ($create_form) {
    ob_start();
    $form = ActiveForm::begin();
    ob_get_clean();
} ?>

<div class="contestant-form">
    <ul class="block-sm-2 clearfix text-left child-container child-container-<?php echo $index; ?>">

        <?= $form->field($model, '[' . $index . ']first_name', ["options" => ["tag" => "li", "class" => "form-group hidden-view"]])->textInput(["placeholder" => $model->getAttributeLabel('first_name'), 'class' => 'first_name form-control', 'data-index' => $index])->label($model->getAttributeLabel('first_name'), ["class" => "form-label"]) ?>

        <?= $form->field($model, '[' . $index . ']last_name', ["options" => ["tag" => "li", "class" => "form-group hidden-view"]])->textInput(["placeholder" => $model->getAttributeLabel('last_name'), 'class' => 'form-control'])->label($model->getAttributeLabel('last_name'), ["class" => "form-label"]) ?>

        <?= $form->field($model, '[' . $index . ']date_of_birth', ['template' => '{label}{input}{error}<div class="alert-block"></div>', "options" => ["tag" => "li", "class" => "form-group hidden-view"]])->textInput(["placeholder" => 'Date of Birth mm/dd/yy', 'class' => 'form-control date_mask_child', 'data-index' => $index])->label($model->getAttributeLabel('date_of_birth'), ["class" => "form-label"]) ?>

        <?= Html::hiddenInput('Contestants[' . $index . '][age_group]', "", ['class' => 'contestant_agegroup', 'data-index' => $index]) ?>

        <li>
            <div class="row">
                <?php $genders = Yii::$app->params["gender"]; ?>
                <?= $form->field($model, '[' . $index . ']gender', ["template" => "{input}{error}", "options" => ["tag" => "div", "class" => "form-group col-md-6"]])->dropDownList($genders, ["class" => "form-control custom-select hidden-view"]) ?>

                <?php $versions = Yii::$app->params["versions"]; ?>
                <?= $form->field($model, '[' . $index . ']version', ["template" => "{input}{error}", "options" => ["tag" => "div", "class" => "form-group col-md-6"]])->dropDownList($versions, ["class" => "form-control custom-select hidden-view"]) ?>

            </div>
        </li>
    </ul>
    <div class="remove-item">
        <?php echo Html::button('<i class="icon icon-close"></i>Delete', array('onclick' => 'deleteChild(this, ' . $index . '); return false;', 'type' => "click")); ?>
    </div>

    <div class="contestant-print">
        <label class="form-control-checkbox">
            <input type="checkbox" name="Contestants[<?php echo $index; ?>][journal]" <?php echo $model->journal?"checked":""; ?> value="1"><span
                class="form-checkbox"></span>
            <?= LiveEdit::text(__FILE__, 'I would like to reserve a printed edition of the Discovery Journal at the one-time special rate of <strong>$14.99</strong>') ?>
        </label>
    </div>


    <?php if (isset($include_js) and $include_js) { ?>

        <script type="text/javascript">

            jQuery("#family-registration-form").yiiActiveForm("add", {
                "id": "contestants-<?php  echo $index ;?>-first_name",
                "name": "[<?php  echo $index ;?>]first_name",
                "container": ".field-contestants-<?php  echo $index ;?>-first_name",
                "input": "#contestants-<?php  echo $index ;?>-first_name",
                "validate": function (attribute, value, messages, deferred, $form) {
                    yii.validation.required(value, messages, {"message": "First Name cannot be blank."});
                    yii.validation.string(value, messages, {
                        "message": "First Name must be a string.",
                        "max": 100,
                        "tooLong": "First Name should contain at most 100 characters.",
                        "skipOnEmpty": 1
                    })
                }
            });

            jQuery("#family-registration-form").yiiActiveForm("add", {
                "id": "contestants-<?php  echo $index ;?>-last_name",
                "name": "[<?php  echo $index ;?>]last_name",
                "container": ".field-contestants-<?php  echo $index ;?>-last_name",
                "input": "#contestants-<?php  echo $index ;?>-last_name",
                "validate": function (attribute, value, messages, deferred, $form) {
                    yii.validation.required(value, messages, {"message": "Last Name cannot be blank."});
                    yii.validation.string(value, messages, {
                        "message": "Last Name must be a string.",
                        "max": 100,
                        "tooLong": "Last Name should contain at most 100 characters.",
                        "skipOnEmpty": 1
                    });
                }
            });

            jQuery("#family-registration-form").yiiActiveForm("add", {
                "id": "contestants-<?php  echo $index ;?>-date_of_birth",
                "name": "[<?php  echo $index ;?>]date_of_birth",
                "container": ".field-contestants-<?php  echo $index ;?>-date_of_birth",
                "input": "#contestants-<?php  echo $index ;?>-date_of_birth",
                "validate": function (attribute, value, messages, deferred, $form) {
                    yii.validation.required(value, messages, {"message": "Date Of Birth cannot be blank."});
                }
            });
            jQuery("#family-registration-form").yiiActiveForm("add", {
                "id": "contestants-<?php  echo $index ;?>-gender",
                "name": "[<?php  echo $index ;?>]gender",
                "container": ".field-contestants-<?php  echo $index ;?>-gender",
                "input": "#contestants-<?php  echo $index ;?>-gender",
                "validate": function (attribute, value, messages, deferred, $form) {
                    yii.validation.required(value, messages, {"message": "Gender cannot be blank."});
                    yii.validation.number(value, messages, {
                        "pattern": /^\s*[+-]?\d+\s*$/,
                        "message": "Gender must be an integer.",
                        "skipOnEmpty": 1
                    });
                }
            });

            jQuery("#family-registration-form").yiiActiveForm("add", {
                "id": "contestants-<?php  echo $index ;?>-version",
                "name": "[<?php  echo $index ;?>]version",
                "container": ".field-contestants-<?php  echo $index ;?>-version",
                "input": "#contestants-<?php  echo $index ;?>-version",
                "validate": function (attribute, value, messages, deferred, $form) {
                    yii.validation.required(value, messages, {"message": "Version cannot be blank."});
                    yii.validation.number(value, messages, {
                        "pattern": /^\s*[+-]?\d+\s*$/,
                        "message": "Version must be an integer.",
                        "skipOnEmpty": 1
                    });
                }
            });

        </script>
    <?php } ?>
</div>