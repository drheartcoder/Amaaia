<?php

namespace App\Http\Controllers\Front\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\AddressesModel;

use Validator;
use Session;

class MyAddressesController extends Controller
{
    function __construct(
                         AddressesModel $addresses_model
                        )
    {
        $this->module_title                  = "My Addresses";
        $this->user_panel_slug               = config('app.project.user_panel_slug');
        $this->module_url_path               = url('/').'/'.$this->user_panel_slug.'/my_addresses';
        $this->module_view_folder            = "front.user.my_addresses";

        $this->BaseModel                     = $addresses_model;

        $this->product_image_base_path       = base_path().config('app.project.img_path.product_images');
        $this->product_image_public_path     = url('/').config('app.project.img_path.product_images');
    }

    public function index()
    {
        $arr_user = [];
    	$arr_addresses = [];
    	$login_user_id = 0;

    	$login_user_id = login_user_id('user');

        $obj_user = login_user_details('user');

        if($obj_user)
        {
            $arr_user = $obj_user->toArray();
        }
    	
    	$obj_addresses = $this->BaseModel->where('user_id',$login_user_id)->get();

    	if($obj_addresses)
    	{
    		$arr_addresses = $obj_addresses->toArray();
    	}

        //dump($arr_addresses);

        $this->arr_view_data['parent_module_title'] = "Home";
        $this->arr_view_data['page_title']          = $this->module_title;
        $this->arr_view_data['module_title']        = $this->module_title;
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['user_panel_slug']     = $this->user_panel_slug;
        $this->arr_view_data['parent_module_url']   = url('/').'/user/dashboard';

        $this->arr_view_data['arr_addresses']       = $arr_addresses;
        $this->arr_view_data['arr_user']            = $arr_user;
        
        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function store(Request $request)
    {
        $is_addresses_available = '';

        $arr_data = [];

        $arr_rules = array();

        $arr_rules['flatnumber']   = "required";
        $arr_rules['buildingname'] = "required";
        $arr_rules['address']      = "required";
        $arr_rules['city']         = "required";
        $arr_rules['state']        = "required";
        $arr_rules['country']      = "required";
        $arr_rules['postcode']     = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            return redirect($this->module_url_path)->withErrors($validator)->withInput();  
        }

        $arr_data['user_id']       = login_user_id('user');

        $is_addresses_available = $this->BaseModel->where('user_id',login_user_id('user'))->count();

        if($is_addresses_available == 0)
        {
            $arr_data['default_address'] = 2;           
        }
        else if($is_addresses_available >= 5)
        {
            Session::flash('error','You cannot add more than 5 addresses.');
            return redirect()->back();
        }

        $arr_data['flat_no']       = $request->input('flatnumber',null);
        $arr_data['building_name'] = $request->input('buildingname', null);
        $arr_data['address']       = $request->input('address', null);
        $arr_data['city']          = $request->input('city', null);
        $arr_data['post_code']     = $request->input('postcode', null);
        $arr_data['state']         = $request->input('state', null);
        $arr_data['country']       = $request->input('country', null);
        
        $status = $this->BaseModel->create($arr_data);

        if($status)
        {
            Session::flash('success','Address added successfully.');
        }
        else
        {
            Session::flash('error','Something went to wrong! Please try again later.');
        }
        
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $arr_data = [];

        $arr_rules = array();

        $arr_rules['edit_flatnumber']   = "required";
        $arr_rules['edit_buildingname'] = "required";
        $arr_rules['edit_address']      = "required";
        $arr_rules['edit_city']         = "required";
        $arr_rules['edit_state']        = "required";
        $arr_rules['edit_country']      = "required";
        $arr_rules['edit_postcode']     = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            return redirect($this->module_url_path)->withErrors($validator)->withInput();  
        }

        $address_id                = isset($request->edit_address_id) ? base64_decode($request->edit_address_id) : 0;

        $arr_data['flat_no']       = $request->input('edit_flatnumber',null);
        $arr_data['building_name'] = $request->input('edit_buildingname', null);
        $arr_data['address']       = $request->input('edit_address', null);
        $arr_data['city']          = $request->input('edit_city', null);
        $arr_data['post_code']     = $request->input('edit_postcode', null);
        $arr_data['state']         = $request->input('edit_state', null);
        $arr_data['country']       = $request->input('edit_country', null);
        
        $status = $this->BaseModel->where('id',$address_id)->update($arr_data);

        if($status)
        {
            Session::flash('success','Address updated successfully.');
        }
        else
        {
            Session::flash('error','Something went to wrong! Please try again later.');
        }
        return redirect()->back();
    
    }

    public function make_default_address($enc_address_id = false)
    {
        $address_id = $login_user_id = 0;
        if($enc_address_id != false)
        {
            $address_id = base64_decode($enc_address_id); 

            $login_user_id = login_user_id('user');  

            $this->BaseModel->where('user_id',$login_user_id)->update(['default_address' => '1']);

            $status = $this->BaseModel->where('id',$address_id)->update(['default_address' => '2']);

            if($status)
            {
                 Session::flash('success','Default address updated successfully.');
            }
            else
            {
                Session::flash('error','Something went to wrong! Please try again later.');
            }
        }
        else
        {
            Session::flash('error','Something went to wrong! Please try again later.');
        }

        return redirect()->back();

    }

    public function delete($enc_address_id = false)
    {
        $address_id = $login_user_id = 0;
        if($enc_address_id != false)
        {
            $address_id = base64_decode($enc_address_id); 

            $status = $this->BaseModel->where('id',$address_id)->delete();

            if($status)
            {
                 Session::flash('success','Address deleted successfully.');
            }
            else
            {
                Session::flash('error','Something went to wrong! Please try again later.');
            }
        }
        else
        {
            Session::flash('error','Something went to wrong! Please try again later.');
        }

        return redirect()->back();

    }
}
