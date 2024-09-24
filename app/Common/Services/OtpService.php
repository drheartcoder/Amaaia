<?php
namespace App\Common\Services;
use App\Models\NotificationTemplateModel;
use App\Common\Services\SmsService;
use App\Models\UserOtpModel;
class OtpService
{
	function __construct()
	{
		$this->otp_expiration_time     = 15; /* in minutes */
		$this->otp_regenerate_seconds  = 120; /* in seconds */
		$this->otp_valid_after_seconds = 300;
		$this->SmsService              = new SmsService();
	}

	public function send_otp($sms_data)
	{
		$arr_otp    = $sms_data_template =  [];
		$phone_code = isset($sms_data['phone_code']) ? $sms_data['phone_code'] : '';
		$number     = isset($sms_data['mobile_no']) ? $sms_data['mobile_no'] : '';
		$mobile_no  = '+'.$phone_code.''.$number;
		$arr_otp    = $this->generate_otp_code();

		$arr_create['otp']            = $arr_otp['otp_code'];
		$arr_create['expired_on']     = $arr_otp['expired_on'];
		$arr_create['mobile_no']      = $number;

		$user_id = isset($sms_data['user_id']) ? $sms_data['user_id'] : '';
		$status  = $this->create_otp($arr_create,$user_id);

		if($status)
		{
			$template_id      = isset($sms_data['template_id']) ? $sms_data['template_id'] : '';
			$arr_msg_template = $this->get_message_template($template_id);
			$content          = isset($arr_msg_template['template_html']) && !empty($arr_msg_template['template_html']) ? $arr_msg_template['template_html'] : '';
			$content          = str_replace("##OTP##",$arr_create['otp'],$content);
			$status           = $this->SmsService->send_sms($content,$mobile_no);
			return $status;
		}
		else
		{
			return false;
		}
	}

	public function create_otp($arr_data = false, $user_id = false)
	{
		if($user_id != false && $arr_data != false)
		{
			$is_otp_stored = UserOtpModel::where('user_id',$user_id)->count();

			if($is_otp_stored > 0)
			{
				$status = UserOtpModel::where(['user_id' =>$user_id])
				->update([
					'otp'         => $arr_data['otp'],
					'expired_on'  => $arr_data['expired_on']
					]);
			}
			else
			{
				$arr_data['user_id'] = $user_id;
				$status = UserOtpModel::create($arr_data);           
			}
			return $status;
		}
		else
		{
			return false;
		}
	}

	public function generate_otp_code()
	{
		$otp_expiration = date("Y-m-d H:i:s", strtotime("+".$this->otp_expiration_time." minutes"));

		$digits_needed=6;

		$random_number='';

		$count=0;

		while ($count < $digits_needed ) {
			$random_digit = mt_rand(0, 9);
			$random_number .= $random_digit;
			$count++;
		}

		$otp = $random_number;

		return ['otp_code'=>$otp,'expired_on'=>$otp_expiration];
	}

	public function get_message_template($template_id = false)
	{
		if($template_id != false)
		{
			$obj_msg = NotificationTemplateModel::where('id',$template_id)->first();

			if($obj_msg)
			{
				$arr_msg = $obj_msg->toArray();
				return $arr_msg;
			}
		}
		else
		{
			return false;
		}
	}

	public function verify_otp($arr_otp = false)
  {

  	$arr_response = [];

  	if($arr_otp != false)
  	{
  		$is_valid_otp = UserOtpModel::where('user_id',$arr_otp['user_id'])
                                  ->where('otp',$arr_otp['otp'])
                                  ->count();
      if($is_valid_otp > 0 )
      {
            
        $current_datetime   = date("Y-m-d H:i:s");
        $is_otp_expired = UserOtpModel::where('user_id',$arr_otp['user_id'])
                                          ->where('otp',$arr_otp['otp'])
                                          ->where('expired_on' ,'>', $current_datetime)
                                          ->count();
            if($is_otp_expired == 0)
            {
            	$arr_response['status']  = 'error';
            	$arr_response['message'] = 'Your otp has expired. Please resend.';
              return $arr_response; 
            }
            else
            {

            	$arr_response['status']  = 'success';
            	$arr_response['message'] = 'OTP Verified successfully.';
              return $arr_response; 
            } 
      }
      else
      {
     	  $arr_response['status']  = 'error';
    	  $arr_response['message'] = 'Invalid OTP. Please try again';
        return $arr_response; 
      }
  	}
    return $arr_response; 
  }
}