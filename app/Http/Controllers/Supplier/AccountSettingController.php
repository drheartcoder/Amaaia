<?php

namespace App\Http\Controllers\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SupplierModel;
use App\Models\SupplierBusinessDetailsModel;
use App\Models\BankDetailsModel;
use Validator;
use Session;
use Hash;

class AccountSettingController extends Controller
{
	function __construct(
                            SupplierModel $supplier_model,
                            SupplierBusinessDetailsModel $supplier_business_detail_smodel,
                            BankDetailsModel $bank_detail_smodel
                        )
    {
        $this->module_title                  = "Account Setting";
        $this->module_url_path               = url('/supplier/account_setting');
        $this->module_view_folder            = "supplier.account_setting";
        $this->module_icon                   = "fa fa-cogs";
        $this->supplier_panel_slug              = config('app.project.supplier_panel_slug');
        $this->SupplierModel                 = $supplier_model;       
        $this->SupplierBusinessDetailsModel  = $supplier_business_detail_smodel;       
        $this->BankDetailsModel = $bank_detail_smodel;       
        $this->profile_image_base_img_path   = base_path().config('app.project.img_path.supplier_profile_image');
        $this->profile_image_public_img_path = url('/').config('app.project.img_path.supplier_profile_image');
    }

    public function index()
    {

    }

    public function personal_details()
    {
        $arr_supplier_details                        = [];
        $arr_phonecode                               = get_phonecode();
        $this->arr_view_data['arr_phonecode']        = $arr_phonecode;
        $this->arr_view_data['page_title']           = $this->module_title;
        $this->arr_view_data['parent_module_icon']   = "fa fa-home";
        $this->arr_view_data['parent_module_title']  = "Dashboard";
        $this->arr_view_data['parent_module_url']    = url('/').'/supplier/dashboard';
        $this->arr_view_data['module_icon']          = $this->module_icon;
        $this->arr_view_data['module_title']         = $this->module_title;

        $this->arr_view_data['sub_module_title']     =  'Personal Details';
        $this->arr_view_data['sub_module_icon']      =  'fa fa-user';

        $this->arr_view_data['arr_supplier_details'] = $arr_supplier_details;
        
        $this->arr_view_data['supplier_panel_slug']  = $this->supplier_panel_slug;

        return view($this->module_view_folder.'.personal_details',$this->arr_view_data);
    }

    public function personal_details_update(Request $request, $id)
    {
    	$id        = base64_decode($id);
    	$arr_rules = array();
        
        $arr_rules['first_name']            = "required";
        $arr_rules['last_name']             = "required"; 
        $arr_rules['contact']               = "required|min:7|max:16";
        $arr_rules['address']               = "required|max:255";
        $arr_rules['email']                 = "required|email";
        $arr_rules['phonecode']             = "required";

        $file_name = "";
       
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            return redirect()->back()->withErrors($validator)->withInput();  
        }

