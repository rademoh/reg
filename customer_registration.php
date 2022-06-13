<?php
  $url = 'http://localhost/wallet/Cloud_APIs/CustomerRegistration/register';
  $data = array(
                          "USERNAME"=>"system-user",
                          "PASSWORD"=>"lipuka",
                          "MSISDN"=>"254782091176",
                          "SURNAME"=>"Doe",
                          "OTHER_NAME"=>"John Mulwa",
                          "ID_NUMBER"=>"263772000000",//"263772431791",
                          "ID_TYPE"=>"1",
                          "EMAIL"=>"john.doe@gmail.com",
                          "DATE_OF_BIRTH"=>"1980-07-27 12=>00=>00",
                          "GENDER"=>"M",
                          "CUSTOMER_REF_NO"=>"1234567",
                          "NODE_SYSTEM_ID"=>"1",
                          "CURRENCY_ID"=>"USD",
                          "BANK_BRANCH_CODE"=>"149999",
                          "BANK_BRANCH_ID"=>1,
                          "TARIFF_ID"=>2,
                          "CURRENCY_SOURCE"=>"ISO",
                          "SMS_PIN"=>1,
                          "PIN_TYPE"=>"OTP",
                          "SKIP_PIN_HASH"=>"0",
                          "IS_DEFAULT"=>"1",
                          "ACCOUNT_ALIAS"=>"Xpres  Account",
                          "ACCOUNT_NUMBER"=>"800888502996",
                          "NARRATION"=>"New Registration",
                          "ACCOUNTS_DELIMITER"=>"",
                          "NOMINATION_TYPE_CODE"=>"IFT",
                          "REF_NUMBER"=>"1493198",
                          "AGENT_CODE"=>"",
                          "RESPONSE_TYPE"=>"JSON"
                          );

  echo http_build_query($data) . "\n";

  $response = sendViaPOST($url, $data);
  print_r(json_encode($response));

  function sendViaPOST($url, $payload)
  {

        try {
            $timeout = 20000;

            ////open connection
            $ch = curl_init();
            //set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            //curl_setopt($ch, CURLOPT_MUTE,1);
            curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // For Debug mode; shows up any error encountered during the operation
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            //Enable it to return http errors
            curl_setopt($ch, CURLOPT_FAILONERROR, true);
            //set the timeout
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($ch, CURLE_OPERATION_TIMEOUTED, $timeout);

            //new options
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
            //curl_setopt($ch, CURLOPT_CAINFO, REQUEST_SSL_CERTIFICATE);
            //execute post

            $response = curl_exec($ch);

            $result = json_decode($response, true);

            //close connection
            curl_close($ch);

            return $result;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

?>
