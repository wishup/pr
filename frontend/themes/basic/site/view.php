<?php
use yii\helpers\Html;
use yii\web\Session;

$this->params['breadcrumbs'][] = $this->title;

$session = new Session;
$session->open();
?>
<section class="mt-contact-banner wow fadeInUp" data-wow-delay="0.4s" style="background-image: url(/images/img43.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1><?php if( $page->header != '' ){ ?><h1><?= \common\components\LiveEdit::field( $page->header, "\\common\\models\\Pages", $page->id, "header" ) ?></h1><?php } ?></h1>
                <!-- nav class="breadcrumbs">
                    <ul class="list-unstyled">
                        <li><a href="index.html">home <i class="fa fa-angle-right"></i></a></li>
                        <li>About Us</li>
                    </ul>
                </nav -->
            </div>
        </div>
    </div>
</section>
<section class="mt-about-sec">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php
                if($page->status == 'private' && (!isset($session['page_id']) || !in_array($page->id,$session['page_id']))){
                    echo $this->render('../elements/passwordform');
                }else {
                    ?>
                    <p><?= \common\components\LiveEdit::field( $page->content, "\\common\\models\\Pages", $page->id, "content", "wysiwyg" ) ?></p>
                    <?php
                }
                ?>

            </div>
        </div>
    </div>
</section>