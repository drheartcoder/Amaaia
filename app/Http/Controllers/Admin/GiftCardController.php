<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Traits\MultiActionTrait;

use App\Models\GiftCardModel;
use App\Models\UserGiftCardModel;
use App\Models\SiteSettingModel;

use Validator;
use Session;
use DataTables;

class GiftCardController extends Controller
{

	use MultiActionTrait;	
	public function __construct(
								GiftCardModel     $gift_card_model,
								UserGiftCardModel $user_gift_card_model,
								SiteSettingModel  $site_setting_model
								)
	{
		$this->arr_view_data               = [];
		$this->GiftCardModel               = $gift_card_model;
		$this->admin_panel_slug            = config('app.project.admin_panel_slug');
		$this->admin_url_path              = url(config('app.project.admin_panel_slug'));
		$this->module_url_path             = $this->admin_url_path."/gift_card";
		$this->module_title                = "Gift Card";
		$this->module_view_folder          = "admin.gift_card";
		$this->module_icon                 = "fa fa-gift";
		
		$this->BaseModel                   = $gift_card_model;
		$this->UserGiftCardModel           = $user_gift_card_model;
		$this->SiteSettingModel            = $site_setting_model;

		$this->gift_card_image_base_path   = base_path().config('app.project.img_path.gift_card_image');
		$this->gift_card_image_public_path = url('/').config('app.project.img_path.gift_card_image');

	}

	public function index()
	{
		$this->arr_view_data['parent_module_icon']   = "icon-home2";
		$this->arr_view_data['parent_module_title']  = "Dashboard";
		$this->arr_view_data['parent_module_url']    = $this->admin_url_path.'/dashboard';
		$this->arr_view_data['page_title']           = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_title']         = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_icon']          = $this->module_icon;
		$this->arr_view_data['module_url_path']      = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
		
