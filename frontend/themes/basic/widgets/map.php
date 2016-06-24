<?php
use yii\helpers\Html;
use common\components\LiveEdit;

$this->registerJsFile("https://maps.googleapis.com/maps/api/js?key=AIzaSyCneApY3Tw32l2Nl60P_wP1WxXMH5E1aDs&sensor=false");
$this->registerJsFile("/widgets/map/js/raphael.js", ["depends"=>['yii\web\JqueryAsset']]);
$this->registerJsFile("/widgets/map/js/jquery.mousewheel.js", ["depends"=>['yii\web\JqueryAsset']]);
$this->registerJsFile("/widgets/map/js/mapsvg.js", ["depends"=>['yii\web\JqueryAsset']]);
$this->registerJsFile("/widgets/map/js/map.js", ["depends"=>['yii\web\JqueryAsset']]);

if( !isset($join_enable) ){
    $join_enable = true;
}

switch( $type ){

    case 'hosts_map':

        $season = \common\models\Seasons::getCurrent();

        $hosts = \common\models\UsersHosts::find()->where("(`status`=1 OR `status`=2) AND `user_id` IN (SELECT `dynamic_id` FROM `users_id` WHERE `season_id`=".$season->id.") AND `latitude`!='' AND `longitude`!=''")->all();

        $data = [
           
        ];

        foreach( $hosts as $host ){

            $user_info = \common\models\UserInfo::find()->where("user_id=". $host->user->user_id)->one();

            $user = \common\models\Users::find()->where("id=". $host->user->user_id)->one();

            $hostcount = $host->hostcount;

            if( $host->status == 1 ) {

                if ($hostcount["count"] != -1 && $hostcount["count"] <= $hostcount["used"]) {
                    $mapicon = 'local'; // full
                    $canjoin = 0;
                } else {
                    $mapicon = 'local';
                    $canjoin = 1;
                }

            } else {

                $mapicon = 'inactive';
                $canjoin = 0;

            }

            if( $hostcount["count"] == -1 ){
                $spottext = '<br>Unlimited spots';
            } else {
                if( $hostcount["count"] > $hostcount["used"] ){
                    $spottext = '<br>'.( $hostcount["count"] - $hostcount["used"] ).' spots remaining';
                } else {
                    $spottext = '';
                }
            }

            $citystate = '<br>';
            if( $host->summer_event_city == '' || $host->summer_event_state == '' ){
                $citystate .= $user_info->city.', '.$user_info->state;
            } else {
                $citystate .= $host->summer_event_city.', '.$host->summer_event_state;
            }

            $data[] = [
                "lat" => $host->latitude,
                "lng" => $host->longitude,
                "html" => ( $host->summer_event_location ? '<b>'.$host->summer_event_location.'</b><br>' : '' ).'<b>'.$user_info->first_name.' '.$user_info->last_name.'</b><br>'.$host->summer_event_address.$citystate.$spottext.( ($canjoin && $disable_join == 0) ? '<br><br><a href="#" class="btn btn-success join_host_to_family '.( $join_enable ? '' : 'cant_join_another_host' ).'" data-host-id="'.$host->id.'">JOIN NOW</a>' : '' ),
                "icon" => "/widgets/map/icons/".$mapicon.".png",
                "location" => $host->summer_event_address,
                "location_name" => $host->summer_event_location,
                "host" => $user_info->first_name.' '.$user_info->last_name,
                "email" => $user->email,
                "host_id" => $host->id,
                "canjoin" => ($canjoin && $disable_join == 0) ? 1 : 0,
            ];

        }

        break;

}

$rand_id = md5(time().rand(0,10000));
?>
<script>
    var disable_join = <?= $disable_join ?>;
    if (typeof map_data == 'undefined')
        map_data = new Array();

    map_data['<?= $rand_id ?>'] = new Array();

    <?php
    foreach( $data as $index=>$marker ){
        ?>
        map_data['<?= $rand_id ?>'][<?= $index ?>] = new Array();
        <?php
        foreach( $marker as $marker_index=>$marker_value ){
            ?>
            map_data['<?= $rand_id ?>'][<?= $index ?>]['<?= $marker_index ?>'] = '<?= $marker_value ?>';
            <?php
        }
    }
    ?>
