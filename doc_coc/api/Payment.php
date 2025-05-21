<?php

class Payment
{

    public static function payInit($order_id, $amount, $products, $link){

        $client_id= "b1t1p8i27DxFzP8EtGi3tVhIaPv6cJyY3Y0PpQrFi54G1OpTsWhT3TkAnK9CoDsDtY84nBkXaRr1wT0Kv60ZuEdD9JyGsXh860pD_id_--61f6c48bee87b";
        $client_secret = "iEzWfIpO4HyE1Gf9r2xX4W9CyPoTlZ6J8CwIoPcVqCq767tTnBmCePkP2CnL8Rd3eG08qY8KiYuTqT4Kn0wZwGcZuM9OmP8S079Qo4n0i0f3zZpVvHeGi9s3_sc_--61f6c48beed53";

        // $datas = $bill;
        // $links = ["return"=>"https://closer.cm/pay-status", "cancel"=>"https://closer.cm/pay-cancel", "ipn"=>"ipn"];
        $links = ["return"=>"https://closer.cm/".$link, "cancel"=>"https://closer.cm/".$link, "ipn"=>"ipn"];
        $ipn = "ipn";
        $return = "https://closer.cm/".$link;
        $cancel = "https://closer.cm/".$link;

        // Initialiser un paiement

        // $products = $datas['cartItems']; // Liste des produits
        
        echo " order_id : ".$order_id."<br/>";
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://secure.cleanpay.africa/pay/secure/inittransaction",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            
            CURLOPT_POSTFIELDS => array(
                'order_id' => $order_id, //L'id de la commande
                'amount' => $amount, // montant de la commande
                'return_url' => $links['return'], // url de retour
                'cancel_url' => $links['cancel'], //url de retour en cas d'annulation
                'ipn' => $links['ipn'], //url de mise a jour
                'data' => json_encode($products) //array des produits
            ),
            
            // 'data' => '{"products":[{"name":"test 1"}, {"name":"test 2"}]}'
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Authorization: Basic " . base64_encode($client_id . ':' . $client_secret), //avoir ceci dans l'application
            ),
        ));

        $response = json_decode(curl_exec($curl));
//        $this->response = $response;
        $error = curl_error($curl);
        curl_close($curl);

        return $response;
    }

    public static function payState($token_pay){

        $client_id= "b1t1p8i27DxFzP8EtGi3tVhIaPv6cJyY3Y0PpQrFi54G1OpTsWhT3TkAnK9CoDsDtY84nBkXaRr1wT0Kv60ZuEdD9JyGsXh860pD_id_--61f6c48bee87b";
        $client_secret = "iEzWfIpO4HyE1Gf9r2xX4W9CyPoTlZ6J8CwIoPcVqCq767tTnBmCePkP2CnL8Rd3eG08qY8KiYuTqT4Kn0wZwGcZuM9OmP8S079Qo4n0i0f3zZpVvHeGi9s3_sc_--61f6c48beed53";

        $pay_token = $token_pay;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://secure.cleanpay.africa/pay/secure/transactionstate",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "pay_token=$pay_token",  // pay_token est l'identifiant unique de paiement renvoyé à l'initialisation
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Authorization: Basic ".base64_encode($client_id.':'.$client_secret), // avoir ceci dans l'application
                "Content-Type: application/x-www-form-urlencoded"
            ),
        ));
        $response = curl_exec($curl);
        $response = json_decode($response);
        $error = curl_error($curl);
        curl_close($curl);

        return $response;
    }
}