        $old_image = $request->input('oldimage');
        if($request->hasFile('profile_image'))
        {
            $file_name = $request->input('profile_image');
            $file_extension = strtolower($request->file('profile_image')->getClientOriginalExtension());
            if(in_array($file_extension,['png','jpg','jpeg']))
            {
                $file_name = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                $isUpload = $request->file('profile_image')->move($this->profile_image_base_img_path , $file_name);
                if($isUpload)
                {
                    if ($old_image!="" && $old_image!=null) 
                    {
                        if (file_exists($this->profile_image_base_img_path.$old_image))
                        {
                            @unlink($this->profile_image_base_img_path.$old_image);
                        }

                        if (file_exists($this->profile_image_base_img_path.'/thumb_50X50_'.$old_image)) 
                        {
                            @unlink($this->profile_image_base_img_path.'/thumb_50X50_'.$old_image);
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
             $file_name=$old_image;
        }


        $is_supplier_avail = $this->SupplierModel->where('id',$id)->count();

        $arr_data['profile_image']         = $file_name;
        $arr_data['first_name']            = trim(ucfirst(strtolower($request->input('first_name'))));
        $arr_data['last_name']             = trim(ucfirst(strtolower($request->input('last_name'))));
        $arr_data['mobile_number']         = $request->input('contact');
        $arr_data['address']               = trim($request->input('address'));
        $arr_data['email']                 = trim($request->input('email'));
        $arr_data['country_phone_code_id'] = base64_decode($request->input('phonecode'));

        if($is_supplier_avail > 0)
        {
            $obj_data = $this->SupplierModel->where('id',$id)->update($arr_data);
        }
        else
        {
            $obj_data = $this->SupplierModel->create($arr_data);
        }

        if($obj_data)
        {
            Session::flash('success','Personal details updated successfully');
        }
        else
        {
            Session::flash('error','Problem occurred, while updating personal details');
        }
      
        return redirect()->back();
    
    }

    public function business_details()
    {   
        $arr_business_details = [];
        $supplier_id = 0;
        $supplier_id = login_user_id('supplier');

        $obj_business_details = $this->SupplierBusinessDetailsModel->where('supplier_id',$supplier_id)->first();

        if($obj_business_details)
        {
            $arr_business_details =$obj_business_details->toArray();
        }

        $arr_supplier_details                        = [];
        $arr_phonecode                               = get_phonecode();
        $this->arr_view_data['arr_phonecode']        = $arr_phonecode;
        $this->arr_view_data['supplier_id']          = $supplier_id;
        $this->arr_view_data['page_title']           = $this->module_title;
        $this->arr_view_data['parent_module_icon']   = "fa fa-home";
        $this->arr_view_data['parent_module_title']  = "Dashboard";
        $this->arr_view_data['parent_module_url']    = url('/').'/supplier/dashboard';
        $this->arr_view_data['module_icon']          = $this->module_icon;
        $this->arr_view_data['module_title']         = $this->module_title;

        $this->arr_view_data['sub_module_title']     =  'Business Details';
        $this->arr_view_data['sub_module_icon']      =  'fa fa-briefcase';

        $this->arr_view_data['arr_business_details'] = $arr_business_details;
        
        $this->arr_view_data['supplier_panel_slug']  = $this->supplier_panel_slug;

        return view($this->module_view_folder.'.business_details',$this->arr_view_data);
    }

    public function business_details_update(Request $request,$enc_id = false)
    {
        $arr_rules = array();
        $supplier_id = "";

        if($enc_id != false)
        {
            $supplier_id = base64_decode($enc_id);
        }
        
        $arr_rules['business_name']            = "required";
        $arr_rules['business_reg_no']          = "required"; 
        $arr_rules['pan_no']                   = "required";
        $arr_rules['email']                    = "required|email";
        $arr_rules['phonecode']                = "required";
        $arr_rules['mobile_number']            = "required";

       
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            return redirect()->back()->withErrors($validator)->withInput();  
        }

        $arr_data['business_name']         = $request->input('business_name');
        $arr_data['business_reg_no']       = $request->input('business_reg_no');
        $arr_data['pan_no']                = $request->input('pan_no');
        $arr_data['email']                 = $request->input('email');
        $arr_data['mobile_number']         = $request->input('mobile_number');
       
        $arr_data['country_phone_code_id'] = base64_decode($request->input('phonecode'));

         $is_business_name_exist = $this->SupplierBusinessDetailsModel->where('business_name',$arr_data['business_name'])
                                                                      ->where('supplier_id','<>',$supplier_id)
                                                                      ->count();

         if($is_business_name_exist > 0)
         {
             Session::flash('error','This business name is already exist.');
             return redirect()->back()->withErrors($validator)->withInput();
         }

         $is_supplier_avail = $this->SupplierBusinessDetailsModel->where('supplier_id',$supplier_id)->count();

        if($is_supplier_avail > 0)
        {
            $obj_data = $this->SupplierBusinessDetailsModel->where('supplier_id',$supplier_id)->update($arr_data);
        }
        else
        {
            $arr_data['supplier_id'] = $supplier_id;
            $obj_data = $this->SupplierBusinessDetailsModel->create($arr_data);
        }

        if($obj_data)
        {
            Session::flash('success','Business details updated successfully');
        }
        else
        {
            Session::flash('error','Problem occurred, while updating business details');
        }
      
        return redirect()->back();
    }

    public function financial_details()
    {   
        $arr_financial_details = [];
        $supplier_id = 0;
        $supplier_id = login_user_id('supplier');

        $obj_financial_details = $this->BankDetailsModel->where('user_id',$supplier_id)->where('user_type', '3')
                                                                     ->first();

$obj_commission = $this->SupplierModel->where('id', $supplier_id)->first(['admin_commission']);

        if($obj_financial_details)
        {
            $arr_financial_details =$obj_financial_details->toArray();
        }

        $arr_supplier_details                        = [];
        $arr_phonecode                               = get_phonecode();
        $this->arr_view_data['arr_phonecode']       = $arr_phonecode;
        $this->arr_view_data['obj_commission']      = $obj_commission;
        $this->arr_view_data['supplier_id']         = $supplier_id;
        $this->arr_view_data['page_title']          = $this->module_title;
        $this->arr_view_data['parent_module_icon']  = "fa fa-home";
        $this->arr_view_data['parent_module_title'] = "Dashboard";
        $this->arr_view_data['parent_module_url']   = url('/').'/supplier/dashboard';
        $this->arr_view_data['module_icon']         = $this->module_icon;
        $this->arr_view_data['module_title']        = $this->module_title;

        $this->arr_view_data['sub_module_title']     =  'Financial Details';
        $this->arr_view_data['sub_module_icon']      =  'fa fa-money';

        $this->arr_view_data['arr_financial_details'] = $arr_financial_details;
        // dd($arr_financial_details);
        
        $this->arr_view_data['supplier_panel_slug']  = $this->supplier_panel_slug;

        return view($this->module_view_folder.'.financial_details',$this->arr_view_data);
    }

    public function financial_details_update(Request $request,$enc_id = false)
    {
        $arr_rules = array();
        $supplier_id = "";

        if($enc_id != false)
        {
            $supplier_id = base64_decode($enc_id);
        }
        
        $arr_rules['bank_name']            = "required";
        $arr_rules['branch_name']          = "required"; 
        $arr_rules['account_holder_name']  = "required";
        $arr_rules['account_no']           = "required";
        $arr_rules['ifsc_code']            = "required";
        

       
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            return redirect()->back()->withErrors($validator)->withInput();  
        }

        $is_supplier_avail = $this->BankDetailsModel->where('user_id',$supplier_id)->where('user_type', '3')->count();

        $arr_data['bank_name']           = $request->input('bank_name');
        $arr_data['branch']              = $request->input('branch_name');
        $arr_data['account_holder_name'] = $request->input('account_holder_name');
        $arr_data['account_number']      = $request->input('account_no');
        $arr_data['ifsc_code']           = $request->input('ifsc_code');
            $arr_data['user_type'] = '3';
       
        if($is_supplier_avail > 0)
        {
            $obj_data = $this->BankDetailsModel->where('user_id',$supplier_id)->where('user_type', '3')->update($arr_data);
        }
        else
        {
            $arr_data['user_id'] = $supplier_id;
            $obj_data = $this->BankDetailsModel->create($arr_data);
        }

        if($obj_data)
        {
            Session::flash('success','Financial details updated successfully.');
        }
        else
        {
            Session::flash('error','Problem occurred, while updating financial details.');
        }
      
        return redirect()->back();
    }

    public function change_password()
    {
        $this->arr_view_data['arr_final_tile']       = array();

        $this->arr_view_data['page_title']           = "Change Password";
        $this->arr_view_data['parent_module_icon']   = "icon-home2";
        $this->arr_view_data['parent_module_title']  = "Dashboard";
        $this->arr_view_data['parent_module_url']    = url('/').'/supplier/dashboard';
        $this->arr_view_data['module_icon']          = "fa fa-key";
        $this->arr_view_data['module_title']         = "Change Password";
        
        $this->arr_view_data['supplier_panel_slug']     = $this->supplier_panel_slug;

        return view($this->module_view_folder.'.change_password',$this->arr_view_data);
    }

    public function update_password(Request $request, $id)
    {
        $id = base64_decode($id);

        $supplier_details = [];
        $supplier_details     = $this->SupplierModel->where('id', $id)->first();

        $arr_rules = array();
        $status    = FALSE;

        $arr_rules['current_password'] = "required|min:6|max:16";
        $arr_rules['new_password']     = "required|min:6|max:16";
        $arr_rules['confirm_password'] = "required|same:new_password";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $current_password  =  $request->input('current_password');
        $new_password      =  $request->input('new_password');
        $confirm_password  =  $request->input('confirm_password');
      
        if(Hash::check($current_password,$supplier_details->password))
        {
            if($current_password!=$new_password)
            {
                if($new_password == $confirm_password)
                {
                    $user_password       = Hash::make($confirm_password);
                    $is_password_changed = $this->SupplierModel->where('id',$id)->update(['password'=>$user_password]);
                    
                    if($is_password_changed)
                    {
                        Session::flash('success','Your password changed successfully.');
                    }
                    else
                    {
                        Session::flash('error','Problem occured, while changing password');
                    }

                    return redirect()->back();
                }
                else
                {
                    Session::flash('error','New password and confirm password does not match.');
                    return redirect()->back();
                }
            }
            else
            {
                Session::flash('error','Sorry you can\'t use current password as new password, Please enter another password');
                    return redirect()->back();
            }
        }
        else
        {
            Session::flash('error',"Incorrect current password");
            return redirect()->back();
        }

       Session::flash('error','Problem occured, while changing password');
       return redirect()->back();
    }
}
