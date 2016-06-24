<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use common\components\LiveEdit;

$this->title = $name;
?>

<section>
    <section class="inner-wrapper container-lg">
        <div class="container">
            <h1 class="title text-featured"><?= $exception->statusCode == '404' ?  LiveEdit::text(__FILE__, 'Sorry... The page you are looking for has moved.') : Html::encode($this->title) ?></h1>
            <h2 class="caption text-primary2"><?= $exception->statusCode != '404' ? nl2br(Html::encode($message)) : LiveEdit::text(__FILE__, 'Please use the links below or contact customer support for additional assistance.') ?></h2>
            <p class="text-primary2">  <?php echo LiveEdit::text(__FILE__, 'You will be automatically redirected to the homepage in a few seconds.')?></p>
        </div>
    </section>
</section>
<script>
    setTimeout("window.location='/';", 13000);
</script>
