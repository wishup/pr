<?php
use common\components\LiveEdit;
?>

<div class="gen-box inner-wrapper container-lg family-reg-form">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2 class="title text-featured sep-bottom text-center"><?= LiveEdit::text(__FILE__, 'Thank you supporting The National Bible Bee!') ?></h2>
        </div>
    </div>
</div><!-- /end .gen-box -->
<script type="text/javascript">
    // CompleteRegistration
    // Track when a registration form is completed (ex. complete subscription, sign up for a service)
    fbq('track', 'PublicDonation');
</script>