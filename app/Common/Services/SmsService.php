<?php
namespace App\Common\Services;
use Twilio\Rest\Client;

class SmsService
{
    function __construct()
    {
        $this->twillio_sid   = env('TWILIO_SID', false);
        $this->twillio_token = env('TWILIO_TOKEN', false);
        $this->twillio_from  = env('TWILIO_FROM', false);
        $this->sms_enabled   = true;
    }

    public function send_sms($message,$to_number)
    {   
        if ($this->sms_enabled == false)
        {
            return ['error'=>false,'msg'=>'SMS disabled'];
        }
        
        $sid     = $this->twillio_sid;
        $token   = $this->twillio_token;

        try
        {
            $arr_twillio_config         = [];
            $arr_twillio_config['from'] = $this->twillio_from;
            $arr_twillio_config['body'] = $message;

            $client   = new Client($sid, $token);
            $response = $client->messages->create($to_number,$arr_twillio_config);

            return ['error'=>false,'msg'=>$response];
        }
        catch(\Exception $e)
        {
            return ['error'=>true,'msg'=>$e->getMessage()];
        }
    }
}

?>