<?php

namespace App\Http\Controllers\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SupplierModel;
use App\Common\Services\MailService;

use App\Common\Services\NotificationService;

use App\Models\WebAdminModel;


use Validator;
use Session;


class AuthController extends Controller
{
    public function __construct(
        SupplierModel        $supplier_model,
        WebAdminModel        $web_admin_model,
        MailService          $mail_service,
        NotificationService  $notification_service
        )
    {

        $this->WebAdminModel       = $web_admin_model;    
        $this->auth                = auth()->guard('supplier');
        $this->arr_view_data       = [];
        $this->module_title        = "Supplier";
        $this->module_view_folder  = "supplier.auth";
        $this->supplier_panel_slug = config('app.project.supplier_panel_slug');
        $this->module_url_path     = url($this->supplier_panel_slug);
        $this->SupplierModel       = $supplier_model;

        $this->MailService         = $mail_service;
        $this->NotificationService = $notification_service;

    }

    public function login()
    {
        $this->arr_view_data['module_title']        = $this->module_title." Login";
        $this->arr_view_data['page_title']          = $this->module_title." Login";
        $this->arr_view_data['supplier_panel_slug'] = $this->supplier_panel_slug;

        return view($this->module_view_folder.'.login',$this->arr_view_data);	
    }

    public function sign_up()
    {
        $arr_phonecode = [];
        $arr_phonecode                               = get_phonecode();
        $this->arr_view_data['arr_phonecode']        = $arr_phonecode;
        $this->arr_view_data['module_title']         = $this->module_title." Login";
        $this->arr_view_data['page_title']           = $this->module_title." Login";
        $this->arr_view_data['supplier_panel_slug']  = $this->supplier_panel_slug;

        $this->arr_view_data['module_url_path']      = $this->module_url_path;

        return view($this->module_view_folder.'.signup')->with($this->arr_view_data);
    }

    public function signup_store(Request $request)
    {
        $arr_supplier = $form_data =  [];

        $arr_rules = array();

        $arr_rules['first_name']            = "required|Max:60";
        $arr_rules['last_name']             = "required|Max:60"; 
        $arr_rules['mobile_number']         = "required|min:7|max:16";
        $arr_rules['email']                 = "required|email";
        $arr_rules['address']               = "required";
        $arr_rules['password']              = "required|min:6|max:16";
        $arr_rules['repeat_password']       = "required|same:password";
        $arr_rules['terms_and_conditions']  = "required";
        $arr_rules['phonecode']             = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            return redirect()->back()->withErrors($validator)->withInput();  
        }


        $form_data = $request->all();

        $remember_token = md5(uniqid(rand(), true));   

        $arr_supplier['first_name']                 = isset($form_data['first_name']) ? ucfirst($form_data['first_name']) : '';
        $arr_supplier['last_name']                  = isset($form_data['last_name']) ? ucfirst($form_data['last_name']) : '';
        $arr_supplier['email']                      = isset($form_data['email']) ? $form_data['email'] : '';
        $arr_supplier['mobile_number']              = isset($form_data['mobile_number']) ? $form_data['mobile_number'] : '';
        $arr_supplier['address']                    = isset($form_data['address']) ? $form_data['address'] : '';
        $arr_supplier['password']                   = isset($form_data['password']) ? bcrypt($form_data['password']) : '';
        $arr_supplier['country_phone_code_id']      = isset($form_data['phonecode']) ? base64_decode($form_data['phonecode']) : '';
        $arr_supplier['status']                     = '1';
        $arr_supplier['is_email_verified']          = '0';
        $arr_supplier['is_admin_verified']          = '0';
        $arr_supplier['remember_token']             = $remember_token;

        $is_user_exits  = 0;
        $is_user_exits  = $this->SupplierModel->where('email',$form_data['email'])->count();

        if($is_user_exits > 0)
        {
            Session::flash('error','This Email ID is already registered.');
            return redirect()->back()->withInput(); 
        }

        /*check that this email id is already registered as a admin or not*/
        $is_email_exist      = 0;
        $is_email_exist      = $this->WebAdminModel->where('email',$form_data['email'])->count();
        if($is_email_exist > 0)
        {
            Session::flash('error','You can not signup using these credentials.');
            return redirect()->back()->withInput(); 
        }

        $is_supplier_registered  = $this->SupplierModel->create($arr_supplier);

