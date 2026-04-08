<?php

require '../vendor/autoload.php'; 
require '../vendor/ismaeltoe/osms/src/Osms.php';

use \Osms\Osms;

class SMSService
{
    private $osms;
    private $token;
    private $senderAddress;
    private $senderName;

    public function __construct($clientId, $clientSecret, $senderPhone, $senderName)
    {
        $config = array(
            'clientId' => $clientId,
            'clientSecret' => $clientSecret
        );

        $this->osms = new Osms($config);
        $this->senderAddress = 'tel:' . $senderPhone;
        $this->senderName = $senderName;

        $this->getToken();
    }

    private function getToken()
    {
        $response = $this->osms->getTokenFromConsumerKey();
        if (isset($response['access_token'])) {
            $this->token = $response['access_token'];
        } else {
            $this->token = "";
            // Handle the case where access_token is not defined
            // For example: throw an exception or log an error
        }
    }

    public function envoyerSMS($numeroDestination, $message)
    {
        if (empty($this->token)) {
            // Handle the case where token is empty
            return false;
        }

        $receiverAddress = 'tel:' . $numeroDestination;

        try {
            $result = $this->osms->sendSMS($this->senderAddress, $receiverAddress, $message, $this->senderName);
            return $result;
        } catch (Exception $e) {
             
            return false;
        }
    }
}
