<?php

namespace App\Services\SMS\smsProvider;

class nexmo
{
    public static function make($to, $body)
    {
        $basic  = new \Vonage\Client\Credentials\Basic(getenv('NEXMO_API_KEY'), getenv('NEXMO_API_SECRET'));
        $client = new \Vonage\Client($basic);

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS($to, 'BRAND_NAME', $body)
        );
        
        $message = $response->current();
        
        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }
    }
}
