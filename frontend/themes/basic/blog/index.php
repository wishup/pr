<?php
use \common\components\LiveEdit;
use \common\components\attachments;
?>
    <!-- Mt Contact Banner of the Page -->
    <section class="mt-contact-banner style4 wow fadeInUp" data-wow-delay="0.4s" style="background-image: url(/images/img11.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1><?= LiveEdit::text(__FILE__, 'Blog') ?></h1>
                    <!-- Breadcrumbs of the Page -->
                    <!--nav class="breadcrumbs">
                        <ul class="list-unstyled">
                            <li><a href="index.html">Home <i class="fa fa-angle-right"></i></a></li>
                            <li><a href="#">Blog <i class="fa fa-angle-right"></i></a></li>
                            <li>Category</li>
                        </ul>
                    </nav-->
                    <!-- Breadcrumbs of the Page end -->
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
                <div class="col-xs-12 col-sm-8 wow fadeInUp" data-wow-delay="0.4s">

                    <?php

                    if( $posts ){

                        foreach( $posts as $post ){

                            ?>
                            <!-- Blog Post of the Page -->
                            <article class="blog-post style2">
                                <div class="img-holder">
                                    <?php
                                    if( $post->image ) {
                                        ?>
                                        <a href="/blog/post/<?= $post->id ?>"><img
                                                src="<?= attachments::getThumbnailUrl('/upload/' . $post->image, 277, 168, 'AUTO') ?>"
                                                alt=""></a>
                                        <?php
                                    }
                                    ?>
                                    <ul class="list-unstyled comment-nav">
                                        <li><a href="/blog/post/<?= $post->id ?>#comment"><i class="fa fa-comments"></i><?= $post->commentscount ?></a></li>
                                    </ul>
                                </div>
                                <div class="blog-txt">
                                    <h2><a href="/blog/post/<?= $post->id ?>"><?= LiveEdit::field( $post->name, "\\common\\models\\Posts", $post->id, "name" ) ?></a></h2>
                                    <ul class="list-unstyled blog-nav">
                                        <li> <a href="/blog/post/<?= $post->id ?>"><i class="fa fa-clock-o"></i><?= date("d M Y", strtotime($post->date)) ?></a></li>
                                        <li> <a href="/blog/post/<?= $post->id ?>#comment"><i class="fa fa-comment"></i><?= $post->commentscount ?> Comments</a></li>
                                    </ul>
                                    <p><?= LiveEdit::field( $post->short_content, "\\common\\models\\Posts", $post->id, "short_content" ) ?></p>
                                    <a href="/blog/post/<?= $post->id ?>" class="btn-more"><?= LiveEdit::text(__FILE__, 'Read More') ?></a>
                                </div>
                            </article>
                            <!-- Blog Post of the Page end -->
                            <?php

                        }

                    }

                    if( $pages_count > 1 ) {

                        ?>

                        <!-- Btn Holder of the Page -->
                        <div class="btn-holder">
                            <ul class="list-unstyled pagination">
                                <?php
                                for ($p = 1; $p <= $pages_count; $p++) {
                                    ?>
                                    <li <?= $p == $current_page ? 'class="active"' : '' ?>><a
                                            href="/blog?p=<?= $p ?>"><?= $p ?></a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    <?php
                    }
                    ?>
                    <!-- Btn Holder of the Page end -->
                </div>
                <?= $this->render("sidebar") ?>
            </div>
        </div>
    </div>
    <!-- Mt Blog Detail of the Page end -->