		return view($this->module_view_folder.'.index',$this->arr_view_data);

	}

	public function create()
	{
		$this->arr_view_data['parent_module_icon']  = "icon-home2";
		$this->arr_view_data['parent_module_title'] = "Dashboard";
		$this->arr_view_data['parent_module_url']   = $this->admin_url_path.'/dashboard';
		$this->arr_view_data['page_title']          = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_title']        = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_icon']         = $this->module_icon;
		$this->arr_view_data['module_url']     	    = $this->module_url_path;
		$this->arr_view_data['module_url_path']     = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
		$this->arr_view_data['sub_module_title']    = 'Add '.str_singular($this->module_title);
		$this->arr_view_data['sub_module_icon']     = 'fa fa-plus';

		return view($this->module_view_folder.'.create',$this->arr_view_data);
	}

	public function store(Request $request)
	{
		$arr_rules      = $arr_gift_card = array();
		$status         = false;

		$file_name      = "";

		$arr_rules['gift_card_image']   =  "required";
		$arr_rules['title']             =  "required";
		$arr_rules['amount']            =  "required";
		$arr_rules['description']       =  "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		if($request->hasFile('gift_card_image'))
		{
			$file_name = $request->input('gift_card_image');
			$file_extension = strtolower($request->file('gift_card_image')->getClientOriginalExtension());
			if(in_array($file_extension,['png','jpg','jpeg']))
			{
				$file_name = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
				$isUpload = $request->file('gift_card_image')->move($this->gift_card_image_base_path , $file_name);
			}
			else
			{
				Session::flash('error','Invalid File type, While creating '.str_singular($this->module_title));
				return redirect()->back();
			}
		}

		$title       = $request->input('title', null);
		$amount      = $request->input('amount', null);
		$description = $request->input('description', null);

		$amount_usd = 0;
		$obj_rate   = $this->SiteSettingModel->select('currency_rate')->first();
		if($obj_rate)
		{
			$arr_rate   = $obj_rate->toArray();
			$amount_usd = $arr_rate['currency_rate'];
		}

		$arr_gift_card['title']       = $title;
		$arr_gift_card['amount']      = $amount;
		$arr_gift_card['amount_usd']  = $amount_usd;
		$arr_gift_card['description'] = $description;
		$arr_gift_card['image']       = $file_name;
		$arr_gift_card['status']      = '1';

		$dose_exist = $this->BaseModel->where('title', '=', $title)->count();

		if($dose_exist> 0 )
		{
			Session::flash('error', 'This '.$this->module_title.' is already exist.');
			return redirect()->back();
		}
		
		$status = $this->BaseModel->create($arr_gift_card);		

		if($status)
		{
			Session::flash('success', $this->module_title.' added successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while adding '.$this->module_title.'.');
		return redirect()->back();
	}

	public function edit($enc_id)
	{
		$id = base64_decode($enc_id);
		$arr_gift_cards = [];

		$obj_gift_cards = $this->BaseModel->where('id',$id)->select('title','description','image','amount')->first();
		
		if($obj_gift_cards)
		{
			$arr_gift_cards = $obj_gift_cards->toArray();	
		}

		$this->arr_view_data['gift_card_image_base_path']      = $this->gift_card_image_base_path;
		$this->arr_view_data['gift_card_image_public_path']    = $this->gift_card_image_public_path;
		$this->arr_view_data['arr_gift_cards']                 = $arr_gift_cards;
		$this->arr_view_data['id']                             = $enc_id;
		$this->arr_view_data['page_title']                     = "Edit ".str_singular($this->module_title);
		$this->arr_view_data['parent_module_icon']             = "icon-home2";
		$this->arr_view_data['parent_module_title']            = "Dashboard";
		$this->arr_view_data['parent_module_url']              = $this->admin_url_path.'/dashboard';
		$this->arr_view_data['module_title']                   = str_plural($this->module_title);
		$this->arr_view_data['module_icon']                    = $this->module_icon;
		$this->arr_view_data['module_icon']                    = $this->module_icon;
		$this->arr_view_data['module_url']                     = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']               = $this->admin_panel_slug;
		$this->arr_view_data['sub_module_title']               = 'Edit '.str_singular($this->module_title);
		$this->arr_view_data['sub_module_icon']                = 'fa fa-pencil-square-o';

		$this->arr_view_data['module_url_path']                = $this->module_url_path;

		return view($this->module_view_folder.'.edit',$this->arr_view_data);
	}

	public function update(Request $request, $enc_id)
	{
		$arr_rules      = array();
		$status         = false;
		$old_image = "";
		$old_image = $request->input('oldimage');

		if($old_image == '')
		{
			$arr_rules['gift_card_image']   =  "required";
		}

		$arr_rules['title']                 =  "required";
		$arr_rules['amount']                =  "required";
		$arr_rules['description']           =  "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		if($request->hasFile('gift_card_image'))
		{
			$file_name = $request->input('gift_card_image');
			$file_extension = strtolower($request->file('gift_card_image')->getClientOriginalExtension());
			if(in_array($file_extension,['png','jpg','jpeg']))
			{
				$file_name = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
				$isUpload = $request->file('gift_card_image')->move($this->gift_card_image_base_path , $file_name);
				if($isUpload)
				{
					if ($old_image!="" && $old_image!=null) 
					{
						if (file_exists($this->gift_card_image_base_path.$old_image))
						{
							@unlink($this->gift_card_image_base_path.$old_image);
						}
					}
				}
			}
			else
			{
				Session::flash('error','Invalid File type, While creating '.str_singular($this->module_title));
				return redirect()->back();
			}
		}
		else
		{
			$file_name = $old_image;
		}

		$title       = $request->input('title', null);
		$amount      = $request->input('amount', null);
		$description = $request->input('description', null);

		$amount_usd = 0;
		$obj_rate   = $this->SiteSettingModel->select('currency_rate')->first();
		if($obj_rate)
		{
			$arr_rate   = $obj_rate->toArray();
			$amount_usd = $arr_rate['currency_rate'];
		}

		$arr_gift_card['title']       = $title;
		$arr_gift_card['amount']      = $amount;
		$arr_gift_card['amount_usd']  = $amount_usd;
		$arr_gift_card['description'] = $description;
		$arr_gift_card['image']       = $file_name;

		$id         = base64_decode($enc_id);

		$dose_exist = $this->BaseModel->where('title', '=', $title)->where('id', '!=', $id)->count();

		if($dose_exist> 0 )
		{
			Session::flash('error', 'This '.$this->module_title.' is already exist.');
			return redirect()->back();
		}
	
		$status = $this->BaseModel->where('id', $id)->update($arr_gift_card);		

		if($status)
		{
			Session::flash('success', $this->module_title.' updated successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while updating '.$this->module_title.'.');
		return redirect()->back();

	}

	public function load_data(Request $request)
	{
		$arr_search_column      = $request->input('column_filter');

		$obj_gift_card = $this->BaseModel;
		if(isset($arr_search_column['q_card_title']) && $arr_search_column['q_card_title']!="")
		{
			$obj_gift_card = $obj_gift_card->where('title', 'LIKE', "%".$arr_search_column['q_card_title']."%");	
		}

		$obj_gift_card = $obj_gift_card->select(['id', 'title','amount','status', 'created_at']);

		if($obj_gift_card)
		{
			$json_result  = DataTables::of($obj_gift_card)->make(true);
			$build_result = $json_result->getData();

			foreach ($build_result->data as $key => $data) 
			{
				$built_edit_href   = $this->module_url_path.'/edit/'.base64_encode($data->id);
				$built_view_href   = $this->module_url_path.'/view/'.base64_encode($data->id);
				$built_bank_details_href   = $this->module_url_path.'/delete/'.base64_encode($data->id);

				if(isset($build_result->data) && sizeof($build_result->data)>0)
				{
					if($data->status != null && $data->status == "0")
					{   
						$build_status_btn = '<a class="btn btn-xs btn-danger" title="Block" href="'.$this->module_url_path.'/unblock/'.base64_encode($data->id).'" 
						onclick="return confirm_action(this,event,\'Do you really want to activate this record ?\')" >Inactive</a>';
					}
					elseif($data->status != null && $data->status == "1")
					{
						$build_status_btn = '<a class="btn btn-xs btn-success" title="Unblock" href="'.$this->module_url_path.'/block/'.base64_encode($data->id).'" onclick="return confirm_action(this,event,\'Do you really want to inactivate this record ?\')" >Active</a>';
					}

					$built_delete_button = "<a class='btn btn-default btn-rounded show-tooltip' title='Delete' href='".$built_bank_details_href."'  data-original-title='View Bank Details' onclick='return confirm_action(this,event,\"Do you really want to delete this record ?\")' ><i class='fa fa-trash' ></i></a>";

					$built_edit_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_edit_href."' title='Edit' data-original-title='Edit'><i class='fa fa-pencil-square-o' ></i></a>";

					$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_href."' title='View' data-original-title='View'><i class='fa fa-eye'></i></a>";

					$action_button = $built_view_button.'	'.$built_edit_button.'	'.$built_delete_button;

					$id = isset($data->id)? base64_encode($data->id) :'';

					$build_result->data[$key]->id                  = $id;				
					$build_result->data[$key]->title               = isset($data->title)? $data->title :'NA';				
					$build_result->data[$key]->amount              = isset($data->amount)? $data->amount :'NA';
					$build_result->data[$key]->created_at          = isset($data->created_at)? get_formated_created_date($data->created_at) :'NA';

					$build_result->data[$key]->build_status_check  = $build_status_btn;
					$build_result->data[$key]->built_action_button = $action_button;

				}
			}
			return response()->json($build_result);
		}
	}


	/*
    | Function  : Get Gift card details
    | Author    : Deepak Arvind Salunke
    | Date      : 22/05/2018
    | Output    : Show Gift card details
    */

	public function view($enc_id = false)
	{
		$id = base64_decode($enc_id);
		$arr_gift_cards = [];

		$obj_gift_cards = $this->BaseModel->where('id',$id)->select('title','description','image','amount')->first();
		
		if($obj_gift_cards)
		{
			$arr_gift_cards = $obj_gift_cards->toArray();	
		}

		$this->arr_view_data['gift_card_image_base_path']   = $this->gift_card_image_base_path;
		$this->arr_view_data['gift_card_image_public_path'] = $this->gift_card_image_public_path;
		$this->arr_view_data['arr_gift_cards']              = $arr_gift_cards;
		$this->arr_view_data['id']                          = $enc_id;
		$this->arr_view_data['page_title']                  = "View ".str_singular($this->module_title);
		$this->arr_view_data['parent_module_icon']          = "icon-home2";
		$this->arr_view_data['parent_module_title']         = "Dashboard";
		$this->arr_view_data['parent_module_url']           = $this->admin_url_path.'/dashboard';
		$this->arr_view_data['module_title']                = str_plural($this->module_title);
		$this->arr_view_data['module_icon']                 = $this->module_icon;
		$this->arr_view_data['module_icon']                 = $this->module_icon;
		$this->arr_view_data['module_url']                  = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']            = $this->admin_panel_slug;
		$this->arr_view_data['sub_module_title']            = 'View '.str_singular($this->module_title);
		$this->arr_view_data['sub_module_icon']             = 'fa fa-eye';

		$this->arr_view_data['module_url_path']             = $this->module_url_path;
		$this->arr_view_data['module_view_path']            = $this->module_url_path.'/view/'.$enc_id;

		return view($this->module_view_folder.'.view',$this->arr_view_data);
	} // end view


	/*
    | Function  : Get all the data of users and details who used this card
    | Author    : Deepak Arvind Salunke
    | Date      : 22/05/2018
    | Output    : Show listing of all the users and details who used this card
    */

	public function load_card_details(Request $request, $enc_id = false)
	{
		$arr_search_column      = $request->input('column_filter');
		$card_id = base64_decode($enc_id);

		$obj_usergiftcard = $this->UserGiftCardModel->where('gift_card_id', $card_id)->with('user_details');
		
		if(isset($arr_search_column['q_user_name']) && $arr_search_column['q_user_name']!="")
		{
			$user_name = $arr_search_column['q_user_name'];
			$obj_usergiftcard = $obj_usergiftcard->whereHas('user_details', function($query) use ($user_name){
																$query->where('first_name', 'LIKE', "%".$user_name."%");
																$query->orWhere('last_name', 'LIKE', "%".$user_name."%");
															});
		}

		if(isset($arr_search_column['q_email']) && $arr_search_column['q_email']!="")
		{
			$obj_usergiftcard = $obj_usergiftcard->where('user_to_email', 'LIKE', "%".$arr_search_column['q_email']."%");	
		}

		if($obj_usergiftcard)
		{
			$json_result  = DataTables::of($obj_usergiftcard)->make(true);
			$build_result = $json_result->getData();

			foreach ($build_result->data as $key => $data) 
			{
				if(isset($build_result->data) && sizeof($build_result->data)>0)
				{
					if($data->is_used != null && $data->is_used == "0")
					{   
						$build_status_btn = '<a class="btn btn-xs btn-danger" title="Unused" >Unused</a>';
					}
					elseif($data->is_used != null && $data->is_used == "1")
					{
						$build_status_btn = '<a class="btn btn-xs btn-success" title="Used" >Used</a>';
					}

					$id         = isset($data->id)? base64_encode($data->id) :'';
					$first_name = isset($data->user_details->first_name)? $data->user_details->first_name :'';
					$last_name  = isset($data->user_details->last_name)? $data->user_details->last_name :'';

					$build_result->data[$key]->id                 = $id;
					$build_result->data[$key]->send_by            = $first_name.' '.$last_name;
					$build_result->data[$key]->received_by        = isset($data->user_to_email)? $data->user_to_email :'';
					$build_result->data[$key]->amount             = isset($data->amount)? $data->amount :'';
					$build_result->data[$key]->created_at         = isset($data->created_at)? get_formated_created_date($data->created_at) :'NA';

					$build_result->data[$key]->build_status_check = $build_status_btn;
				}
			}
			return response()->json($build_result);
		}
	} // end load_card_details
}
