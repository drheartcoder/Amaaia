<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Models\WebAdminModel;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;

use Validator;
use Config;
use DB;
use Session;
use Hash;

class PasswordController extends Controller
{
    use ResetsPasswords;
    function __construct(WebAdminModel $web_admin_model, HasherContract $hasher)
    {
        $this->hasher             = $hasher;
        $this->module_title       = "Password";
        $this->module_url_path    = url('/admin');
        $this->module_view_folder = "admin.auth";
        $this->admin_panel_slug   = config('app.project.admin_panel_slug');
        $this->auth               = auth()->guard('admin');

        $this->admin_id           = isset($this->auth->user()->id)? $this->auth->user()->id:15;

        $this->WebAdminModel      = $web_admin_model;

        Config::set("auth.defaults.passwords","admin");
    }

    public function forgot_password()
    {
        $this->arr_view_data['module_title']     = 'Forgot '.$this->module_title;
        $this->arr_view_data['page_title']       = 'Forgot '.$this->module_title." Login";
        $this->arr_view_data['admin_panel_slug'] = $this->admin_panel_slug;

        return view($this->module_view_folder.'.forgot_password',$this->arr_view_data); 
    }

    public function postEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        Config::set("auth.password_hasher","off"); //turn off password hashing
        Config::set("auth.use_custom_template","on"); //turn on custom templates
        Config::set("auth.user_mode","admin"); //sets user mode for sending email

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

        $password_reset = DB::table('admin_password_resets')->where('token',$token)->first();

        if($password_reset != NULL)
        {
            $this->arr_view_data['token']            = $token;
            $this->arr_view_data['password_reset']   = (array)$password_reset;
            $this->arr_view_data['admin_panel_slug'] = $this->admin_panel_slug;
            $this->arr_view_data['module_url_path']  = $this->module_url_path;

            return view('admin.auth.reset_password',$this->arr_view_data);    
        }
        else
        {
            return redirect($this->module_url_path)->with('error', 'Your reset password link has been expired.');
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

            return view('admin.auth.reset_password',$this->arr_view_data);    
        }
        else
        {
            return redirect($this->module_url_path)->with('error_login', 'Your password reset link was expired.');
        }
    }

    public function postReset(Request $request)
    {
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
