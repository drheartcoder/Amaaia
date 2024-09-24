<?php

namespace App\Http\Controllers\Front\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\BankDetailsModel;

use Validator;
use Session;
use Hash;

class AccountSettingController extends Controller
{
    function __construct(
      UserModel $user_model,
      BankDetailsModel $bank_detail_smodel
  )
    {
        $this->module_title                  = "My Account";
        $this->module_url_path               = url('/user/my_account');
        $this->module_view_folder            = "front.user.my_account";
        $this->module_icon                   = "fa fa-cogs";
        $this->user_panel_slug               = config('app.project.user_panel_slug');
        $this->BaseModel                     = $user_model; 
        $this->BankDetailsModel              = $bank_detail_smodel;            

        $this->user_profile_image_base_path   = base_path().config('app.project.img_path.user_profile_image');
        $this->user_profile_image_public_path = url('/').config('app.project.img_path.user_profile_image');
    }
    /*
    | Name : Deepak Bari
    | Function : Edit account details page including password change and bank a/c detils.
    | Date : 10-05-2018
    */
    public function index($tab_id = false)
    {
        $arr_personal_info = $arr_bank_account_details = [];
        $obj_personal_info = login_user_details('user');
        if($obj_personal_info)
        {
            $arr_personal_info = $obj_personal_info->toArray();
        }

        $login_user_id = login_user_id('user');
        $obj_bank_account_details = $this->BankDetailsModel->where([
                                                                    'user_id'   => $login_user_id,
                                                                    'user_type' => '2',
                                                                   ])->first();
        if($obj_bank_account_details)
        {
            $arr_bank_account_details = $obj_bank_account_details->toArray();
        }

        $arr_phonecode                                        = get_phonecode();

        $this->arr_view_data['arr_phonecode']                 = $arr_phonecode;
        $this->arr_view_data['arr_bank_account_details']      = $arr_bank_account_details;
        $this->arr_view_data['arr_personal_info']             = $arr_personal_info;
        $this->arr_view_data['page_title']                    = $this->module_title;
        $this->arr_view_data['parent_module_title']           = "Home";
        $this->arr_view_data['parent_module_url']             = url('/').'/user/dashboard';
        $this->arr_view_data['module_title']                  = $this->module_title;

        $this->arr_view_data['module_url_path']                = $this->module_url_path;

        $this->arr_view_data['tab_id']                         = $tab_id;

        $this->arr_view_data['user_panel_slug']                = $this->user_panel_slug;

        $this->arr_view_data['user_profile_image_base_path']   =$this->user_profile_image_base_path;
        $this->arr_view_data['user_profile_image_public_path'] =$this->user_profile_image_public_path;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    /*
    | Name : Deepak Bari
    | Function : Update user account details.
    | Date : 10-05-2018
    */

    public function update(Request $request)
    {
        $id        = login_user_id('user');
        $arr_rules = array();
        
        $arr_rules['first_name']            = "required";
        $arr_rules['last_name']             = "required"; 
        $arr_rules['gender']                = "required"; 
        $arr_rules['mobile_number']         = "required|min:7|max:16";
        $arr_rules['address']               = "required|max:550";
        $arr_rules['phonecode']             = "required";

        $file_name = "";
        
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            return redirect($this->module_url_path)->withErrors($validator)->withInput();  
        }
        
        $old_image = $request->input('oldimage');
        
        if($request->hasFile('profile_image'))
        {
            $file_name = $request->input('profile_image');
            $file_extension = strtolower($request->file('profile_image')->getClientOriginalExtension());
            if(in_array($file_extension,['png','jpg','jpeg']))
            {
                $file_name = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                $isUpload = $request->file('profile_image')->move($this->user_profile_image_base_path , $file_name);
                if($isUpload)
                {
                    if ($old_image!="" && $old_image!=null) 
                    {
                        if (file_exists($this->user_profile_image_base_path.$old_image))
                        {
                            @unlink($this->user_profile_image_base_path.$old_image);
                        }
                    }
                }
            }
            else
            {
                Session::flash('error','Invalid File type, While creating '.str_singular($this->module_title));
                
                return redirect($this->module_url_path);
            }
        }
        else
        {
         $file_name= isset($old_image) ? $old_image : '';
     }

     $arr_data['profile_image']         = $file_name;
     $arr_data['first_name']            = trim(ucfirst(strtolower($request->input('first_name'))));
     $arr_data['last_name']             = trim(ucfirst(strtolower($request->input('last_name'))));
     $arr_data['gender']                = trim(ucfirst(strtolower($request->input('gender'))));
     $arr_data['mobile_number']         = $request->input('mobile_number');
     $arr_data['address']               = trim($request->input('address'));
     $arr_data['country_phone_code_id'] = base64_decode($request->input('phonecode'));
     
     $obj_data = $this->BaseModel->where('id',$id)->update($arr_data);

     if($obj_data)
     {
         Session::flash('success','Account information updated successfully.');
     }
     else
     {
         Session::flash('error','Problem occurred, while updating personal details.');
     }
     
     return redirect($this->module_url_path);
 }

