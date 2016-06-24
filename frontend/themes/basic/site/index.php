
<ul class="quick-links hidden-small">
    <li>
        <a href="">
            <i class="icon-info"></i>
            <strong>Learn</strong>
            <span>More</span>
        </a>
    </li>
    <li>
        <a href="">
            <i class="icon-flag"></i>
            <strong>Start</strong>
            <span>Now</span>
        </a>
    </li>
    <li>
        <a href="">
            <i class="icon-help"></i>
            <strong>Ask</strong>
            <span>question</span>
        </a>
    </li>
</ul>
<section class="main">
    <section id="intro" class="intro" data-delay="0">
        <div id="bgVideo" class="bg-video">
            <video id="video_background" preload="auto" loop="loop" autoplay="autoplay" > <!--poster="images/main_poster.jpg"-->
                <source src="/video/Cross_Dissolve.mp4" type="video/mp4">
                <source src="/video/Cross_Dissolve.ogv" type="video/ogg">
                <source src="/video/Cross_Dissolve.webm" type="video/webm">
            </video>
        </div>
        <section class="intro-cont">
            <div class="container">
                <h2 class="intro-title">
                    A generation transformed through study and memorization of scripture, prayer and an active relationship with Jesus
                </h2>
                <h3 class="intro-subtitle">A Free Study of the Word</h3>
                <?php
                if( !$user_id = \common\models\Users::user_id() ) {
                    ?>
                    <form class="get-started-form form-inline">
                        <div class="form-group get_started_container">
                            <label class="sr-only" for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control input-lg get_started_email" id="exampleInputEmail1"
                                   placeholder="eMail@address.com">
                        </div>
                        <a href="#" type="submit" class="intro-btn btn btn-warning btn-lg get_started_form_btn">Get Started
                            for Free</a>
                    </form>
                <?php
                }
                ?>
            </div>
        </section>
    </section>
</section>
