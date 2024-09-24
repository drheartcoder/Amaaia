<?php

namespace App\Http\Controllers\Front\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TransactionModel;
use Session;

class TransactionController extends Controller
{
	public function __construct(TransactionModel $transaction_model)
	{
		$this->module_view_folder = 'front.user.transactions.';
		$this->arr_view_data = [];
		$trasactions = [];
		$this->TransactionModel=$transaction_model;
	}

	public function index()
	{

		$arr_trasactions = [];
		$currency        = 'INR';
		$user_id         = login_user_id('user');
		$obj_pagiation = [];

		if(Session::has('get_currency'))
		{
			$currency = Session::get('get_currency');
		}

		$obj_trasactions = $this->TransactionModel
		->where('user_id', $user_id)->where('payment_status','!=','0')->where('trans_type','1')
		->select(['transaction_id', 'tracking_id','order_id','amount','trans_type','payment_status','transaction_usd_value','updated_at'])
		->orderBy('transaction_id', 'DESC')
		->paginate('10');

		if($obj_trasactions)
		{
			$obj_pagiation   = $obj_trasactions->links();
			$arr_trasactions = $obj_trasactions->toArray();
			$trasactions     = $arr_trasactions['data'];
			$from            = $arr_trasactions['from'];
			$to              = $arr_trasactions['to'];
		}

		$this->arr_view_data['from']             = $from;
		$this->arr_view_data['to']               = $to;
		$this->arr_view_data['currency']         = $currency;
		$this->arr_view_data['pagination']       = $obj_trasactions;
		$this->arr_view_data['arr_trasactions']  = $trasactions;
		$this->arr_view_data['page_title']       = 'Trasactions';
		$this->arr_view_data['parent_module_title']     = 'Home';
		$this->arr_view_data['module_title'] = 'Trasactions';
		$this->arr_view_data['parent_module_url'] = url('/');

		return view($this->module_view_folder.'index', $this->arr_view_data);
	}
}
