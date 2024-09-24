<?php

namespace App\Http\Middleware\Front;

use App\Models\SiteStatusModel;
use App\Models\NotificationsModel;

use Closure;
use Sentinel;
use Request;
use Session;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      /*Do not change any code in this section */
      $arr_user_details = [];
      $this->auth       = auth()->guard('user');

      $user_image_base_path      = base_path().config('app.project.img_path.user_profile_image');
      $user_image_public_path    = url('/').config('app.project.img_path.user_profile_image');
      $default_image_public_path = url('/').config('app.img_path.user_default_img_path');
      
      view()->share('user_image_base_path',$user_image_base_path);
      view()->share('user_image_public_path',$user_image_public_path);
      view()->share('default_image_public_path',$default_image_public_path);
      view()->share('user_panel_slug',config('app.project.user_panel_slug'));

      if($this->auth->user())
      { 
        $arr_user_details = $this->auth->user()->toArray();
        view()->share('arr_user_details',$arr_user_details);
        return $next($request);
      }
      else
      { 
        $segment = \Request::segment(1);
        if (isset($segment) && ($segment=='shopping_cart')) 
        {
           Session::put('return_url',$segment);
        }
        $this->auth->logout();
        return redirect(url('/').'/login');
      }
    }

  }
