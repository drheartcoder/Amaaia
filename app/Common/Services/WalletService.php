<?php 
namespace App\Common\Services;
use App\Models\OrderWalletModel;
use App\Models\UserWalletModel;

class WalletService
{
	function __construct(
		OrderWalletModel $order_wallet_model,
		UserWalletModel  $user_wallet_model
		)
	{
		$this->OrderWalletModel = $order_wallet_model;
		$this->UserWalletModel  = $user_wallet_model;
	}

	public function apply_wallet($arr_data=null)
	{
		$status = false;
		if($arr_data!=null)
		{

			$obj_wallet = $this->UserWalletModel->where('user_id',$arr_data['user_id'])->select('id')->first();	

			if($obj_wallet)
			{
				$wallet_data['remaining_wallet_balance'] = '0';
				$wallet_data['wallet_id']                = $obj_wallet->id;
				$wallet_data['user_id']                  = $arr_data['user_id'];
				$wallet_data['order_id']                 = $arr_data['order_id'];
				$wallet_data['total_wallet_balance']     = $arr_data['total_wallet_balance'];
				$wallet_data['used_wallet_balance']      = $arr_data['used_wallet_balance'];

				$status = $this->OrderWalletModel->create($wallet_data);

				if($status)
				{
					return $status;
				}

				return $status;
			}	
			return $status;
		}
		return $status;
	}

	public function update_wallet($arr_data = null)
	{
		$status = false;
		
		if($arr_data!=null)
		{
			$order_id  = isset($arr_data['order_id'])? $arr_data['order_id']:'';
			$user_id   = isset($arr_data['user_id'])? $arr_data['user_id']:'';
			$obj_order = $this->OrderWalletModel->where('order_id',$order_id)->first();

			if($obj_order && $arr_data['order_status']=='Success')
			{
				$used_wallet_balance          = $obj_order->used_wallet_balance;

				$arr_wallet['user_id']            = $user_id;
				$arr_wallet['order_id']           = $order_id;
				$arr_wallet['amount_debited']     = $used_wallet_balance;
				$arr_wallet['transaction_status'] = '1';
				$status = $this->UserWalletModel->create($arr_wallet);
			}
		}
		return $status;
	}

}