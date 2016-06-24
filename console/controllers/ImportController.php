<?php
namespace console\controllers;

use common\models\Users;
use common\models\UsersHosts;
use Yii;
use yii\console\Controller;

class ImportController extends Controller {

    private $from_dsn = 'mysql:host=localhost;dbname=biblebee_2015';
    private $from_username = 'root';
    private $from_password = '';

    private $to_dsn = 'mysql:host=localhost;dbname=bb_dev';
    private $to_username = 'root';
    private $to_password = '';

    public function actionIndex(){

        return true;

    }

    public function action2015(){

        $this->importFamilies();

        echo "Imported Successfully !";

    }

    private function importFamilies(){

        $from_connection = new \yii\db\Connection([
            'dsn' => $this->from_dsn,
            'username' => $this->from_username,
            'password' => $this->from_password,
        ]);
        $from_connection->open();

        $to_connection = new \yii\db\Connection([
            'dsn' => $this->to_dsn,
            'username' => $this->to_username,
            'password' => $this->to_password,
        ]);
        $to_connection->open();

        $families = $from_connection->createCommand('SELECT * FROM `tbenrollusers2015` WHERE `Deleted` = 0')->queryAll();

        $contestants_data = $from_connection->createCommand('SELECT * FROM `tbcontestants2015`')->queryAll();

        $contestants = [];

        foreach( $contestants_data as $cont ){

            if( !isset( $contestants[ $cont["EnrollUserId"] ] ) ) $contestants[ $cont["EnrollUserId"] ] = [];

            $contestants[ $cont["EnrollUserId"] ][] = $cont;

        }





        $hearAbouts = $to_connection->createCommand('SELECT * FROM `hear_about`')->queryAll();

        $hearabout_arr = [];

        foreach( $hearAbouts as $ha )
            $hearabout_arr[ strtolower($ha["answer"]) ] = $ha["id"];

        $versions = [
            1 => 1,
            2 => 2,
            3 => 3,
            5 => 4,
        ];

        foreach( $families as $family ){

            $maxDynIdRes = $to_connection->createCommand('SELECT dynamic_id FROM `users_id` order by dynamic_id desc limit 0,1')->queryAll();

            $userDynId = $maxDynIdRes[0]["dynamic_id"];

            if( $existinguser = $to_connection->createCommand("SELECT * FROM `users` WHERE `email`='".addslashes($family["Email"])."'")->queryOne() ){

                $new_user_id = $existinguser["id"];

                if( $usersidtable = $to_connection->createCommand("SELECT * FROM `users_id` WHERE `season_id`=2 AND `user_id`=".$new_user_id)->queryOne() ){

                    $userDynId = $usersidtable["dynamic_id"];

                } else {

                    $userDynId++;

                    $insertUsersIdSQL = "INSERT INTO `users_id` (`id`, `user_id`, `season_id`, `dynamic_id`) VALUES(
                                null,
                                " . $new_user_id . ",
                                2,
                                " . $userDynId . "
                                )";

                    $to_connection->createCommand($insertUsersIdSQL)->execute();

                }

                if( !$to_connection->createCommand("SELECT * FROM `user_check` WHERE `user_id`=".$userDynId)->queryOne() ){

                    $insertUserCheckSQL = "INSERT INTO `user_check` (`id`, `user_id`, `status`, `TransactionID`, `ssn`, `first_name`, `last_name`, `middle_name`, `date_of_birth`, `address_1`, `address_2`, `city`, `state`, `country`, `zip`, `email`, `status_changed_at`, `approved_at`)
                                    VALUES (NULL, " . $userDynId . ", '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', NULL, NULL);";

                    $to_connection->createCommand($insertUserCheckSQL)->execute();

                }

            } else {

                $insertUserSQL = "INSERT INTO `users`
                              (`id`, `email`, `password`, `created_at`, `updated_at`, `status`, `confirm_code`, `migr_id`, `h_cs_status`, `f_cs_status`, `v_cs_status`, `n_cs_status`, `migr_table`) VALUES
                              (null,
                              '" . addslashes($family["Email"]) . "',
                              '" . md5($family["Password"]) . "',
                              '" . date("Y-m-d H:i:s") . "',
                              '0000-00-00 00:00:00',
                              0,
                              '',
                              " . $family["Id"] . ",
                              0,
                              0,
                              0,
                              0,
                              'tbenrollusers2015'
                              )";

                $to_connection->createCommand($insertUserSQL)->execute();

                $new_user_id = $to_connection->lastInsertID;

                $userDynId++;

                $insertUsersIdSQL = "INSERT INTO `users_id` (`id`, `user_id`, `season_id`, `dynamic_id`) VALUES(
                                null,
                                " . $new_user_id . ",
                                2,
                                " . $userDynId . "
                                )";

                $to_connection->createCommand($insertUsersIdSQL)->execute();

                $insertUserCheckSQL = "INSERT INTO `user_check` (`id`, `user_id`, `status`, `TransactionID`, `ssn`, `first_name`, `last_name`, `middle_name`, `date_of_birth`, `address_1`, `address_2`, `city`, `state`, `country`, `zip`, `email`, `status_changed_at`, `approved_at`)
                                    VALUES (NULL, " . $userDynId . ", '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', NULL, NULL);";

                $to_connection->createCommand($insertUserCheckSQL)->execute();

                if ($family["HowDidYouHear"] == 'Other') {
                    $hearabout = 999999;
                } else {
                    if (isset($hearabout_arr[strtolower($family["HowDidYouHear"])])) {
                        $hearabout = $hearabout_arr[strtolower($family["HowDidYouHear"])];
                    } else {
                        $hearabout = 999999;
                    }
                }

                $insertUserInfoSQL = "INSERT INTO `user_info` (`id`, `user_id`, `first_name`, `last_name`, `middle_name`, `address_1`, `address_2`, `country`, `city`, `state`, `zip`, `phone`, `date_of_birth`, `ssn`, `tags`, `avatar`, `hear_about_us`, `hear_about_us_other`, `cell_phone`)
                                  VALUES (
                                  NULL,
                                  " . $new_user_id . ",
                                  '" . addslashes($family["Firstname"]) . "',
                                  '" . addslashes($family["Lastname"]) . "',
                                  '',
                                  '" . addslashes($family["Address1"]) . "',
                                  '" . addslashes($family["Address2"]) . "',
                                  'US',
                                  '" . addslashes($family["City"]) . "',
                                  '" . addslashes($family["State"]) . "',
                                  '" . addslashes($family["Zip"]) . "',
                                  '" . addslashes($family["Phone"]) . "',
                                  NULL,
                                  '',
                                  '<%2015%>',
                                  NULL,
                                  '" . $hearabout . "',
                                  '" . addslashes($family["HowDidYouHearOther"]) . "',
                                  '" . addslashes($family["CellPhone"]) . "'
                                  )";

                $to_connection->createCommand($insertUserInfoSQL)->execute();

            }

