<?php

namespace App\Http\Middleware\Supplier;

use Closure;

class AuthMiddleware
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
        $this->auth = auth()->guard('supplier');

        view()->share('supplier_panel_slug',config('app.project.supplier_panel_slug'));

        if($this->auth->user() && $this->auth->user()->status)
        { 
            $super_supplier_details = $this->auth->user()->toArray();
            view()->share('shared_supplier_details',$super_supplier_details);
            view()->share('profile_image_base_img_path',base_path().config('app.project.img_path.supplier_profile_image'));
            view()->share('profile_image_public_img_path',url('/').config('app.project.img_path.supplier_profile_image'));
            view()->share('default_img_path',url('/').config('app.project.img_path.user_default_img_path'));
            update_final_price();
            return $next($request);
        }
        else
        { 
            $this->auth->logout();
            return redirect(config('app.project.supplier_panel_slug'));
        }
    }
}
