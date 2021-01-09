<?php
namespace App\CustomClass;

class PaypalExpress
{
	
		
    public function validate($paymentID, $paymentToken, $payerID, $productID){
		
        $paypalClientID  = env('PAYPAL_API_CLIENT_ID'); 
        $paypalSecret   = env('PAYPAL_API_SECRET');
        $paypalEnv       = env('PAYPAL_SANDBOX')?'sandbox':'production'; 
        $paypalURL       = env('PAYPAL_SANDBOX')?'https://api.sandbox.paypal.com/v1/':'https://api.paypal.com/v1/';
    
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $paypalURL.'oauth2/token'); 
        curl_setopt($ch, CURLOPT_HEADER, false); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        curl_setopt($ch, CURLOPT_POST, true); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_USERPWD, $paypalClientID.":".$paypalSecret); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials"); 
        $response = curl_exec($ch); 
        curl_close($ch); 
         
        if(empty($response)){ 
            return false; 
        }else{ 
            $jsonData = json_decode($response); 
            $curl = curl_init($paypalURL.'payments/payment/'.$paymentID); 
            curl_setopt($curl, CURLOPT_POST, false); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
            curl_setopt($curl, CURLOPT_HEADER, false); 
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($curl, CURLOPT_HTTPHEADER, array( 
                'Authorization: Bearer ' . $jsonData->access_token, 
                'Accept: application/json', 
                'Content-Type: application/xml' 
            )); 
            $response = curl_exec($curl); 
            curl_close($curl); 
             
            // Transaction data 
            $result = json_decode($response); 
             
            return $result; 
        } 
     
    } 
	
}