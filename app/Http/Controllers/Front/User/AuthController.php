<?php

namespace App\Http\Controllers\Front\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\WebAdminModel;

use App\Common\Services\MailService;

use App\Common\Services\NotificationService;

use Validator;
use Session;

class AuthController extends Controller
{
	public function __construct(
   UserModel $user_model,
   WebAdminModel $web_admin_model,
   MailService          $mail_service,
   NotificationService  $notification_service
   )
	{

		$this->arr_view_data       = [];
		$this->user_panel_slug     = config('app.project.user_panel_slug');
		$this->user_url_path       = url(config('app.project.user_panel_slug'));
		$this->module_url_path     = $this->user_url_path;
		$this->module_title        = "User Login";
    $this->BaseModel           = $user_model;
    $this->WebAdminModel       = $web_admin_model;
    $this->MailService         = $mail_service;
    $this->NotificationService = $notification_service;
    $this->module_view_folder  = "front.user.auth";
    $this->auth                = auth()->guard('user');
  }


  /*
  | Author    : Deepak Bari
  | Function  : Login page
  */

  public function login()
  {
    $this->arr_view_data['page_title']            = 'Login';

    return view($this->module_view_folder.'.login',$this->arr_view_data);
  }

  /*
  | Author    : Deepak Bari
  | Function  : Validate login
  */

  public function validate_login(Request $request)
  {
    $arr_rules      = array();
    $status         = false;

    $remember_me = "";

    $arr_rules['email']          = "required|email";
    $arr_rules['password']       = "required";

    $validator = validator::make($request->all(),$arr_rules);

    if($validator->fails()) 
    {
      return back()->withErrors($validator)->withInput();
    }

    $remember_me = $request->input('remember_me');

    $obj_user  = $this->BaseModel->where('email',$request->only('email'))->first();

    if(isset($obj_user->status) && $obj_user->status!=1)
    {
      Session::flash('error','Your account is temporarily blocked, Please contact admin for more details.');

      return redirect()->back();
    }
    elseif(isset($obj_user->is_email_verified) && $obj_user->is_email_verified!=1)
    {
      Session::flash('error','Your account is not verified yet, Please check your registerd email to verifiy account.');

      return redirect()->back();  
    } 

    if($obj_user) 
    {
      if($this->auth->attempt($request->only('email', 'password')))
      {
        if($remember_me!= 'on' || $remember_me == null)
        {
         setcookie("remember_me_email","");
       }
       else
       {
        setcookie('remember_me_email',$request->input('email'), time()+60*60*24*100);
      }

      $return_url = Session::get('return_url');

      if(isset($return_url) && $return_url!='')
      {
        Session::forget('return_url');
        return redirect(url('/'.$return_url));
      }


        return redirect($this->user_url_path.'/dashboard');

      Session::flash('success','You are successfully login to your account.');
      
    }
    else
    {
     setcookie("remember_me_email","");
     Session::flash('error','Invalid login credential.');

     return redirect()->back();
   }
 }
 else
 {
   setcookie("remember_me_email","");

   Session::flash('error','Invalid login credentials.');
   return redirect()->back();
 }
 return redirect()->back();
}

/*
| Author    : Deepak Bari
| Function  : Signup form.
*/

public function signup()
{
  $this->arr_view_data['page_title']            = 'Sign Up';
  $arr_phonecode = [];
  $arr_phonecode                               = get_phonecode();
  $this->arr_view_data['arr_phonecode']        = $arr_phonecode;
  
  return view($this->module_view_folder.'.signup',$this->arr_view_data);
}


/*
| Author    : Deepak Bari
| Function  : Store sign details and register a new user.
*/

public function signup_store(Request $request)
{
  $arr_user = $form_data =  [];

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
  $arr_rules['g-recaptcha-response']  = "required";

  $validator = Validator::make($request->all(),$arr_rules);


  if($validator->fails())
  {       
    return redirect()->back()->withErrors($validator)->withInput();  
  }

  $form_data = $request->all();

  $remember_token = md5(uniqid(rand(), true));   

  $arr_user['first_name']                 = isset($form_data['first_name']) ? ucfirst($form_data['first_name']) : '';
  $arr_user['last_name']                  = isset($form_data['last_name']) ? ucfirst($form_data['last_name']) : '';
  $arr_user['email']                      = isset($form_data['email']) ? $form_data['email'] : '';
  $arr_user['mobile_number']              = isset($form_data['mobile_number']) ? $form_data['mobile_number'] : '';
  $arr_user['address']                    = isset($form_data['address']) ? $form_data['address'] : '';
  $arr_user['password']                   = isset($form_data['password']) ? bcrypt($form_data['password']) : '';
  $arr_user['country_phone_code_id']      = isset($form_data['phonecode']) ? base64_decode($form_data['phonecode']) : '';
  $arr_user['status']                     = '1';
  $arr_user['is_email_verified']          = '0';

  $arr_user['remember_token']             = $remember_token;

  $is_user_exits  = 0;
  $is_user_exits  = $this->BaseModel->where('email',$form_data['email'])->count();

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

  $is_user_registered  = $this->BaseModel->create($arr_user);

  if($is_user_registered)
  {
    $id                             =  $is_user_registered->id;
    $arr_mail['user_id']            =  $id;
    $arr_mail['user_type']          =  'User';
    $arr_mail['to_email_id']        =  $form_data['email'];
    $arr_mail['name']               =  $form_data['first_name'];
    $arr_mail['verification_url']   =  url('/').'/user/verify_account/'.base64_encode($id).'/'.$remember_token;

    $status = $this->MailService->send_user_registration_email($arr_mail);

    // Store notification

    $arr_noti['user_id']                =  '1';  //receiver user id
    $arr_noti['receiver_user_type_id']  =  '1';
    $arr_noti['user_type']              =  "User";
    $arr_noti['url']                    =  "user/customers/view/".base64_encode($id);

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


/*
| Author    : Deepak Bari
| Function  : Emai verification
*/

public function verify_account($enc_user_id,$remember_token)
{
  $update_status = $check_verification_token = '';
  $user_id       = base64_decode($enc_user_id);
  $token         = $remember_token;
  $obj_user      = $this->BaseModel->where('id',$user_id)->first();

  if(isset($obj_user->is_email_verified) && $obj_user->is_email_verified==1)
  {
    Session::flash('error','Your account is already verified.');
    return redirect(url('/').'/login');
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
  return redirect(url('/').'/login');    
}

/*
| Author    : Deepak Bari
| Function  : Logut user.
*/

public function logout()
{
  $this->auth->logout();
  Session::flush();
  return redirect(url('/').'/login');
}

}