        if($is_supplier_registered)
        {
            $id                             =  $is_supplier_registered->id;
            $arr_mail['user_id']            =  $id;
            $arr_mail['user_type']          =  'Supplier';
            $arr_mail['to_email_id']        =  $form_data['email'];
            $arr_mail['name']               =  $form_data['first_name'];
            $arr_mail['verification_url']   =  url('/').'/supplier/verify_account/'.base64_encode($id).'/'.$remember_token;

            $status = $this->MailService->send_user_registration_email($arr_mail);

// Store notification

$arr_noti['user_id']                =  '1';  //receiver user id
$arr_noti['receiver_user_type_id']  =  '1';
$arr_noti['user_type']              =  "Supplier";
$arr_noti['url']                    =  "user/suppliers/view/".base64_encode($id);

$arr_noti['name']                   =  $form_data['first_name'];

$status = $this->NotificationService->store_user_registration_notification($arr_noti);

Session::flash('success', 'You are registered successfully. Please check your email address to verify your account.');
return redirect()->back();
}
else
{
    Session::flash('error','Problem occured while registration! Please try again later.');
    return redirect()->back();
}

}

public function verify_account($enc_user_id,$remember_token)
{
    $update_status = $check_verification_token = '';
    $user_id       = base64_decode($enc_user_id);
    $token         = $remember_token;
    $obj_user      = $this->SupplierModel->where('id',$user_id)->first();

    if(isset($obj_user->is_email_verified) && $obj_user->is_email_verified==1)
    {
        Session::flash('error','Your account is already verified.');
        return redirect($this->module_url_path);
    }
    else
    {

        $check_verification_token  =  $obj_user->where('remember_token','=',$remember_token)->first();
        if($check_verification_token)
        {
            $update_status = $check_verification_token->update(['is_email_verified'=>'1','remember_token'=>null]);
        }
    }

    if($update_status)
    {
        Session::flash('success','Account verified successfully.');

    }
    else
    {
        Session::flash('error','Error occured during account verification.');
    }
    return redirect($this->module_url_path);    
}



public function validate_login(Request $request)
{
    $arr_rules   = array();
    $status      = false;
    $remember_me = "";

    $arr_rules['email']          = "required|email";
    $arr_rules['password']       = "required";

    $validator = validator::make($request->all(),$arr_rules);

    if($validator->fails()) 
    {
        return back()->withErrors($validator)->withInput();
    }

    $remember_me        = $request->input('remember_me');
    $obj_group_supplier = $this->SupplierModel->where('email',$request->only('email'))->first();

    if(isset($obj_group_supplier->status) && $obj_group_supplier->status!=1)
    {
        Session::flash('error','Your account is temporarily blocked, Please contact admin for more details.');

        return redirect()->back();
    }
    elseif(isset($obj_group_supplier->is_email_verified) && $obj_group_supplier->is_email_verified!=1)
    {
        Session::flash('error','Your account is not verified yet, Please check your registerd email to verifiy account');

        return redirect()->back();  
    } 
    elseif(isset($obj_group_supplier->is_admin_verified) && $obj_group_supplier->is_admin_verified!=1)
    {
        Session::flash('error','Your account is not verified by admin, Please contact admin for details');

        return redirect()->back();  
    }


    if($obj_group_supplier) 
    {
        if($this->auth->attempt($request->only('email', 'password')))
        {
            if($remember_me!= 'on' || $remember_me == null)
            {
                setcookie("remember_me_email","");
                setcookie("remember_me_password","");
            }
            else
            {

                setcookie('remember_me_email',$request->input('email'), time()+60*60*24*100);
                setcookie('remember_me_password',$request->input('password'), time()+60*60*24*100);
            }

            Session::flash('success','You are successfully login to your account.');
            return redirect($this->module_url_path.'/dashboard');
        }
        else
        {
            setcookie("remember_me_email","");
            setcookie("remember_me_password","");

            Session::flash('error','Invalid login credential.');

            return redirect()->back();
        }
    }
    else
    {
        setcookie("remember_me_email","");
        setcookie("remember_me_password","");

        Session::flash('error','Invalid login credentials.');
        return redirect()->back();
    }
    return redirect()->back();
}

public function logout()
{
    $this->auth->logout();
    Session::flush();
    return redirect($this->module_url_path.'/');
}
}

