<?php
use \common\components\LiveEdit;
use \common\components\attachments;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
    <!-- Mt Contact Banner of the Page -->
    <section class="mt-contact-banner style4" style="background-image: url(/images/img11.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1><?= $post->name ?></h1>
                    <!--nav class="breadcrumbs">
                        <ul class="list-unstyled">
                            <li><a href="index.html">Home <i class="fa fa-angle-right"></i></a></li>
                            <li><a href="#">Blog <i class="fa fa-angle-right"></i></a></li>
                            <li>Category</li>
                        </ul>
                    </nav-->
                </div>
            </div>
            <!--div class="row">
                <div class="col-xs-12">
                    <a href="#" class="search">Search <i class="fa fa-search"></i></a>
                </div>
            </div-->
        </div>
    </section>
    <!-- Mt Contact Banner of the Page end -->

    <!-- Mt Blog Detail of the Page -->
    <div class="mt-blog-detail style1">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8">
                    <!-- Blog Post of the Page -->
                    <article class="blog-post detail wow fadeInUp" data-wow-delay="0.4s">
                        <div class="img-holder">
                            <img src="<?= attachments::getThumbnailUrl('/upload/' . $post->image, 790, 378, 'CROP') ?>" alt="">
                        </div>
                        <time class="time" datetime="2016-02-03 20:00"><strong><?= date("d", strtotime($post->date)) ?></strong><?= date("M", strtotime($post->date)) ?></time>
                        <div class="blog-txt">
                            <h2><?= LiveEdit::field( $post->name, "\\common\\models\\Posts", $post->id, "name" ) ?></h2>
                            <ul class="list-unstyled blog-nav">
                                <li> <i class="fa fa-clock-o"></i><?= date("d M Y", strtotime($post->date)) ?></li>
                                <li> <i class="fa fa-comment"></i><?= $post->commentscount ?> Comments</li>
                            </ul>
                            <?= LiveEdit::field( $post->content, "\\common\\models\\Posts", $post->id, "content", "wysiwyg" ) ?>
                        </div>
                    </article>
                    <!-- Blog Post of the Page end -->
                    <!-- Mt Author Box of the Page -->
                    <!-- Mt Author Box of the Page end -->
                    <!-- Mt Comments Section of the Page -->
                    <div class="mt-comments-section">
                        <?php
                        if( $post->comments ) {
                            ?>
                            <div class="mt-comments-heading">
                                <h2><?= LiveEdit::text(__FILE__, "COMMENTS") ?></h2>
                            </div>
                            <ul class="list-unstyled">
                                <?php
                                $comments = $post->comments;

                                foreach ($comments as $comment) {
                                    ?>
                                    <li>
                                        <div class="txt">
                                            <h3><?= LiveEdit::field($comment->name, "\\common\\models\\PostComments", $post->id, "name") ?></h3>
                                            <time class="mt-time"
                                                  datetime="2016-02-03 20:00"><?= date("d M, Y", strtotime($comment->date)) ?></time>
                                            <p><?= LiveEdit::field($comment->comment, "\\common\\models\\PostComments", $post->id, "comment") ?></p>
                                        </div>
                                    </li>
                                    <?php
                                    if ($comment->answer) {
                                        ?>
                                        <li class="second-comment">
                                            <div class="txt">
                                                <h3><?= LiveEdit::text(__FILE__, "Answer") ?></h3>

                                                <p><?= LiveEdit::field($comment->answer, "\\common\\models\\PostComments", $post->id, "answer") ?></p>
                                            </div>
                                        </li>
                                    <?php
                                    }
                                }
                                ?>
                            </ul>
                        <?php
                        }
                        ?>
                        <!-- Mt Leave Comments of the Page -->
                        <div class="mt-leave-comment">
                            <a name="comment-form"></a>
                            <h2>LEAVE A COMMENT</h2>
                            <?php
                            if( $message ){
                                ?>
                                <p style="color:#009900">
                                    Your comment was submited. It will be published by our administrators.
                                </p>
                                <?php
                            }
                            ?>
                            <?php $form = ActiveForm::begin(['action' => '#comment-form','enableClientValidation' => true, 'options' => [ 'class'=> 'comment-form']]); ?>
                                <fieldset>
                                        <?= $form->field($commentmodel, 'name')->textInput(["placeholder" => "Name"])->label(false) ?>
                                        <?= $form->field($commentmodel, 'email')->textInput(["placeholder" => "Email"])->label(false) ?>
                                        <?= $form->field($commentmodel, 'comment')->textarea(["placeholder" => "Message ...", "class" => ""])->label(false) ?>
                                    <input type="submit" class="form-btn" value="Submit">
                                </fieldset>
                            <?php ActiveForm::end(); ?>
                        </div>
                        <!-- Mt Leave Comments of the Page end -->
                    </div>
                    <!-- Mt Comments Section of the Page end -->
                </div>
                <?= $this->render("sidebar") ?>
            </div>
        </div>
    </div>
    <!-- Mt Blog Detail of the Page end -->
