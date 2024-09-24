<?php

namespace App\Http\Controllers\Front\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Models\UserModel;

use Validator;
use Config;
use Session;
use DB;

class PasswordController extends Controller
{
    use ResetsPasswords;
	public function __construct(UserModel $user_model)
	{
		$this->arr_view_data      = [];
		$this->UserModel          = $user_model;
		$this->module_view_folder = 'front.user.auth.';
		$this->auth               = auth()->guard('user');

		Config::set("auth.defaults.passwords","user");
	}

	public function index()
	{
        $this->arr_view_data['page_title'] = 'Forgot Password';
        return view($this->module_view_folder.'forgot_password', $this->arr_view_data);
    }

    public function postEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        Config::set("auth.password_hasher","off"); //turn off password hashing
        Config::set("auth.use_custom_template","on"); //turn on custom templates
        Config::set("auth.user_mode","user"); //sets user mode for sending email

        $response = Password::sendResetLink($request->only('email'), function($m)
        {
            $m->subject(config('app.project.name').' : Your Password Reset Link');
        });

        switch ($response)
        {
            case Password::RESET_LINK_SENT:
            Session::flash('success', 'We have e-mailed your password reset link!');
            return redirect()->back()->with('status', trans($response));

            case Password::INVALID_USER:
            Session::flash('invalid_email', true);
            Session::flash('error', trans($response));
            return redirect()->back();
        }
    }

    public function get_email($token)
    {
        if (is_null($token)) 
        {
            return redirect(url('/login'))->with('error', 'Your reset password link has been expired.');
        }

        $password_reset = DB::table('users_password_resets')->where('token',$token)->first();

        if($password_reset != NULL)
        {
		$this->arr_view_data['page_title'] = 'Reset Password';
            $this->arr_view_data['token']          = $token;
            $this->arr_view_data['password_reset'] = (array)$password_reset;

            return view($this->module_view_folder.'reset_password',$this->arr_view_data);    
        }
        else
        {
            return redirect(url('/login'))->with('error', 'Your reset password link has been expired.');
        }
    }


    public function postReset(Request $request)
    {
        Config::set("auth.password_hasher","off");
        
        $arr_rules      = array();
        $status         = false;
        
        $arr_rules['token']    = 'required';
        $arr_rules['email']    = "required|email";
        $arr_rules['password'] = "required|confirmed|min:6";
        
        $validator = validator::make($request->all(),$arr_rules);

        if($validator->fails()) 
        {
            return back()->withErrors($validator)->withInput();
        }

    	$credentials = $request->only(
    		'email', 'password', 'password_confirmation', 'token'
    		);
    	$response = Password::reset($credentials, function ($user, $password) {
    		$this->resetPassword($user, $password);
    	});

    	switch ($response) {

    		case Password::PASSWORD_RESET:

    		return redirect(url('/login'))->with('success','Your Password has been reset successfully');

    		default:

    		return redirect()->back()
    		->withInput($request->only('email'))
    		->with('error', trans($response))
    		->withErrors(['email' => trans($response)]);
    	}
    }
}
