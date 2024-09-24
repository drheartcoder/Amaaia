<?php

namespace App\Http\Controllers\Front\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Services\NotificationService;

use App\Models\ValuationModel;

use Validator;
use Session;

class ValuationController extends Controller
{
	function __construct(
                           NotificationService       $notification_service,
                           ValuationModel            $valuation_model
                        )
    {
        $this->module_title                  = "Valuation";
        $this->module_url_path               = url('/user/valuation');
        $this->module_view_folder            = "front.user.valuation";
        $this->user_panel_slug               = config('app.project.user_panel_slug');

        $this->NotificationService           = $notification_service;
        $this->ValuationModel                = $valuation_model;

        $this->valuation_img_base_path   = base_path().config('app.project.img_path.valuation_image');
        $this->valuation_img_public_path = url('/').config('app.project.img_path.valuation_image');
    }

    public function index()
    {

        $arr_valuation = [];
        
        $user_id = login_user_id('user');

        $obj_valuation = $this->ValuationModel->where('user_id',$user_id)->select('*')
        									  ->orderBy('created_at','DESC')
        									  ->with(['user_details' => function($query){
        									  	$query->select('id','first_name','last_name');
        									  }])
        									  ->paginate(10);

        if($obj_valuation)
        {
        	$arr_pagination = clone $obj_valuation;
            $arr_valuation  = $obj_valuation->toArray();
        }

        $arr_phonecode                              = get_phonecode();

        $this->arr_view_data['valuation_img_base_path']    = $this->valuation_img_base_path;
		$this->arr_view_data['valuation_img_public_path']  = $this->valuation_img_public_path;

        $this->arr_view_data['arr_phonecode']              = $arr_phonecode;
        $this->arr_view_data['parent_module_title']        = "Home";
        $this->arr_view_data['page_title']                 = $this->module_title;
        $this->arr_view_data['module_title']               = $this->module_title;
        $this->arr_view_data['module_url_path']            = $this->module_url_path;
        $this->arr_view_data['user_panel_slug']            = $this->user_panel_slug;
        $this->arr_view_data['parent_module_url']          = url('/').'/user/dashboard';

        $this->arr_view_data['arr_valuation']              = $arr_valuation;
        $this->arr_view_data['arr_pagination']             = $arr_pagination;
        return view($this->module_view_folder.'.index',$this->arr_view_data);
        

    }

    public function send_request()
    {
    	
		$arr_phonecode                              = get_phonecode();
    	$this->arr_view_data['arr_phonecode']       = $arr_phonecode;
        $this->arr_view_data['parent_module_title'] = "Home";
        $this->arr_view_data['page_title']          = 'New '.$this->module_title.' Request';;
        $this->arr_view_data['module_title']        = $this->module_title;
        $this->arr_view_data['module_url']          = $this->module_url_path;
        $this->arr_view_data['sub_module_title']    = 'Send Request';
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['user_panel_slug']     = $this->user_panel_slug;
        $this->arr_view_data['parent_module_url']   = url('/').'/user/dashboard';

        return view($this->module_view_folder.'.valuation_request',$this->arr_view_data);
    }

    public function proceed_request(Request $request)
    {
    	$arr_rules = $arr_data = array();
        
        $arr_rules['product_img']          = "required";
        $arr_rules['appointment_date']     = "required"; 
        $arr_rules['appointment_time']     = "required";
        $arr_rules['product_description']  = "required|max:500";
        $arr_rules['phonecode']            = "required";
        $arr_rules['mobile_number']        = "required|min:7|max:16";

        $file_name = "";
       
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            return redirect()->back()->withErrors($validator)->withInput();  
        }

        if($request->hasFile('product_img'))
        {
            $file_name = $request->input('product_img');
            $file_extension = strtolower($request->file('product_img')->getClientOriginalExtension());
            if(in_array($file_extension,['png','jpg','jpeg']))
            {
                $file_name = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                $isUpload = $request->file('product_img')->move($this->valuation_img_base_path , $file_name);

                $arr_data['product_image']    = $file_name or '';
                
            }
            else
            {
                Session::flash('error','Invalid File type, While creating '.str_singular($this->module_title));
                return redirect()->back();
            }
        }

        $mobile_number = '+'.$request->input('phonecode').$request->input('mobile_number');

        $appointment_date = date("Y-m-d",strtotime( $request->input('appointment_date',null)));
        $appointment_time = date("H:i",strtotime( $request->input('appointment_time',null)));

        $arr_data['user_id']             = login_user_id('user');
        $arr_data['appointment_date']    = $appointment_date;
        $arr_data['appointment_time']    = $appointment_time;
        $arr_data['mobile_number']       = $mobile_number;
        $arr_data['product_description'] = $request->input('product_description',null);

        $status = $this->ValuationModel->create($arr_data);

        if($status)
        {
        	 // Send notification to admin

            $user_first_name = $user_last_name = $user_name ='';

            $sender_details = login_user_details('user');

            $user_first_name = isset($sender_details->first_name) ? $sender_details->first_name : '';
            $user_last_name =  isset($sender_details->last_name) ? $sender_details->last_name : '';

            $user_name = $user_first_name.' '.$user_last_name;


            $arr_noti['user_id']                =  '1';  //receiver user id
            $arr_noti['receiver_user_type_id']  =  '1';
            $arr_noti['url']                    =  "valuation/view/".base64_encode($status->id);
            $arr_noti['user_name']              =  $user_name;

            $this->NotificationService->store_valuation_request_notification($arr_noti);

        	Session::flash('success','Valuation request sent successfully.');
            return redirect($this->module_url_path);
        }
        else
        {
        	Session::flash('error','Something went to wrong! Please try again later.');
            return redirect()->back();
        }

    }
}
