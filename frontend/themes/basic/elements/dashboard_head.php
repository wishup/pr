<?php
use common\components\LiveEdit;
use common\components\attachments;
?>
<div class="account-media media panel-light">
    <ul class="account-controls">
        <!--<li class="account-control"><i class="icon-profile"></i><span><a href="">View Public Profile</a></span></li>-->
        <li class="account-control"><i class="icon-edit"></i><a href="" class="edit_contact_info">edit</a></li>
    </ul>
    <div class="media-left avatar_chng_img">

        <div id="spinner"  class="spinner">
            <div class="spinner-obj sk-circle">
                <div class="sk-circle1 sk-child"></div>
                <div class="sk-circle2 sk-child"></div>
                <div class="sk-circle3 sk-child"></div>
                <div class="sk-circle4 sk-child"></div>
                <div class="sk-circle5 sk-child"></div>
                <div class="sk-circle6 sk-child"></div>
                <div class="sk-circle7 sk-child"></div>
                <div class="sk-circle8 sk-child"></div>
                <div class="sk-circle9 sk-child"></div>
                <div class="sk-circle10 sk-child"></div>
                <div class="sk-circle11 sk-child"></div>
                <div class="sk-circle12 sk-child"></div>
            </div>
        </div>

        <a href="" class="media-control avatar_change_image"><i class="icon-edit "></i> edit</a>
        <img style="cursor:pointer" class="media-object avatar_change_image " src="<?= $infomodel->avatar ? attachments::getThumbnailUrl( '/upload/avatar/'.$infomodel->user_id.'/'.$infomodel->avatar, 100, 95, 'CROP' ) : '/images/avatar.jpg' ?>" alt="..." width="100" height="95">
        <form action="/user/changeavatar" id="avatar_change_form">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
            <input type="file" name="UserInfo[avatar]" id="avatar_image" style="display:none" />
        </form>
    </div>
    <div class="media-body">
        <div class="media-heading clearfix">
            <h3 class="title -md text-primary"><?= $infomodel->first_name.' '.$infomodel->last_name ?></h3>
            <ul class="reward-list">
                <!--  <li>
                      <img class="media-object" src="/images/reward1.png" alt="...">
                      <span>National Bible Bee Competitor - 2016</span>
                  </li>-->
                <?php
                if( !$hostmodel->isNewRecord ) {
                    ?>
                    <li>
                        <img class="media-object" src="/images/reward2.png" alt="...">
                        <span>National Bible Bee Host - 2016</span>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
        <ul class="account-info">
            <?php
            $addr = [];
            if( $infomodel->city ) $addr[] = $infomodel->city;
            if( $infomodel->state && isset( \Yii::$app->params["us_states"][$infomodel->state] ) ) $addr[] = \Yii::$app->params["us_states"][$infomodel->state];
            if( $infomodel->zip ) $addr[] = $infomodel->zip;

            $addr = implode(", ", $addr);
            ?>
            <?php if( $addr ){ ?><li><i class="icon-location"></i><span><?= $addr ?></span></li><?php } ?>
            <?php if( $usermodel->email ){ ?><li><i class="icon-email"></i><a href=""><?= $usermodel->email ?></a></li><?php } ?>
            <?php if( $infomodel->phone ){ ?><li><i class="icon-phone"></i><a href="tel:<?= $infomodel->phone ?>"><?= $infomodel->phone ?></a></li><?php } ?>
        </ul>
        <?php
        if( $bgcheckmodel->status == 'approved' ) {
            ?>
            <div class="media-aside text-center pull-right">
                Background Check Completed:<br>
                <strong><?= $bgcheckmodel->approved_at ?></strong>
            </div>
        <?php
        }
        ?>
    </div>
    <!--<a href="" class="account-more icon-arrow-down"></a>-->
</div>

<?php
if( !$hostmodel->isNewRecord ){
    $communityurl = 'https://plus.google.com/communities/109357367166452380844';
} else {
    if( $family ){
        $communityurl = 'https://plus.google.com/u/0/communities/107645641301522450881';
    } else {
        $communityurl = '';
    }
}
?>

<!-- Dashboard menu -->
<div class="account-media media panel-light">
    <ul class="dashboard-head-nav clearfix">
        <li><a href="/dashboard"><img src="/images/icon-home.png" alt=""><span>Dashboard Home</span></a></li>
        <?php if( $communityurl != '' ){ ?><li><a href="<?= $communityurl ?>" target="_blank"><img src="/images/icon-cumunity.png" alt=""><span>Community</span></a></li><?php } ?>
        <?php
        if( !$hostmodel->isNewRecord ){
            ?>
            <li><a href="/user/dashboard-family-host"><img src="/images/icon-host.png"
                                                           alt=""><span>Host Map</span></a></li>
        <?php
        } else {
            if ($family) {
                ?>
                <li><a href="/user/dashboard-family-host"><img src="/images/icon-host.png"
                                                               alt=""><span>Your Host</span></a></li>
            <?php
            }
        }

        if( !$hostmodel->isNewRecord ){
            ?>
            <li><a href="/user/dashboard-resources"><img src="/images/icon-resources.png" style="height:50px;" alt=""><span>Host Resources</span></a></li>
        <?php
        }

        if( $family ){

            ?>
            <li><a href="/user/dashboard-resources-family"><img src="/images/icon-resources-family.png" style="height:50px;" alt=""><span>Resources</span></a></li>
        <?php
        }
        ?>
    </ul>
</div>
<!-- Dashboard menu -->




