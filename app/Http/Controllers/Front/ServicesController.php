<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ContactEnquiryModel;

use Session;
use Validator;

class ServicesController extends Controller
{
    public function __construct(ContactEnquiryModel    $contact_model)
    {
    	$this->arr_view_data       = [];
        $this->module_title        = "Services";
        $this->module_view_folder  = "front.services.";
        $this->ContactEnquiryModel = $contact_model;
    }

    /*
    | Author    : Deepak Bari
    | Function  : Display listing of services.
    */

    public function index()
    {
        $this->arr_view_data['page_title']           = 'Services';
        $this->arr_view_data['parent_module_title']  = 'Home';
        $this->arr_view_data['parent_module_url']    = url('/');
        $this->arr_view_data['module_title']         = 'Jewellery';
        $this->arr_view_data['module_url']           = url('/').'/services';
        $this->arr_view_data['sub_module_title']     = $this->module_title;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    /*
    | Author    : Deepak Bari
    | Function  : Display details of service.
    */

    public function view($slug = false)
    {
        $this->arr_view_data['page_title']           = 'Services';
        $this->arr_view_data['slug']                 = $slug;
        $this->arr_view_data['parent_module_title']  = 'Home';
        $this->arr_view_data['parent_module_url']    = url('/');
        $this->arr_view_data['module_title']         = $this->module_title;
        $this->arr_view_data['module_url']           = url('/').'/services';
        $this->arr_view_data['sub_module_title']     = str_singular($this->module_title).' Details';
        
        return view($this->module_view_folder.'.view',$this->arr_view_data);
    }

    /*
    | Author    : Deepak Bari
    | Function  : Store contact enquiry.
    */

    public function store_contact_inquiry(Request $request)
    {
        $arr_rules = $user_data = [];
        $arr_rules['firstname']     = "required";
        $arr_rules['lastname']      = "required";
        $arr_rules['emailaddress']  = "required|email";
        $arr_rules['message']       = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        { 
            return redirect()->back()->withErrors($validator)->withInput();  
        }
        else
        {
            $user_data['first_name']  = trim($request->input('firstname'));
            $user_data['last_name']   = trim($request->input('lastname'));            
            $user_data['email']       = trim($request->input('emailaddress'));
            $user_data['message']     = trim($request->input('message'));
            $user_data['contact_no']  = '' ;
            $user_data['admin_reply'] = 0;

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
    }
}
