<?php

namespace App\Services\SMS;

use App\Services\SMS\smsProvider\nexmo;
use App\Services\SMS\smsProvider\twilio;

class SMSService
{
    public function sendSMS($to, $body)
    {
        twilio::make($to, 'Your verify code is '.$body);
    }
}
