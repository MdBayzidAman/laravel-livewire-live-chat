<?php

namespace App\Services\SMS\smsProvider;

use Twilio\Rest\Client;

class twilio
{
    public static function make($to, $body)
    {
        $sid    = getenv('TWILIO_ACCOUNT_SID');
        $token  = getenv('TWILIO_AUTH_TOKEN');
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create(
                $to, // to
                array(
                    "from" => getenv('TWILIO_PHONE_NUMBER'),
                    "body" => $body
                )
            );

        print($message->sid);
    }
}
