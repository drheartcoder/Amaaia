<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ContactEnquiryModel;
use App\Models\SiteSettingModel;
use Validator;
use Session;

class ContactUsController extends Controller
{
    function __construct(ContactEnquiryModel    $contact_model,
    					 SiteSettingModel       $site_settings_model)
	{
		$this->arr_view_data       = [];
		$this->ContactEnquiryModel = $contact_model;
		$this->SiteSettingModel    = $site_settings_model;		
		$this->module_view_folder  = "front.pages";
        $this->module_title        = 'Contact Us';

	}

    /*
    | Function  : Get site details
    | Author    : Deepak Arvind Salunke
    | Date      : 14/05/2018
    | Output    : Show all the site details
    */

	public function index()
	{
		$arr_site_setting = [];
		$obj_site_setting = $this->SiteSettingModel->first();
		if(isset($obj_site_setting) && $obj_site_setting!=null)
		{
			$arr_site_setting = $obj_site_setting->toArray();
		}
		$this->arr_view_data['site_data']    = $arr_site_setting;
        $this->arr_view_data['page_title']   = $this->module_title;

		return view($this->module_view_folder.'.contact_us',$this->arr_view_data);
	} // end index


    /*
    | Function  : Get contact us form data and store it
    | Author    : Deepak Arvind Salunke
    | Date      : 14/05/2018
    | Output    : Success or Error
    */

	public function store(Request $request)
	{
        $arr_rules = $user_data = [];
        $arr_rules['firstname']     = "required";
        $arr_rules['lastname']      = "required";
        $arr_rules['emailaddress']  = "required|email";
        $arr_rules['mobilenumber']  = "required";
        $arr_rules['message']       = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        { 
            return redirect()->back()->withErrors($validator)->withInput();  
        }
        else
        {
            $user_data['first_name'] = trim($request->input('firstname'));
            $user_data['last_name']  = trim($request->input('lastname'));            
            $user_data['email']      = trim($request->input('emailaddress'));
            $user_data['contact_no'] = trim($request->input('mobilenumber'));
            $user_data['message']    = trim($request->input('message'));
            $user_data['admin_reply']= 0;

    		$status = $this->ContactEnquiryModel->create($user_data);
    		if($status)
    		{
                Session::flash('success', 'Contact enquiry message send successfully.');
                return redirect()->back();
    		}
    		else
    		{
                Session::flash('error', 'Error while sending contact enquiry message.');
                return redirect()->back();   			
    		}
    	}
        Session::flash('error', 'Error while sending contact enquiry message.');       
        return redirect()->back();
    } // end store
    
}
