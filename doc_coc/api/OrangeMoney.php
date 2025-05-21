<?php

class OrangeMoney
{
    /**
     * Orange Money  API Base url
     */
    const BASE_URL = "https://api.orange.com/";
    
    private $auth_header = "Basic Z1BEaDl4eDZ5ZUhXc2pPVU1zekllTllLckFBOXBia0c6ckhHeFdYbzl2bHdYMnNkRg==";
    private $merchant_key = "5d09e012";
    private $amount;
    private $order_id;
    /**
     * @var string or null
     */
    private  $token;
    
    public function getToken(): string
    {
        return $this->token;
    }
    
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    // public function __construct()
    // {
    // }
    
    public function __construct($amount, $order_id)
    {
        $this->amount = $amount;
        $this->order_id = $order_id;
    }

    public function getAccessToken()
    {
        $ch = curl_init(self::BASE_URL."oauth/v3/token");
        
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: '.$this->auth_header
        ));
        curl_setopt($ch,CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $this->token = json_decode(curl_exec($ch))->access_token;
        return json_decode(curl_exec($ch))->access_token;
        
        // echo "GetAccessToken <br/>";
        // echo "<pre>";
        // if(curl_exec($ch))
        //     print_r(curl_exec($ch));
        // else
        //     print_r(curl_error($ch));
        // die;
    }
    
    public function getPaymentUrl($returnUrl)
    {
        $data = array(
          "merchant_key" => $this->merchant_key,
          "currency" => "XAF",
          "order_id" => $this->order_id,
          "amount" => $this->amount,
          "return_url" => $returnUrl,
          "cancel_url" => $returnUrl, //"http://closer.cm/om_status_updater.php?order_id=".$this->order_id."&amount=".$this->amount
          "notif_url" => "http://closer.cm/om_notif.php",
          "lang" => "fr"
        );
        $ch = curl_init(self::BASE_URL."orange-money-webpay/cm/v1/webpayment");
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer '.$this->getAccessToken(),
            'Accept: application/json',
            'Content-Type: application/json'
        ));
        curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        return json_decode(curl_exec($ch));

// echo "getPaymentUrl <br/>";
//                 echo "<pre>";
//         if(curl_exec($ch))
//             print_r(curl_exec($ch));
//         else
//             print_r(curl_error($ch));
//         die;
    }

    public function checkTransactionStatus($pay_token)
    {

        $data = [
            "order_id"  => $this->order_id,
            "amount"    => $this->amount,
            "pay_token" => $pay_token
        ];
        
        // echo "Transaction status Data <br/>";
        //     echo "<pre>";
        //     print_r($data);
        // die;

        $ch = curl_init(self::BASE_URL."orange-money-webpay/cm/v1/transactionstatus");
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer '.$this->token,
            'Accept: application/json',
            'Content-Type: application/json'
        ));
        curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        return json_decode(curl_exec($ch));
    }
}
