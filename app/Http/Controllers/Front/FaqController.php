<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\FaqModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ContactEnquiryModel;
use Validator;
use Session;

class FaqController extends Controller
{
    public function __construct(FaqModel 			$faq_model,
    							ContactEnquiryModel $contact_model)
	{
		$this->array_view_data     = [];
		$this->module_title        = 'FAQ';
		$this->module_view_folder  = 'front.pages';
		$this->module_url_path     = url('/faq');

		$this->ContactEnquiryModel = $contact_model;
		$this->FaqModel 		   = $faq_model;
		$this->BaseModel           = $faq_model;


	}


	/*
    | Function  : Get all the faq's
    | Author    : Deepak Arvind Salunke
    | Date      : 14/05/2018
    | Output    : Display all the faq's accroding to the condition
    */

    public function index(Request $request)
    {
    	$arr_faq = $obj_pagination = [];

		$obj_faq = $this->FaqModel->where('status','=','1')->paginate(10);
		if($obj_faq)
		{
			$arr_faq        = $obj_faq->toArray();
			$obj_pagination = clone $obj_faq;
		}

		$this->array_view_data['arr_pagination']	= $obj_pagination;
		$this->array_view_data['arr_faq']			= $arr_faq;
		$this->array_view_data['module_url_path']	= $this->module_url_path;		
    	$this->array_view_data['page_title'] 		= $this->module_title;

    	return view($this->module_view_folder.'.faq', $this->array_view_data);
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

        $arr_rules['username']      = "required";
        $arr_rules['email']  		= "required|email";
        $arr_rules['mobilenumber']  = "required";
        $arr_rules['message']       = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        { 
            return redirect()->back()->withErrors($validator)->withInput();  
        }
        else
        {
            $user_data['first_name'] = trim($request->input('username'));
            $user_data['last_name']  = '';
            $user_data['email']      = trim($request->input('email'));
            $user_data['contact_no'] = trim($request->input('mobilenumber'));
            $user_data['message']    = trim($request->input('message'));
            $user_data['admin_reply']= 0;

    		$status = $this->ContactEnquiryModel->create($user_data);
    		if($status)
    		{
                Session::flash('success', 'Your question is send successfully.');
                return redirect()->back();
    		}
    		else
    		{
                Session::flash('error', 'Error while sending your question.');
                return redirect()->back();   			
    		}
    	}
        Session::flash('error', 'Error while sending your question.');       
        return redirect()->back();
    } // end store
}
