<?php
namespace common\components;

use Yii;
use yii\base\Event;

class trak1API{

    public $client = null;
    private $logPath = '';

    function __construct(){

        $this->client = Yii::$app->siteApi;
        $this->logPath = Yii::getAlias('@log');

    }

    function check( $transactionID ){

        $request = [
            "SubscriberCode" => Yii::$app->params["trak1_subscriber_code"],
            "CustomerNumber" => Yii::$app->params["trak1_customer_number"],
            "TransactionID" => $transactionID,
        ];

        $response = $this->client->RequestResult($request);

        $xml = $response->RequestResultResult->any;

        $arr = $this->xml_2_arr( $xml );

        $vals = $arr["vals"];
        $index = $arr["index"];

        if( isset( $index["APPLICANTDECISION"][0] ) && isset( $vals[ $index["APPLICANTDECISION"][0] ]["value"] ) ) {

            $this->log( 'Checked user status (TransactionID: '.$transactionID.' Status: '.strtolower($vals[$index["APPLICANTDECISION"][0]]["value"]).')' );

            return strtolower($vals[$index["APPLICANTDECISION"][0]]["value"]);
        } else {

            $this->log( 'Faild to check user status (TransactionID: '.$transactionID.')' );

            return false;
        }

    }

    function submit( $data ){

        if( isset($data["Zip"]) && $data["Zip"] != '' ){

            $zip_arr = explode("-", $data["Zip"]);

            $data["Zip"] = $zip_arr[0];

        }



        $request = '
            <RunPackage xmlns="http://tempuri.org/">
                <xmlDoc>
                    <Request>
                        <Authentication>
                            <SubscriberCode>773331CB-E774-4039-B099-A3C81D33B1E0</SubscriberCode>
                            <CustomerNumber>23001</CustomerNumber>
                        </Authentication>
                        <Applicant>';

        foreach ($data as $field => $value) {
            if ($field == 'DateOfBirth') {
                $date = date("Y-m-d", strtotime($value));
                $request .= "<{$field}>{$date}</{$field}>";
            } else {
                $request .= "<{$field}>{$value}</{$field}>";
            }
        }

        $request .= "</Applicant>
                    </Request>
                </xmlDoc>
            </RunPackage>";

        $xmlVar = new \SoapVar($request, XSD_ANYXML);

        $response = $this->client->RunPackage($xmlVar);

        $xml = $response->RunPackageResult->any;

        $arr = $this->xml_2_arr( $xml );

        $vals = $arr["vals"];
        $index = $arr["index"];

        if( isset( $index["ERRORDESCRIPTION"] ) && count($index["ERRORDESCRIPTION"]) > 0 ) {

            $errors = [];

            foreach( $index["ERRORDESCRIPTION"] as $err_ind=>$err_val ){

                $errors[] = $vals[ $index["ERRORDESCRIPTION"][$err_ind] ]["value"];

            }

            $this->log('Faild to submit user (' . (isset($data["Firstname"]) ? $data["Firstname"] : '') . ' ' . (isset($data["Lastname"]) ? $data["Lastname"] : '') . ' ' . (isset($data["SSN"]) ? 'SSN: ' . $data["SSN"] : '') . ' Errors: '.implode(", ", $errors).')');

            return ["errors"=>$errors];

        } else {

            if (isset($index["STATUS"][0]) && isset($vals[$index["STATUS"][0]]["value"])) {

                $ApplicantDecision = $vals[$index["APPLICANTDECISION"][0]]["value"];
                $TransactionID = $vals[$index["TRANSACTIONID"][0]]["value"];

                $this->log('Submitted user (' . (isset($data["Firstname"]) ? $data["Firstname"] : '') . ' ' . (isset($data["Lastname"]) ? $data["Lastname"] : '') . ' ' . (isset($data["SSN"]) ? 'SSN: ' . $data["SSN"] : '') . ' TransactionID: ' . $TransactionID . ')');

                return ["TransactionID" => $TransactionID, "ApplicantDecision" => $ApplicantDecision];

            } else {

                $this->log('Faild to submit user (' . (isset($data["Firstname"]) ? $data["Firstname"] : '') . ' ' . (isset($data["Lastname"]) ? $data["Lastname"] : '') . ' ' . (isset($data["SSN"]) ? 'SSN: ' . $data["SSN"] : '') . ')');

            }

        }

    }

    private function xml_2_arr( $xml ){

        $p = xml_parser_create();
        xml_parse_into_struct($p, $xml, $vals, $index);
        xml_parser_free($p);

        return ["vals"=>$vals, "index"=>$index];

    }

    private function log( $msg ){
        return false;
        $fp = fopen($this->logPath.'/trak1api.log', 'a');
        fwrite($fp, date("Y-m-d H:i:s").": ".$msg."\n");
        fclose($fp);

    }

}