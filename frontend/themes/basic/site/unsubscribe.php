<?php

use yii\helpers\Html;
use common\components\LiveEdit;
use \yii\widgets\ActiveForm;
?>
<div class="signin-block inner-wrapper container-lg text-center">
    <h2 class="title text-featured text-center"><?php echo LiveEdit::text(__FILE__, 'Email Unsubscribe')?></h2>
    <h3 class="caption text-primary2">
        <small>
        <?= LiveEdit::text(__FILE__, 'You are about to unsubscribe', 'div') ?> <span class="text-success"><?= htmlspecialchars(Yii::$app->request->get("email")) ?></span> <?= LiveEdit::text(__FILE__, 'from BibleBee mailing list.', 'div') ?>
        </small>
    </h3>
    <p >
        <?php echo LiveEdit::text(__FILE__, "It's important for us to know the reason")?>
    </p>
    <?php $form = ActiveForm::begin(); ?>

    <div class="row margin-top40">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="form-group">
                <?= Html::dropDownList("reason", [], $reasons, ["class" => "form-control"]) ?>
            </div>

            <div class="form-group">
                <?= Html::submitInput("Unsubscribe", ["class" => "btn btn-success"]) ?>
            </div>
        </div>
    </div>

    <?= Html::endForm() ?>

</div>