</script>

<?php

$family_host = false;

if( $user_id = \common\models\Users::user_id() ) {
    $user_dyn_id = \common\models\Users::getUserID($user_id);

    if ($family = \common\models\UsersFamilies::find()->where("user_id=" . $user_dyn_id . " AND status=1")->one()) {

        if ($family_host = \common\models\FamilyHost::find()->where("family_id=" . $family->id)->one()) {

            $family_host_info = \common\models\UsersHosts::find()->where("id=" . $family_host->host_id)->one();

            $family_host_user_info = \common\models\UserInfo::find()->where("user_id=" . $family_host_info->user->user_id)->one();

            $family_host_user = \common\models\Users::find()->where("id=" . $family_host_info->user->user_id)->one();

        }

    } else {

        if( $family_host_info = \common\models\UsersHosts::find()->where("user_id=" . $user_dyn_id . " AND ( status=1 or status=2)")->one() ){

            $family_host = true;

            $family_host_user_info = \common\models\UserInfo::find()->where("user_id=" . $family_host_info->user->user_id)->one();

            $family_host_user = \common\models\Users::find()->where("id=" . $family_host_info->user->user_id)->one();

        }

    }
}
?>
<script>
    var logged_in_host = <?= $user_id ? 1 : 0 ?>;
</script>


    <div class="widget-map widget-map-<?php echo $design; ?>">
        <div class="widget-container">
        <?php
        if( $design == 'public' ) {
            /*  Public header, /map page */
            ?>			
			<!--div class="widget-top clearfix">
				<h1 class="title text-featured">FIND A LOCAL HOST</h1>
				<a href="https://www.biblebee.org/host" class="btn btn-lg btn-primary pull-right">
					<span>Register Here</span>
					<i class="icon-arrow-right" aria-hidden="true"></i>
				</a>
				<p class="caption text-primary">Can't find a local host? Become one.</p>
			</div -->

				<div class="widget-head">
					<h2 class="title text-featured"><?= LiveEdit::text(__FILE__, 'Connect with your Local Host') ?></h2>
					<p><?= LiveEdit::text(__FILE__, 'Connecting with a local host has countless benefits. Connect today and open the door to prayer support, new friends, community learning, and much more.') ?></p>
				</div>
            <?php
        } else {
            /* Dashboard page header */
            ?>
				<div class="widget-head">
					<h2 class="title text-featured"><?= LiveEdit::text(__FILE__, 'Connect with your Local Host') ?></h2>
					<p><?= LiveEdit::text(__FILE__, 'Connecting with a local host has countless benefits. Connect today and open the door to prayer support, new friends, community learning, and much more.') ?></p>
				</div>
            <?php
        }
        ?>

        <?php
        if( $family_host ){

            $citystate = '';
            if( $family_host_info->summer_event_city == '' || $family_host_info->summer_event_state == '' ){
                $citystate .= $family_host_user_info->city.', '.$family_host_user_info->state;
            } else {
                $citystate .= $family_host_info->summer_event_city.', '.$family_host_info->summer_event_state;
            }

            ?>
                <div class="panel-box map-current-host">
                    <div class="panel-head">
                        <h3 class="title -md text-featured text-left">
                            <?= LiveEdit::text(__FILE__, 'Your current Host is') ?>
                            <?= $join_enable ? Html::a("Disconnect", "#", ["class" => "btn btn-info pull-right openDisconnectPopup"]) : '' ?>
                        </h3>
                    </div><!-- .panel-head -->

                    <div class="panel-cont">
                        <div class="data-list">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="data-list-item primary"><?= $family_host_user_info->first_name.' '.$family_host_user_info->last_name; ?></div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="data-list-item"><span class="data-list-name"><?= $family_host_user_info->phone!='' ? $family_host_user_info->phone : '&nbsp;' ?></span></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="data-list-item"><span class="data-list-name"><?= $family_host_info->summer_event_address.( $family_host_info->summer_event_address != '' && $citystate!='' ? '<br>' : '' ).$citystate ?></span></div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="data-list-item"><span class="data-list-name"><?= $family_host_user->email!='' ? $family_host_user->email : '&nbsp;' ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div><!-- .panel-cont -->
                </div><!-- .panel-box -->
                    <div id="disconnectPopup" class="popup-block main-box text-center popup-step3 getstarted-popup popup-has-close mfp-hide">
                        <h3 class="heading-xs color-primary2 text-uppercase"><?php echo LiveEdit::text(__FILE__, 'Are you sure you want to disconnect from Host?')?></h3>
                        <hr class="line-xs">
                        <p class="mg-top-20">
                            <?= Html::a("Cancel", "#", ["class"=>"btn btn-brd-success closeDisconnectPopup"]) ?>
                            <?= Html::a("Disconnect", "/user/disconnectfromhost", ["class"=>"btn btn-info"]) ?>
                        </p>
                    </div>
       <?php
            }
            ?>

            <div class="panel-box map-local-host map_start_div">
                <div class="panel-head">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h3 class="title -sm text-primary"><?= LiveEdit::text(__FILE__, 'Enter your zip code to find a local host.') ?></h3>
                        </div>

                        <div class="col-sm-6 text-right">
                            <div class="form-inline">
                                <div class="form-group">
                                    <div class="input-group">
                                        <?= Html::textInput("","",["placeholder" => "Zipcode", "class" => "form-control hosts_zipcode"]) ?>
                                        <a class="input-group-addon find_hosts">Find Host <span class="icon icon-glass"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .panel-head -->

                <div class="panel-cont">

                    <div id="map-nav">
                        <div class="map-nav-option">
                            <strong class="nav-text">Show:</strong>
                            <span class="nav-value" data-value="all">All US</span>
                            <i class="icon icon-arrow-down"></i>
                        </div>

                        <ul class="map-nav-list">
                            <li data-value="continental">Continental US</li>
                            <li data-value="Alaska">Alaska</li>
                            <li data-value="Hawaii">Hawaii</li>
                            <li data-value="all">All US</li>
                        </ul>
                    </div>
					
					<div class="map-wrap">
						<div class="map_container" id="<?= $rand_id ?>" data-type="<?= $rand_id ?>">&nbsp;</div>

						<ul class="map-dots-info clearfix">
							<li><span class="map-dot map-dot1"></span>Local Bible Bee (Active)</li>
							<li><span class="map-dot map-dot3"></span>Local Bible Bee (Inactive)</li>
						</ul>
					</div>
                    <?php
                    $is_host = false;
                    if( $user_id = \common\models\Users::user_id() ) {
                        $user_dyn_id = \common\models\Users::getUserID($user_id);

                        if ($host = \common\models\UsersHosts::find()->where("user_id=" . $user_dyn_id . " AND (status=1 or status=2)")->one()) {

                            $is_host = true;

                        }
                    }

                    if( !$is_host ) {
                        ?>
                        <div class="map-host-banner">
                            <div class="col1">
                                <h2 class="heading-xs color-featured">Can't find a local host?</h2>
                                <a class="btn btn-primary" href="<?= $user_id ? '/user/renewhost/' : '/host' ?>">You can become one!<span
                                        class="icon icon-arrow-right color-success"></span></a>
                            </div>
                            <?php
                            if( $show_google_plus_button == 1 ) {
                                ?>
                                <div class="col2">
                                    <strong class="color-primary">Or</strong>
                                </div>
                                <div class="col3">
                                    <h2 class="heading-xs color-featured">Connect with a Bible Bee Alumni on the</h2>
                                    <a class="btn btn-danger"
                                       href="https://plus.google.com/u/0/communities/107645641301522450881"
                                       target="_blank">Official
                                        Participant Community on Google +</a>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                </div><!-- .panel-cont -->
            </div><!-- .panel-box -->

            <div class="panel-box map_hosts_list_container" style="display:none">
                <div class="panel-head">
                    <div class="map-hosts-count">
                        <strong>Show:</strong>
                        <select class="form-control map_hosts_count">
                            <option value="6" selected>6</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                        </select>
                    </div>

                    <h3 class="title -md text-featured"><?= LiveEdit::text(__FILE__, 'Nearest BibleBee') ?></h3>
                </div><!-- .panel-head -->

                <div class="panel-cont map_hosts_list">

                </div><!-- .panel-cont -->
            </div><!-- .panel-box -->
        </div><!-- .widget-container -->
    </div><!-- .widget-map -->
