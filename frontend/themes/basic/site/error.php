<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use common\components\LiveEdit;

$this->title = $name;
?>

<section class="mt-contact-banner wow fadeInUp" data-wow-delay="0.4s" style="background-image: url(/images/img43.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1><?= \common\components\LiveEdit::text( __FILE__, "404" ) ?></h1>
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
                    <p><?= \common\components\LiveEdit::text( __FILE__, "Sorry, the page was not found" ) ?></p>

            </div>
        </div>
    </div>
</section>