            $insertUsersFamiliesSQL = "INSERT INTO `users_families` (`id`, `user_id`, `status`, `created_at`, `spouse_first_name`, `spouse_last_name`) VALUES(
                                      null,
                                      ".$userDynId.",
                                      ".( $family["Paid"] == 2 ? 1 : 0 ).",
                                      '0000-00-00 00:00:00',
                                      '".addslashes($family["SName"])."',
                                      ''
                                      )";

            $to_connection->createCommand( $insertUsersFamiliesSQL )->execute();

            $family_id = $to_connection->lastInsertID;

            if( isset( $contestants[ $family["Id"] ] ) ){

                foreach( $contestants[ $family["Id"] ] as $contestant ){

                    $insertContestantSQL = "INSERT INTO `contestants` (`id`, `user_id`, `first_name`, `last_name`, `date_of_birth`, `gender`, `t_shirt_size`, `version`, `age_group`, `journal`, `order_id`, `created_at`, `status`) VALUES
                                            (
                                            NULL,
                                            ".$family_id.",
                                            '".addslashes($contestant["Firstname"])."',
                                            '".addslashes($contestant["Lastname"])."',
                                            '".( substr($contestant["Birthday"], 6, 4).'-'.substr($contestant["Birthday"], 0, 2).'-'.substr($contestant["Birthday"], 3, 2) )."',
                                            ".( $contestant["Gender"] == 'M' ? 1 : 2 ).",
                                            0,
                                            ".( isset($versions[ $contestant["BibleVersion"] ]) ? $versions[ $contestant["BibleVersion"] ] : 0 ).",
                                            '".addslashes( $contestant["AgeGroup"] == 'Slasher' ? 'Beginner' : $contestant["AgeGroup"] )."',
                                            0,
                                            null,
                                            '0000-00-00 00:00:00',
                                            ".$contestant["Status"]."
                                            )";

                    $to_connection->createCommand( $insertContestantSQL )->execute();

                }

            }

            $host_user_id = (int)$family["ChairmanID"];

            $hostmodel = $to_connection->createCommand('SELECT * FROM `users_hosts` WHERE `user_id`=(SELECT `dynamic_id` FROM `users_id` WHERE `users_id`.`season_id`=2 AND `users_id`.`user_id`='.$host_user_id.')')->queryAll();

            if( count($hostmodel) > 0 ) {

                $insertHostFamilySQL = "INSERT INTO `family_host` (`id`, `family_id`, `host_id`) VALUES(null, " . $family_id . ", " . $hostmodel[0]["id"] . ")";

                $to_connection->createCommand($insertHostFamilySQL)->execute();

            }

        }

    }

}