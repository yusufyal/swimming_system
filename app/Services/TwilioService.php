<?php

namespace App\Services;

use Twilio\Rest\Client;

class TwilioService
{
    protected $twilioSid;
    protected $twilioAuthToken;
    protected $whatsappNumber;

    public function __construct()
    {
        $this->twilioSid = env('TWILIO_SID');
        $this->twilioAuthToken = env('TWILIO_AUTH_TOKEN');
        $this->whatsappNumber = env('TWILIO_WHATSAPP_NUMBER');
    }

    public function sendWhatsAppMessage($to, $message)
    {

        if (!$this->twilioSid || !$this->twilioAuthToken || !$this->whatsappNumber) {
            throw new \Exception("Twilio credentials are missing.");
        }

        $client = new Client($this->twilioSid, $this->twilioAuthToken);



        $messageParams = [
            'from' => $this->whatsappNumber,
            'body' => $message,
            'to' => 'whatsapp:' . $to
        ];

        return $client->messages->create($messageParams['to'], $messageParams);
    }

}
