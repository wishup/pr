<?php
use common\components\LiveEdit;
?>
<section class="section mode-section edit-mode">
    <a href="" class="edit-btn toggle-mode hidden-edit"><i
            class="icon-edit"></i><?= LiveEdit::text(__FILE__, 'edit') ?></a>

    <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Contact Information') ?></h3>

    <p class="subtitle"><?= LiveEdit::text(__FILE__, 'This information is private and is provided to Bible Bee in order to contact you.') ?></p>

    <div class="form-part centered col-lg-11">
        <h5 class="group-label hidden-edit text-left renew_host_user_name"><?= $userinfomodel->first_name . ' ' . $userinfomodel->last_name ?></h5>
        <ul class="block-sm-2 clearfix text-left renew_host_info">
            <?= $form->field($userinfomodel, 'first_name', ["options" => ["tag" => "li", "class" => "form-group hidden-view"]])->textInput(["placeholder" => $userinfomodel->getAttributeLabel('first_name')])->label($userinfomodel->getAttributeLabel('first_name'), ["class" => "form-label"]) ?>

            <?= $form->field($userinfomodel, 'last_name', ["options" => ["tag" => "li", "class" => "form-group hidden-view"]])->textInput(["placeholder" => $userinfomodel->getAttributeLabel('last_name')])->label($userinfomodel->getAttributeLabel('last_name'), ["class" => "form-label"]) ?>
            <?= $form->field($model, 'spouse_first_name', ["options" => ["tag" => "li", "class" => "form-group hidden-view"]])->textInput(["placeholder" => $model->getAttributeLabel('spouse_first_name')])->label($model->getAttributeLabel('spouse_first_name'), ["class" => "form-label"]) ?>

            <?= $form->field($model, 'spouse_last_name', ["options" => ["tag" => "li", "class" => "form-group hidden-view"]])->textInput(["placeholder" => $model->getAttributeLabel('spouse_last_name')])->label($model->getAttributeLabel('spouse_last_name'), ["class" => "form-label"]) ?>

            <?= $form->field($userinfomodel, 'address_1', ["options" => ["tag" => "li", "class" => "form-group"]])->textInput(["placeholder" => $userinfomodel->getAttributeLabel('address_1')])->label($userinfomodel->getAttributeLabel('address_1'), ["class" => "form-label"]) ?>

            <?= $form->field($userinfomodel, 'address_2', ["options" => ["tag" => "li", "class" => "form-group"]])->textInput(["placeholder" => $userinfomodel->getAttributeLabel('address_2')])->label($userinfomodel->getAttributeLabel('address_2'), ["class" => "form-label"]) ?>

            <?= $form->field($userinfomodel, 'city', ["options" => ["tag" => "li", "class" => "form-group"]])->textInput(["placeholder" => $userinfomodel->getAttributeLabel('city')])->label($userinfomodel->getAttributeLabel('city'), ["class" => "form-label"]) ?>

            <?= $form->field($userinfomodel, 'state', ["template" => "{label}{input}{error}<span class='form-control hidden-edit renew_host_state_view'>" . ((isset(\Yii::$app->params["us_states"][$userinfomodel->state]) && $userinfomodel->state) ? \Yii::$app->params["us_states"][$userinfomodel->state] : '&nbsp;') . "</span>", "options" => ["tag" => "li", "class" => "form-group"]])->dropDownList(array_merge(['' => $userinfomodel->getAttributeLabel('state')], \Yii::$app->params["us_states"]), ["class" => "form-control custom-select-state hidden-view", "placeholder" => ""])->label($userinfomodel->getAttributeLabel('state'), ["class" => "form-label"]) ?>

            <?= $form->field($userinfomodel, 'zip', ["options" => ["tag" => "li", "class" => "form-group"]])->textInput(["placeholder" => $userinfomodel->getAttributeLabel('zip')])->label($userinfomodel->getAttributeLabel('zip'), ["class" => "form-label"]) ?>

            <li>
                <div class="row">
                    <?= $form->field($userinfomodel, 'cell_phone', ["options" => ["template" => "{input}{error}", "class" => "form-group col-md-6"]])->textInput(["placeholder" => $userinfomodel->getAttributeLabel('cell_phone'), "class" => "form-control phone_mask"])->label($userinfomodel->getAttributeLabel('cell_phone'), ["class" => "form-label"]) ?>
                    <?= $form->field($userinfomodel, 'phone', ["options" => ["template" => "{input}{error}", "class" => "form-group col-md-6"]])->textInput(["placeholder" => $userinfomodel->getAttributeLabel('phone'), "class" => "form-control phone_mask"])->label($userinfomodel->getAttributeLabel('phone'), ["class" => "form-label"]) ?>
                </div>
            </li>

        </ul>
    </div>
</section>