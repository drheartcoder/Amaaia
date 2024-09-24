<?php
namespace App\Common\Services;
/**
* 
*/
use App\Models\UserGiftCardModel;
use App\Common\Services\OtpService;
use App\Models\OrderGiftCardModel;
class GiftCardService
{
	
	function __construct(OtpService $otp_service, OrderGiftCardModel $order_gift_card_model, UserGiftCardModel $user_gift_card_model)
	{
		$this->OtpService         = $otp_service;
		$this->OrderGiftCardModel = $order_gift_card_model;
		$this->UserGiftCardModel  = $user_gift_card_model;
	}

	public function valiadte_code($arr_data = null)
	{
		if($arr_data != null)
		{
			$obj_gift_card = UserGiftCardModel::where(['user_to_email'=>$arr_data['email'], 'gift_card_code'=>$arr_data['code'],'is_used'=>'0'])->first();


			if($obj_gift_card)
			{
				$arr_gift_card           = $obj_gift_card->toArray();
				$sms_data['mobile_no']   = $arr_gift_card['user_to_phone'];
				$sms_data['user_id']     = login_user_id('user');
				$sms_data['template_id'] = '7';

				$status = $this->OtpService->send_otp($sms_data);
				
				if($status['error']==false)
				{
					return true;
				}
				return false;
			}
			return false;
		}
		return false;
	}

	public function update_giftcard($arr_data=null)
	{
		$status = false;
		
		if($arr_data!=null)
		{
			$order_id = isset($arr_data['order_id'])? $arr_data['order_id']:'';

			$obj_order_gift_card = $this->OrderGiftCardModel->where('order_id',$order_id)->first();

			if($obj_order_gift_card)
			{
				$status = $this->UserGiftCardModel->where('id', $obj_order_gift_card->user_gift_card_id)->update(['is_used'=>'1']);
			}
		}
		return $status;
	}
}