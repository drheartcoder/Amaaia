<?php

use App\Models\SiteSettingModel;
use App\Models\ProductViewsModel;

function get_current_day()
{
	$day      = strtoupper(date('D'));
	return $day;
}

function get_formated_created_date($date=null)
{
	if ($date!='0000-00-00 00:00:00') 
	{
		return date('d-m-Y',strtotime($date));
	}
	return '-';
}

/*
| Function  : convert inr amount to usd
| Author    : Deepak Arvind Salunke
| Date      : 23/04/2018
| Output    : return usd amount
*/

function inr_to_usd($amount = null)
{
	$new_amount = '';

	$amount = number_format($amount, 2, '.', '');

	$obj_rate = SiteSettingModel::select('currency_rate')->first();
	if($obj_rate)
	{
		$arr_rate = $obj_rate->toArray();
		$new_amount = $amount / $arr_rate['currency_rate'];
	}

	$new_amount = number_format($new_amount, 2, '.', '');

	return $new_amount;
}


/*
| Function  : convert usd amount to inr
| Author    : Deepak Arvind Salunke
| Date      : 23/04/2018
| Output    : return inr amount
*/

function usd_to_inr($amount = null)
{
	$new_amount = '';

	$amount = number_format($amount, 2, '.', '');

	$obj_rate = SiteSettingModel::select('currency_rate')->first();
	if($obj_rate)
	{
		$arr_rate = $obj_rate->toArray();
		$new_amount = $amount * $arr_rate['currency_rate'];
	}
	
	$new_amount = number_format($new_amount, 2, '.', '');

	return $new_amount;
}


/*
| Function  : convert to session currency or else in inr 
| Author    : Deepak Arvind Salunke
| Date      : 23/04/2018
| Output    : return session currency or else in inr 
*/

/*function session_currency($amount = null)
{
	$new_amount = '';


	$obj_rate = SiteSettingModel::select('currency_rate')->first();
	if($obj_rate)
	{
		$arr_rate = $obj_rate->toArray();

		$current_currency = Session::get('get_currency');

		if($current_currency == 'USD')
		{
			$new_amount = $amount / $arr_rate['currency_rate'];
		}
		else
		{
			$new_amount = $amount;
		}
	}
	

	if($current_currency == 'USD')
	{
		setlocale(LC_MONETARY, 'en_US');
		$new_amount =  money_format('%i', $new_amount);
		$new_amount = "<i class='fa fa-usd'></i> ".$new_amount;
	}
	else
	{
		setlocale(LC_MONETARY, 'en_IN');
		$new_amount =  money_format('%i', $new_amount);
		$new_amount = "<i class='fa fa-usd'></i> ".$new_amount;
	}

	return $new_amount;
}*/

function session_currency($amount = null)
{
	$new_amount = '';

	$amount = number_format($amount, 2, '.', '');

	$obj_rate = SiteSettingModel::select('currency_rate')->first();
	if($obj_rate)
	{
		$arr_rate = $obj_rate->toArray();

		$current_currency = Session::get('get_currency');

		if($current_currency == 'USD')
		{
			$new_amount = $amount / $arr_rate['currency_rate'];
		}
		else
		{
			$new_amount = $amount;
		}
	}
	
	$new_amount = number_format($new_amount, 2, '.', '');

	if($current_currency == 'USD')
	{
		$new_amount = "<i class='fa fa-usd'></i> ".number_format($new_amount,2);
	}
	else
	{
		$new_amount = "<i class='fa fa-inr'></i> ".number_format($new_amount,2);
	}

	return $new_amount;
}

function increment_view_count($product_id='')
{
	$ip      = '';
	$status  = false;
	$client  = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote  = @$_SERVER['REMOTE_ADDR'];

	if(filter_var($client,FILTER_VALIDATE_IP))
	{
		$ip = $client;
	}
	elseif(filter_var($forward, FILTER_VALIDATE_IP))
	{
		$ip = $forward;
	}
	else
	{
		$ip = $remote;
	}

	if($ip!='' && $product_id!='')
	{
		$count = ProductViewsModel::where(['product_id'=>$product_id, 'ip'=>$ip])->count();

		if($count == '0')
		{
			$status = ProductViewsModel::create(['product_id'=>$product_id, 'ip'=>$ip]);
		}
	}
	return $status;
}

?>