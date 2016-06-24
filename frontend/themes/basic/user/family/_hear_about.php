<?php
use common\components\LiveEdit;
?>
<section class="section">
    <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'How did you hear about us?') ?></h3>
    <?= $form->field($userinfomodel, 'hear_about_us', ["template" => "{input}{error}", "options" => ["tag" => "div", "class" => "form-group stay-edit text-left", "style" => "max-width:370px;margin:0 auto;"]])->dropDownList($hear_about, ["class" => "form-control custom-select hear_about_us_select"]) ?>
    <?= $form->field($userinfomodel, 'hear_about_us_other', ["template" => "{input}{error}", "options" => ["style" => "max-width:370px;margin:0 auto;", "class" => "field-userinfo-hear_about_us_other hear_about_us_other"]])->textInput(["placeholder" => "Other"]) ?>
</section>