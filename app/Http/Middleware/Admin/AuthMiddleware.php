<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\NotificationsModel;


class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $this->auth = auth()->guard('admin');

        view()->share('admin_panel_slug',config('app.project.admin_panel_slug'));

        if($this->auth->user())
        { 
            $super_admin_details = $this->auth->user()->toArray();
            view()->share('shared_admin_details',$super_admin_details);
            view()->share('profile_image_base_img_path',base_path().config('app.project.img_path.admin_profile_image'));
            view()->share('profile_image_public_img_path',url('/').config('app.project.img_path.admin_profile_image'));
            view()->share('default_img_path',url('/').config('app.project.img_path.user_default_img_path'));
          update_final_price();  
            return $next($request);
        }
        else
        { 
        	$this->auth->logout();
            return redirect(config('app.project.admin_panel_slug'));
        }
    }
}
