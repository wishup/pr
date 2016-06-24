<?php
namespace common\components;

/***************************
 * Class AuthorizeNet
 * @package common\components
 *
 * USAGE EXAMPLE
 *
 *   $model = new \common\components\AuthorizeNet(
 *      Yii::$app->params["auth_net_url"],
 *      Yii::$app->params["auth_net_login"],
 *      Yii::$app->params["auth_net_key"]
 *   );
 *
 *   $data = [
 *      "x_card_num" => "4111111111111111",
 *      "x_card_code" => "",
 *      "x_exp_date" => "0118",
 *      "x_amount" => "19.99",
 *      "x_first_name" => "John",
 *      "x_last_name" => "Doe",
 *      "x_address" => "1234 Street",
 *      "x_city" => "",
 *      "x_state" => "WA",
 *      "x_zip" => "98004",
 *      "x_phone" => "11123123123",
 *      "x_email" => "test@rpm-test.com",
 *      "x_cust_id" => "H94304",
 *      "x_country" => "US",
 *      "x_customer_ip" => "",
 *      "x_description" => "Sample Transaction",
 *      "x_invoice_num" => "H_TEST_INVOICE_NUM"
 *   ];
 *
 *   $model->load( $data );
 *
 *   $result = $model->pay();
 */

class AuthorizeNet {

    private $post_values = [];
    private $login, $tran_key, $post_url;

    public function __construct($post_url, $login, $tran_key) {

        $this->post_url = $post_url;
        $this->login = $login;
        $this->tran_key = $tran_key;

        $this->post_values = [
            "x_login" => $login,
            "x_tran_key" => $tran_key,
            "x_version" => "3.1",
            "x_delim_data" => "TRUE",
            "x_delim_char" => "|",
            "x_relay_response" => "FALSE",
            "x_type" => "AUTH_CAPTURE",
            "x_method" => "CC",
            "x_card_num" => "4111111111111111",
            "x_card_code" => "",
            "x_exp_date" => "0115",
            "x_amount" => "19.99",
            "x_first_name" => "John",
            "x_last_name" => "Doe",
            "x_address" => "1234 Street",
            "x_city" => "",
            "x_state" => "WA",
            "x_zip" => "98004",
            "x_phone" => "11123123123",
            "x_email" => "test@rpm-test.com",
            "x_cust_id" => "H94304",
            "x_country" => "US",
            "x_customer_ip" => "",
            "x_description" => "Sample Transaction",
            "x_invoice_num" => "H_TEST_INVOICE_NUM"
        ];

    }

    public function set($key, $value) {
        $this->post_values[$key] = $value;

        return true;
    }

    public function get($key) {
        return isset( $this->post_values[$key] ) ? $this->post_values[$key] : false;
    }

    public function load( $post ){

        $this->post_values = array_replace( $this->post_values, $post );

        return true;

    }

    private function get_query() {
        $post_string = "";
        foreach ($this->post_values as $key => $value) {
            $post_string .= "$key=" . urlencode($value) . "&";
        }
        $post_string = rtrim($post_string, "& ");

        return $post_string;
    }

    public function pay($debug = false) {
        $post_string = $this->get_query();

        $request = curl_init($this->post_url); // initiate curl object
        curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
        curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
        $post_response = curl_exec($request); // execute curl post and store results in $post_response
        curl_close($request); // close curl object

        $response_array = explode($this->post_values["x_delim_char"], $post_response);

        $response['payment_response_code'] = $response_array[0];
        $response['payment_response_subcode'] = $response_array[1];
        $response['payment_response_reason_code'] = $response_array[2];
        $response['payment_response_reason_text'] = $response_array[3];
        $response['payment_auth_code'] = $response_array[4];
        $response['payment_avs_response'] = $response_array[5];
        $response['payment_trans_id'] = $response_array[6];
        $response['payment_invoice_id'] = $response_array[7];
        $response['payment_description'] = $response_array[8];
        $response['payment_amount'] = $response_array[9];
        $response['payment_method'] = $response_array[10];
        $response['payment_trans_type'] = $response_array[11];
        $response['payment_customer_id'] = $response_array[12];
        $response['payment_firstname'] = $response_array[13];
        $response['payment_lastname'] = $response_array[14];
        $response['payment_company'] = $response_array[15];
        $response['payment_address'] = $response_array[16];
        $response['payment_city'] = $response_array[17];
        $response['payment_state'] = $response_array[18];
        $response['payment_zip'] = $response_array[19];
        $response['payment_country'] = $response_array[20];
        $response['payment_phone'] = $response_array[21];
        $response['payment_fax'] = $response_array[22];
        $response['payment_email'] = $response_array[23];
        $response['payment_ship_firstname'] = $response_array[24];
        $response['payment_ship_lastname'] = $response_array[25];
        $response['payment_ship_company'] = $response_array[26];
        $response['payment_ship_address'] = $response_array[27];
        $response['payment_ship_city'] = $response_array[28];
        $response['payment_ship_state'] = $response_array[29];
        $response['payment_ship_zip'] = $response_array[30];
        $response['payment_ship_country'] = $response_array[31];
        $response['payment_tax'] = $response_array[32];
        $response['payment_duty'] = $response_array[33];
        $response['payment_freight'] = $response_array[34];
        $response['payment_tax_exempt'] = $response_array[35];
        $response['payment_purchase_order'] = $response_array[36];
        $response['payment_md5_hash'] = $response_array[37];
        $response['payment_cardcode_response'] = $response_array[38];
        $response['payment_cardholder_auth'] = $response_array[39];

        $response['payment_account_number'] = $response_array[50];
        $response['payment_card_type'] = $response_array[51];

        if ($debug) {
            echo "<table border='0'>";
            foreach ($response as $key => $value) {
                echo "<tr><td>" . $key . "</td><td>" . $value . "</td></tr>";
            }
            echo "</table>";
        }

        return $response;
    }

}