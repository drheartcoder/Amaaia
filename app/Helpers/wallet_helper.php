<?php 
use Illuminate\Support\Facades\DB;
use App\Models\UserWalletModel;

function wallet_total($user_id=null)
{
	$total = 0;
	if($user_id!=null)
	{
		$obj_wallet_details = UserWalletModel::where('user_id',$user_id)->
		select(DB::raw('sum(amount_credited) - sum(amount_debited) AS wallet_total'))
		->first();
		
		if($obj_wallet_details)
		{
			$arr_wallet_details = $obj_wallet_details->toArray();
			$total =  $arr_wallet_details['wallet_total'];
		}
		return $total;
	}

	return $total;
}
?>