    /*
    | Name : Deepak Bari
    | Function : Update user password.
    | Date : 10-05-2018
    */

    public function update_password(Request $request, $id)
    {
        $id = base64_decode($id);

        $user_details = [];
        $user_details     = $this->BaseModel->where('id', $id)->first();

        $arr_rules = array();
        $status    = FALSE;

        $arr_rules['old_password']     = "required|min:6|max:16";
        $arr_rules['new_password']     = "required|min:6|max:16";
        $arr_rules['confirm_password'] = "required|same:new_password";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $old_password  =  $request->input('old_password');
        $new_password      =  $request->input('new_password');
        $confirm_password  =  $request->input('confirm_password');
        
        if(Hash::check($old_password,$user_details->password))
        {
            if($old_password!=$new_password)
            {
                if($new_password == $confirm_password)
                {
                    $user_password       = Hash::make($confirm_password);
                    $is_password_changed = $this->BaseModel->where('id',$id)->update(['password'=>$user_password]);
                    
                    if($is_password_changed)
                    {
                        Session::flash('success','Your password changed successfully.');
                    }
                    else
                    {
                        Session::flash('error','Problem occured, while changing password.');
                    }
                }
                else
                {
                    Session::flash('error','New password and confirm password does not match.');
                }
            }
            else
            {
                Session::flash('error','Sorry you can\'t use old password as new password, Please enter another password.');
            }
        }
        else
        {
            Session::flash('error',"Incorrect old password");
        }

        return redirect($this->module_url_path.'/2');
    }

    /*
    | Name : Deepak Bari
    | Function : Update bank account details.
    | Date : 10-05-2018
    */

    public function update_bank_details(Request $request,$enc_id = false)
    {
        $arr_rules = array();
        $user_id = "";

        if($enc_id != false)
        {
            $user_id = base64_decode($enc_id);
        }
        
        $arr_rules['bank_name']            = "required";
        $arr_rules['account_holder_name']  = "required";
        $arr_rules['account_no']           = "required";
        $arr_rules['ifsc_code']            = "required";
        
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            return redirect($this->module_url_path.'/3')->withErrors($validator)->withInput();  
        }

        $is_user_avail = $this->BankDetailsModel->where('user_id',$user_id)->where('user_type', '2')->count();

        $arr_data['bank_name']           = $request->input('bank_name');
        $arr_data['branch']              = '';
        $arr_data['account_holder_name'] = $request->input('account_holder_name');
        $arr_data['account_number']      = $request->input('account_no');
        $arr_data['ifsc_code']           = $request->input('ifsc_code');
        $arr_data['user_type']           = '2';
        
        if($is_user_avail > 0)
        {
            $obj_data = $this->BankDetailsModel->where('user_id',$user_id)->where('user_type', '2')->update($arr_data);
        }
        else
        {
            $arr_data['user_id'] = $user_id;
            $obj_data = $this->BankDetailsModel->create($arr_data);
        }

        if($obj_data)
        {
            Session::flash('success','Bank account details updated successfully.');
        }
        else
        {
            Session::flash('error','Problem occurred, while updating bank account details.');
        }
        
        return redirect($this->module_url_path.'/3');
    }

}
