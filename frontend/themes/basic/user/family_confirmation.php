<?php
use common\components\LiveEdit;
?>

<div class="gen-box inner-wrapper container-lg family-reg-form">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2 class="title text-featured sep-bottom text-center"><?= LiveEdit::text(__FILE__, 'Thank you registering for the 2016 National Bible Bee!') ?></h2>

            <div class="btn-group-ty">
                <div class="row">
                    <div class="col-md-4 col-md-offset-2 col-sm-5 col-sm-offset-1 text-center">
                        <div class="btn-box-ty">
                            <h3><?= LiveEdit::text(__FILE__, 'Visit your') ?></h3>
                            <a href="<?php echo $dashboard_url; ?>" class="btn btn-lg btn-primary">
                                <span><?= LiveEdit::text(__FILE__, 'Dashboard') ?></span> <i class="icon-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-5 text-center">
                        <div class="btn-box-ty">
                            <h3><?= LiveEdit::text(__FILE__, 'Join the community at') ?></h3>
                            <div class="gplus-item soc-item">
                                <a href="<?php echo $google_community_url ?>" class="login-btn btn" target="_blank">
                                    <i class="icon-google-plus"></i>
                                    <span><strong><?= LiveEdit::text(__FILE__, 'Google Group') ?></strong></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= LiveEdit::text(__FILE__, '<h3 class="caption text-primary2 text-center">Here are your 3 next steps:</h3>
            <ol class="num-list">
                <li><span class="num-list-index">1</span> Login to your <a href="'.$dashboard_url.'">dashboard</a> as features and incentives are released beginning on June 6.</li>
                <li><span class="num-list-index">2</span> Create a Google+ account (if you do not already have a gmail account). <a target="_blank" href="'.$instruction_url.'">Instructions Here</a>.</li>
                <li><span class="num-list-index">3</span> Join <a target="_blank" href="'.$google_community_url.'">The Official National Bible Bee Contestant Community on Google+</a> where you can interact with other contestants online.</li>
            </ol>') ?>
            <br/><br/>
        </div>
    </div>
</div><!-- /end .gen-box -->
<script type="text/javascript">
    // CompleteRegistration
    // Track when a registration form is completed (ex. complete subscription, sign up for a service)
    fbq('track', 'CompleteRegistration');
</script>