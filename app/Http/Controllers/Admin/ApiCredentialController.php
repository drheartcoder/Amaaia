<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApiCredentialModel;

use Validator;
use Session;

class ApiCredentialController extends Controller
{

    function __construct(ApiCredentialModel $api_credential_model)
    {

        $this->module_title                  = "Api Credentials";
        $this->module_url_path               = url('/admin/api_credentials');
        $this->module_view_folder            = "admin.api_credentials";
        $this->module_icon                   = "fa fa-key";
        $this->admin_panel_slug              = config('app.project.admin_panel_slug');
        $this->ApiCredentialModel            = $api_credential_model;
    }


    public function index()
    {
        $arr_api_credetials                         = [];

        $obj_api_credetials = $this->ApiCredentialModel->first();

        if($obj_api_credetials)
        {
            $arr_api_credetials = $obj_api_credetials->toArray();
        }

        $this->arr_view_data['arr_data']            = $arr_api_credetials;
        $this->arr_view_data['page_title']          = $this->module_title;
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/admin/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = $this->module_title;
        $this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
        $this->arr_view_data['module_url_path']     = $this->module_url_path;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function update(Request $request)
    {
        $arr_rules                        = array();
        $arr_rules['dimond_api_key']      = "required";
        $arr_rules['dimond_api_secret']   = "required";
        $arr_rules['ccavenue_api_key']    = "required";
        $arr_rules['ccavenue_api_secret'] = "required";
        $arr_rules['sms_api_key']         = "required";
        $arr_rules['sms_api_secret']      = "required";

        $file_name = "";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            return redirect()->back()->withErrors($validator)->withInput();  
        }

        $arr_data['dimond_api_key']      = $request->input('dimond_api_key', null);
        $arr_data['dimond_api_secret']   = $request->input('dimond_api_secret', null);
        $arr_data['ccavenue_api_key']    = $request->input('ccavenue_api_key', null);
        $arr_data['ccavenue_api_secret'] = $request->input('ccavenue_api_secret', null);
        $arr_data['sms_api_key']         = $request->input('sms_api_key', null);
        $arr_data['sms_api_secret']      = $request->input('sms_api_secret', null);

        $status = $this->ApiCredentialModel->first()->update($arr_data);

        if($status)
        {
            Session::flash('success',str_singular($this->module_title).' Updated Successfully');
            return redirect()->back();
        }

        Session::flash('error','Problem Occurred, While Updating '.str_singular($this->module_title));
        return redirect()->back();
    }
}
