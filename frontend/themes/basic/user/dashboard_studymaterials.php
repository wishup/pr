<?php
use common\components\LiveEdit;
?>
<section class="main gen-box container-lg">
    <div class="account-primary">
    <?= $this->render("//elements/dashboard_head", [
        "infomodel" => $infomodel,
        "hostmodel" => $hostmodel,
        "usermodel" => $usermodel,
        "bgcheckmodel" => $bgcheckmodel,
        "family" => $family
    ]) ?>

    <?= LiveEdit::text(__FILE__, 'Coming soon', 'div', 'wysiwyg') ?>

    </div>
</section>