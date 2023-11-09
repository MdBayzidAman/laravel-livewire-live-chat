<?php

namespace App\Services\SMS;

use Fouladgar\MobileVerification\Contracts\SMSClient;
use Fouladgar\MobileVerification\Notifications\Messages\Payload;

class MobileSMS implements SMSClient
{
    protected $SMSService;

    public function __construct(SMSService $SMSService)
    {
        $this->SMSService = $SMSService;
    }

    /**
     * @param Payload $payload
     *
     * @return mixed
     */
    public function sendMessage(Payload $payload):mixed
    {
        // preparing SMSService ...

        return $this->SMSService
                 ->sendSMS($payload->getTo(), $payload->getToken());
    }


}