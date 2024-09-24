<?php

namespace App\Http\Controllers\supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Models\SupplierModel;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Validator;

use Config;
use DB;
use Session;
use Hash;

class PasswordController extends Controller
{
    use ResetsPasswords;
    function __construct(SupplierModel $supplier_model, HasherContract $hasher)
    {
        $this->hasher              = $hasher;
        $this->module_title        = "Password";
        $this->module_url_path     = url('/supplier');
        $this->module_view_folder  = "supplier.auth";
        $this->supplier_panel_slug = config('app.project.supplier_panel_slug');
        $this->auth                = auth()->guard('supplier');

        $this->supplier_id         = isset($this->auth->user()->id)? $this->auth->user()->id:15;

        $this->WebsupplierModel    = $supplier_model;

        Config::set("auth.defaults.passwords","supplier");
    }

    public function forgot_password()
    {
        $this->arr_view_data['module_title']        = 'Forgot '.$this->module_title;
        $this->arr_view_data['page_title']          = 'Forgot '.$this->module_title." Login";
        $this->arr_view_data['supplier_panel_slug'] = $this->supplier_panel_slug;

        return view($this->module_view_folder.'.forgot_password',$this->arr_view_data); 
    }

    public function postEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        Config::set("auth.password_hasher","off"); //turn off password hashing
        Config::set("auth.use_custom_template","on"); //turn on custom templates
        Config::set("auth.user_mode","supplier"); //sets user mode for sending email

        $obj_supplier = $this->WebsupplierModel->where('email',$request->email)->first();

        if($obj_supplier)
        {
            if($obj_supplier->is_email_verified == 0)
            {
                 return redirect()->back()->with('error', 'Your account is not verified yet! Please check your email inbox to verify account.');
            }
        }

        $response = Password::sendResetLink($request->only('email'), function($m)
        {
            $m->subject(config('app.project.name').' : Your Password Reset Link');
        });

        switch ($response)
        {
            case Password::RESET_LINK_SENT:
            Session::flash('success_password', 'We have e-mailed your password reset link!');
            return redirect()->back()->with('status', trans($response));

            case Password::INVALID_USER:
            Session::flash('invalid_email', true);
            Session::flash('error_password', trans($response));
            return redirect()->back();
        }
    }

    public function get_email($token)
    {
        if (is_null($token)) 
        {
            return redirect($this->module_url_path)->with('error', 'Your reset password link has been expired.');
        }

        $password_reset = DB::table('supplier_password_resets')->where('token',$token)->first();

        if($password_reset != NULL)
        {
            $this->arr_view_data['token']               = $token;
            $this->arr_view_data['password_reset']      = (array)$password_reset;
            $this->arr_view_data['supplier_panel_slug'] = $this->supplier_panel_slug;
            $this->arr_view_data['module_url_path']     = $this->module_url_path;

            return view('supplier.auth.reset_password',$this->arr_view_data);    
        }
        else
        {
            return redirect($this->module_url_path)->with('error', 'Your password reset link was expired.');
        }
    }

    public function getReset($token = null)
    {
        if (is_null($token)) 
        {
            return redirect($this->module_url_path)->with('error_login', 'Your reset password link has been expired.');
        }

        $email = $this->get_email($token);

        if(!$email)
        {
            return redirect($this->module_url_path)->with('error_login', 'Your reset password link has been expired.');
        }

        if($email != NULL)
        {
            $this->arr_view_data['token']            = $token;
            $this->arr_view_data['email']            = $email;
            $this->arr_view_data['module_url']  = $this->module_url_path;

            return view('supplier.auth.reset_password',$this->arr_view_data);    
        }
        else
        {
            return redirect($this->module_url_path)->with('error_login', 'Your password reset link was expired.');
        }
    }

public function postReset(Request $request)
    {
        // dd($request->all());
        Config::set("auth.password_hasher","off");

        $this->validate($request, [
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
        $response = Password::reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        switch ($response) {

            case Password::PASSWORD_RESET:

            return redirect($this->module_url_path)->with('success','Your Password has been reset successfully');

            default:

            return redirect()->back()
            ->withInput($request->only('email'))
            ->with('error', trans($response))
            ->withErrors(['email' => trans($response)]);
        }
    }


}


