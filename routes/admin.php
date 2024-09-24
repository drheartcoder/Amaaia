<?php
$web_admin_path =config('app.project.admin_panel_slug');

// ------------Before Login Routes----------------

Route::group(array('prefix' => $web_admin_path,'middleware'=>'admin_auth_check'), function ()
{
	$route_slug = 'admin_';
	$module_controller = "Admin\AuthController@";

	Route::get('/',                         ['as' =>$route_slug.'login', 'uses' => $module_controller.'login']);
	Route::post('validate_login',			['as' =>$route_slug.'validate', 'uses' => $module_controller.'validate_login']);

	$module_controller = "Admin\PasswordController@";


	Route::get('forgot_password',			['as' =>$route_slug.'forgot_password', 'uses' => $module_controller.'forgot_password']);

	Route::post('forgot_password/post_email',			['as' =>$route_slug.'forgot_password_post_email', 'uses' => $module_controller.'postEmail']);

	Route::post('forgot_password/postReset',			['as' =>$route_slug.'forgot_password_post_reset', 'uses' => $module_controller.'postReset']);


	Route::get('/reset_password/{token?}', ['uses' =>$module_controller.'get_email'])->name('password.reset');

});

Route::group(array('prefix' => $web_admin_path), function ()
{
	$route_slug = 'admin_';
	$module_controller = "Admin\AuthController@";
	Route::get('logout',					['as' =>$route_slug.'logout', 'uses' => $module_controller.'logout']);
});


// ----------------------After login routes--------------------------

Route::group(array('prefix' => $web_admin_path,'middleware'=>'auth_admin'), function () use($web_admin_path)
{
	$route_slug = 'admin_';


	$module_controller = "Admin\DashboardController@";
	Route::get('/dashboard',['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);

	$module_controller = "Admin\AccountSettingController@";

	Route::get('password/change',			['as' =>$route_slug.'change_password', 'uses' => $module_controller.'change_password']);
	Route::post('password/update',			['as' =>$route_slug.'update_password', 'uses' => $module_controller.'update_password']);

	Route::get('account_setting',			['as' =>$route_slug.'account_setting', 'uses' => $module_controller.'index']);
	Route::post('account_setting/update',	['as' =>$route_slug.'account_setting', 'uses' => $module_controller.'update']);
	Route::post('account_setting/bank/update',	['as' =>$route_slug.'update_bank_details', 'uses' => $module_controller.'update_bank_details']);

	$module_controller = "Admin\SiteSettingController@";

	Route::get('site_setting',			    ['as' =>$route_slug.'site_setting', 'uses' => $module_controller.'index']);
	Route::post('site_setting/update',			['as' =>$route_slug.'update_password', 'uses' => $module_controller.'update']);

	Route::group(array('prefix' => 'front_pages'), function () use($web_admin_path)
	{
		$route_slug        = "front_pages_";
		$module_controller = "Admin\FrontPagesController@";
		Route::get('/',['as' => $route_slug.'manage', 'uses' => $module_controller.'index']);
		Route::get('/create',['as' => $route_slug.'create', 'uses' => $module_controller.'create']);
		Route::post('/store',['as' => $route_slug.'create', 'uses' => $module_controller.'store']);
		Route::get('/load_data',['as' =>$route_slug.'load_data', 'uses' => $module_controller.'load_data']);
		Route::get('/edit/{enc_id}',['as' => $route_slug.'edit', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id?}',['as' =>$route_slug.'update', 'uses' => $module_controller.'update']);
		Route::get('/block/{id?}',	['as' =>$route_slug.'categories', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id?}',['as' =>$route_slug.'categories', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{enc_id}',['as' => $route_slug.'delete', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',['as' => $route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'categories'), function () use($route_slug)
	{
		$module_controller = "Admin\CategoryController@";

		Route::get('/',				['as' =>$route_slug.'categories', 'uses' => $module_controller.'index']);
		Route::get('/create',		['as' =>$route_slug.'categories', 'uses' => $module_controller.'create']);
		Route::post('/store',		['as' =>$route_slug.'categories', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id?}',	['as' =>$route_slug.'categories', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id?}',['as' =>$route_slug.'categories', 'uses' => $module_controller.'update']);
		Route::get('/load_data',['as' =>$route_slug.'load_data', 'uses' => $module_controller.'load_data']);
		Route::get('/block/{id?}',	['as' =>$route_slug.'categories', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id?}',['as' =>$route_slug.'categories', 'uses' => $module_controller.'unblock']);
		Route::post('/multi_action',['as' =>$route_slug.'categories', 'uses' => $module_controller.'multi_action']);

	});
	Route::group(array('prefix' => 'sub_categories'), function () use($route_slug)
	{
		$module_controller = "Admin\SubCategoryController@";

		Route::get('/',				['as' =>$route_slug.'create', 'uses' => $module_controller.'index']);
		Route::get('/create',		['as' =>$route_slug.'create', 'uses' => $module_controller.'create']);
		Route::get('/get_category',		['as' =>$route_slug.'get_category', 'uses' => $module_controller.'get_category_by_product_type']);
		Route::post('/store',		['as' =>$route_slug.'store', 'uses' => $module_controller.'store']);
		Route::get('/load_data',['as' =>$route_slug.'load_data', 'uses' => $module_controller.'load_data']);
		Route::get('/edit/{id?}',	['as' =>$route_slug.'edit', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id?}',['as' =>$route_slug.'update', 'uses' => $module_controller.'update']);
		Route::get('/block/{id?}',	['as' =>$route_slug.'categories', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id?}',['as' =>$route_slug.'categories', 'uses' => $module_controller.'unblock']);
		Route::post('/multi_action',['as' =>$route_slug.'categories', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'metals'), function () use($route_slug)
	{
		$module_controller = "Admin\MetalController@";		
		Route::get('/manage',				['as' =>$route_slug.'categories', 'uses' => $module_controller.'index']);
		Route::get('/load',		['as' =>$route_slug.'categories', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		['as' =>$route_slug.'categories', 'uses' => $module_controller.'create']);
		Route::post('/store',		['as' =>$route_slug.'categories', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',		['as' =>$route_slug.'categories', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',		['as' =>$route_slug.'categories', 'uses' => $module_controller.'update']);
		Route::get('/block/{id}',		['as' =>$route_slug.'categories', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',		['as' =>$route_slug.'categories', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',		['as' =>$route_slug.'categories', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',		['as' =>$route_slug.'categories', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'brands'), function () use($route_slug)
	{
		$module_controller = "Admin\BrandController@";		
		Route::get('/manage',				['as' =>$route_slug.'brands', 'uses' => $module_controller.'index']);
		Route::get('/load',		['as' =>$route_slug.'brands', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		['as' =>$route_slug.'brands', 'uses' => $module_controller.'create']);
		Route::post('/store',		['as' =>$route_slug.'brands', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',		['as' =>$route_slug.'brands', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',		['as' =>$route_slug.'brands', 'uses' => $module_controller.'update']);
		Route::get('/block/{id}',		['as' =>$route_slug.'brands', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',		['as' =>$route_slug.'brands', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',		['as' =>$route_slug.'brands', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',		['as' =>$route_slug.'brands', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'metal_colors'), function () use($route_slug)
	{
		$module_controller = "Admin\MetalColorController@";		
		Route::get('/',				['as' =>$route_slug.'colors', 'uses' => $module_controller.'index']);
		Route::get('/manage',				['as' =>$route_slug.'colors', 'uses' => $module_controller.'index']);
		Route::get('/load',		['as' =>$route_slug.'colors', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		['as' =>$route_slug.'colors', 'uses' => $module_controller.'create']);
		Route::post('/store',		['as' =>$route_slug.'colors', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',		['as' =>$route_slug.'colors', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',		['as' =>$route_slug.'colors', 'uses' => $module_controller.'update']);
		Route::get('/block/{id}',		['as' =>$route_slug.'colors', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',		['as' =>$route_slug.'colors', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',		['as' =>$route_slug.'colors', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',		['as' =>$route_slug.'colors', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'gemstone_colors'), function () use($route_slug)
	{
		$module_controller = "Admin\GemstoneColorController@";		
		Route::get('/',				['as' =>$route_slug.'colors', 'uses' => $module_controller.'index']);
		Route::get('/manage',				['as' =>$route_slug.'colors', 'uses' => $module_controller.'index']);
		Route::get('/load',		['as' =>$route_slug.'colors', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		['as' =>$route_slug.'colors', 'uses' => $module_controller.'create']);
		Route::post('/store',		['as' =>$route_slug.'colors', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',		['as' =>$route_slug.'colors', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',		['as' =>$route_slug.'colors', 'uses' => $module_controller.'update']);
		Route::get('/block/{id}',		['as' =>$route_slug.'colors', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',		['as' =>$route_slug.'colors', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',		['as' =>$route_slug.'colors', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',		['as' =>$route_slug.'colors', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'metal_detailing'), function () use($route_slug)
	{
		$module_controller = "Admin\MetalDetailingController@";		
		Route::get('/manage',				['as' =>$route_slug.'metal_detailing', 'uses' => $module_controller.'index']);
		Route::get('/load',		['as' =>$route_slug.'metal_detailing', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		['as' =>$route_slug.'metal_detailing', 'uses' => $module_controller.'create']);
		Route::post('/store',		['as' =>$route_slug.'metal_detailing', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',		['as' =>$route_slug.'metal_detailing', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',		['as' =>$route_slug.'metal_detailing', 'uses' => $module_controller.'update']);
		Route::get('/block/{id}',		['as' =>$route_slug.'metal_detailing', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',		['as' =>$route_slug.'metal_detailing', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',		['as' =>$route_slug.'metal_detailing', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',		['as' =>$route_slug.'metal_detailing', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'metal_qualities'), function () use($route_slug)
	{
		$module_controller = "Admin\MetalQualityController@";		
		Route::get('/manage',				['as' =>$route_slug.'qualities', 'uses' => $module_controller.'index']);
		Route::get('/',				['as' =>$route_slug.'qualities', 'uses' => $module_controller.'index']);
		Route::get('/load',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'create']);
		Route::post('/store',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'update']);
		Route::get('/block/{id}',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'gemstone_qualities'), function () use($route_slug)
	{
		$module_controller = "Admin\GemstoneQualityController@";		
		Route::get('/manage',				['as' =>$route_slug.'qualities', 'uses' => $module_controller.'index']);
		Route::get('/',				['as' =>$route_slug.'qualities', 'uses' => $module_controller.'index']);
		Route::get('/load',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'create']);
		Route::post('/store',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'update']);
		Route::get('/block/{id}',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'multi_action']);

	});


	Route::group(array('prefix' => 'gemstone_shapes'), function () use($route_slug)
	{
		$module_controller = "Admin\GemstoneShapesController@";		
		Route::get('/manage',				['as' =>$route_slug.'qualities', 'uses' => $module_controller.'index']);
		Route::get('/',				['as' =>$route_slug.'qualities', 'uses' => $module_controller.'index']);
		Route::get('/load',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'create']);
		Route::post('/store',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'update']);
		Route::get('/block/{id}',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',		['as' =>$route_slug.'qualities', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'insurance_details'), function () use($route_slug)
	{
		$module_controller = "Admin\InsuranceDetailsController@";		
		Route::get('/manage',				['as' =>$route_slug.'insurance_details', 'uses' => $module_controller.'index']);
		Route::get('/load',		['as' =>$route_slug.'insurance_details', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		['as' =>$route_slug.'insurance_details', 'uses' => $module_controller.'create']);
		Route::post('/store',		['as' =>$route_slug.'insurance_details', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',		['as' =>$route_slug.'insurance_details', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',		['as' =>$route_slug.'insurance_details', 'uses' => $module_controller.'update']);
		Route::get('/block/{id}',		['as' =>$route_slug.'insurance_details', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',		['as' =>$route_slug.'insurance_details', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',		['as' =>$route_slug.'insurance_details', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',		['as' =>$route_slug.'insurance_details', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'blog_categories'), function () use($route_slug)
	{
		$module_controller = "Admin\BlogCategoriesController@";		
		Route::get('/manage',				['as' =>$route_slug.'blog_categories', 'uses' => $module_controller.'index']);
		Route::get('/load',		['as' =>$route_slug.'blog_categories', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		['as' =>$route_slug.'blog_categories', 'uses' => $module_controller.'create']);
		Route::post('/store',		['as' =>$route_slug.'blog_categories', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',		['as' =>$route_slug.'blog_categories', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',		['as' =>$route_slug.'blog_categories', 'uses' => $module_controller.'update']);
		Route::get('/block/{id}',		['as' =>$route_slug.'blog_categories', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',		['as' =>$route_slug.'blog_categories', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',		['as' =>$route_slug.'blog_categories', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',		['as' =>$route_slug.'blog_categories', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'blogs'), function () use($route_slug)
	{
		$module_controller = "Admin\BlogController@";		
		Route::get('/manage',				['as' =>$route_slug.'blogs', 'uses' => $module_controller.'index']);
		Route::get('/load',		['as' =>$route_slug.'blogs', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		['as' =>$route_slug.'blogs', 'uses' => $module_controller.'create']);
		Route::post('/store',		['as' =>$route_slug.'blogs', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',		['as' =>$route_slug.'blogs', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',		['as' =>$route_slug.'blogs', 'uses' => $module_controller.'update']);
		Route::get('/block/{id}',		['as' =>$route_slug.'blogs', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',		['as' =>$route_slug.'blogs', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',		['as' =>$route_slug.'blogs', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',		['as' =>$route_slug.'blogs', 'uses' => $module_controller.'multi_action']);
	});
	Route::group(array('prefix' => 'occasions'), function () use($route_slug)
	{
		$module_controller = "Admin\OccasionsController@";		
		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		  ['as' =>$route_slug.'create', 'uses' => $module_controller.'create']);
		Route::post('/store',		  ['as' =>$route_slug.'store', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  ['as' =>$route_slug.'edit', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  ['as' =>$route_slug.'update', 'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  ['as' =>$route_slug.'block', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  ['as' =>$route_slug.'unblock', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  ['as' =>$route_slug.'delete', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'faq'), function () use($route_slug)
	{
		$module_controller = "Admin\FaqController@";		
		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		  ['as' =>$route_slug.'create', 'uses' => $module_controller.'create']);
		Route::post('/store',		  ['as' =>$route_slug.'store', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  ['as' =>$route_slug.'edit', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  ['as' =>$route_slug.'update', 'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  ['as' =>$route_slug.'block', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  ['as' =>$route_slug.'unblock', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  ['as' =>$route_slug.'delete', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'shank_types'), function () use($route_slug)
	{
		$module_controller = "Admin\ShankTypeController@";		
		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/manage',				['as' =>$route_slug.'blogs', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		  ['as' =>$route_slug.'create', 'uses' => $module_controller.'create']);
		Route::post('/store',		  ['as' =>$route_slug.'store', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  ['as' =>$route_slug.'edit', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  ['as' =>$route_slug.'update', 'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  ['as' =>$route_slug.'block', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  ['as' =>$route_slug.'unblock', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  ['as' =>$route_slug.'delete', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'collections'), function () use($route_slug)
	{
		$module_controller = "Admin\CollectionController@";		
		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/manage',				['as' =>$route_slug.'blogs', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		  ['as' =>$route_slug.'create', 'uses' => $module_controller.'create']);
		Route::post('/store',		  ['as' =>$route_slug.'store', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  ['as' =>$route_slug.'edit', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  ['as' =>$route_slug.'update', 'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  ['as' =>$route_slug.'block', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  ['as' =>$route_slug.'unblock', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  ['as' =>$route_slug.'delete', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'product_line'), function () use($route_slug)
	{
		$module_controller = "Admin\ProductLinesController@";		
		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);

		Route::get('/load_category', ['as' =>$route_slug.'index', 'uses' => $module_controller.'load_category']);

		Route::get('/load_subcategory', ['as' =>$route_slug.'index', 'uses' => $module_controller.'load_subcategory']);

		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		  ['as' =>$route_slug.'create', 'uses' => $module_controller.'create']);
		Route::post('/store',		  ['as' =>$route_slug.'store', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  ['as' =>$route_slug.'edit', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  ['as' =>$route_slug.'update', 'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  ['as' =>$route_slug.'block', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  ['as' =>$route_slug.'unblock', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  ['as' =>$route_slug.'delete', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'bands_setting'), function () use($route_slug)
	{
		$module_controller = "Admin\BandSettingController@";		
		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/manage',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		  ['as' =>$route_slug.'create', 'uses' => $module_controller.'create']);
		Route::post('/store',		  ['as' =>$route_slug.'store', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  ['as' =>$route_slug.'edit', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  ['as' =>$route_slug.'update', 'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  ['as' =>$route_slug.'block', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  ['as' =>$route_slug.'unblock', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  ['as' =>$route_slug.'delete', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'setting'), function () use($route_slug)
	{
		$module_controller = "Admin\SettingController@";		
		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/manage',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		  ['as' =>$route_slug.'create', 'uses' => $module_controller.'create']);
		Route::post('/store',		  ['as' =>$route_slug.'store', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  ['as' =>$route_slug.'edit', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  ['as' =>$route_slug.'update', 'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  ['as' =>$route_slug.'block', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  ['as' =>$route_slug.'unblock', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  ['as' =>$route_slug.'delete', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);

	});


	Route::group(array('prefix' => 'contact_enquiry'), function () use($route_slug)
	{
		$module_controller = "Admin\ContactEnquiryController@";		
		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::get('/view/{id}',		  ['as' =>$route_slug.'view', 'uses' => $module_controller.'view']);
		Route::post('/reply/{id}',	  ['as' =>$route_slug.'reply', 'uses' => $module_controller.'reply']);
		Route::get('/delete/{id}',	  ['as' =>$route_slug.'delete', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'email_template'), function () use($route_slug)
	{
		$module_controller = "Admin\EmailTemplateController@";		
		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::post('/store',		  ['as' =>$route_slug.'store', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  ['as' =>$route_slug.'edit', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  ['as' =>$route_slug.'update', 'uses' => $module_controller.'update']);
		Route::post('/preview',	      ['as' =>$route_slug.'preview', 'uses' => $module_controller.'preview']);
		

	});
	Route::group(array('prefix' => 'notification_template'), function () use($route_slug)
	{
		$module_controller = "Admin\NotificationTemplateController@";	

		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::post('/store',		  ['as' =>$route_slug.'store', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  ['as' =>$route_slug.'edit', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  ['as' =>$route_slug.'update', 'uses' => $module_controller.'update']);
	});

	Route::group(array('prefix' => 'look'), function () use($route_slug)
	{
		$module_controller = "Admin\LookController@";		
		
		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		  ['as' =>$route_slug.'create', 'uses' => $module_controller.'create']);
		Route::post('/store',		  ['as' =>$route_slug.'store', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  ['as' =>$route_slug.'edit', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  ['as' =>$route_slug.'update', 'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  ['as' =>$route_slug.'block', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  ['as' =>$route_slug.'unblock', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  ['as' =>$route_slug.'delete', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'gift_card'), function () use($route_slug)
	{
		$module_controller = "Admin\GiftCardController@";		
		Route::get('/',               ['as' =>$route_slug.'index',        'uses' => $module_controller.'index']);
		Route::get('/load',           ['as' =>$route_slug.'load',         'uses' => $module_controller.'load_data']);
		Route::get('/create',         ['as' =>$route_slug.'create',       'uses' => $module_controller.'create']);
		Route::post('/store',         ['as' =>$route_slug.'store',        'uses' => $module_controller.'store']);
		Route::get('/view/{id}',      ['as' =>$route_slug.'view',         'uses' => $module_controller.'view']);
		Route::get('/edit/{id}',      ['as' =>$route_slug.'edit',         'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',   ['as' =>$route_slug.'update',       'uses' => $module_controller.'update']);
		Route::get('/block/{id}',     ['as' =>$route_slug.'block',        'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',   ['as' =>$route_slug.'unblock',      'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',    ['as' =>$route_slug.'delete',       'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);
		Route::get('/load_card/{id}', ['as' =>$route_slug.'load_card',    'uses' => $module_controller.'load_card_details']);

	});

	Route::group(array('prefix' => 'ring_shoulder'), function () use($route_slug)
	{
		$module_controller = "Admin\RingShoulderController@";		
		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		  ['as' =>$route_slug.'create', 'uses' => $module_controller.'create']);
		Route::post('/store',		  ['as' =>$route_slug.'store', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  ['as' =>$route_slug.'edit', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  ['as' =>$route_slug.'update', 'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  ['as' =>$route_slug.'block', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  ['as' =>$route_slug.'unblock', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  ['as' =>$route_slug.'delete', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'subscribers'), function () use($route_slug)
	{
		$module_controller = "Admin\NewsletterController@";		
		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/manage',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::get('/delete/{id}',	  ['as' =>$route_slug.'delete', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);
		Route::post('/export',  	  ['as' =>$route_slug.'export_csv', 'uses' => $module_controller.'export_csv']);

	});

	Route::group(array('prefix' => 'user'), function () use($route_slug)
	{
		Route::group(array('prefix' => 'suppliers'), function () use($route_slug)
		{
			$module_controller = "Admin\SupplierController@";		
			Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
			Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
			Route::get('/view/{id}',	  ['as' =>$route_slug.'view', 'uses' => $module_controller.'view']);
			Route::get('/block/{id}',	  ['as' =>$route_slug.'block', 'uses' => $module_controller.'block']);
			Route::get('/unblock/{id}',	  ['as' =>$route_slug.'unblock', 'uses' => $module_controller.'unblock']);
			Route::get('/verify/{id}',	  ['as' =>$route_slug.'verify', 'uses' => $module_controller.'verify']);
			Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);
			Route::post('/commission/store',  ['as' =>$route_slug.'commission_store', 'uses' => $module_controller.'commission_store']);
		});

		Route::group(array('prefix' => 'customers'), function () use($route_slug)
		{
			$module_controller = "Admin\CustomerController@";		
			Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
			Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
			Route::get('/view/{id}',	  ['as' =>$route_slug.'view', 'uses' => $module_controller.'view']);
			Route::get('/block/{id}',	  ['as' =>$route_slug.'block', 'uses' => $module_controller.'block']);
			Route::get('/unblock/{id}',	  ['as' =>$route_slug.'unblock', 'uses' => $module_controller.'unblock']);
			Route::get('/verify/{id}',	  ['as' =>$route_slug.'verify', 'uses' => $module_controller.'verify']);
			Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);
			Route::post('/commission/store',  ['as' =>$route_slug.'commission_store', 'uses' => $module_controller.'commission_store']);
		});
	});

	Route::group(array('prefix' => 'gemstone'), function () use($route_slug)
	{
		$module_controller = "Admin\GemStoneController@";		
		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::get('/create',		  ['as' =>$route_slug.'create', 'uses' => $module_controller.'create']);
		Route::post('/store',		  ['as' =>$route_slug.'store', 'uses' => $module_controller.'store']);
		Route::get('/edit/{id}',	  ['as' =>$route_slug.'edit', 'uses' => $module_controller.'edit']);
		Route::post('/update/{id}',	  ['as' =>$route_slug.'update', 'uses' => $module_controller.'update']);
		Route::get('/block/{id}',	  ['as' =>$route_slug.'block', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  ['as' =>$route_slug.'unblock', 'uses' => $module_controller.'unblock']);
		Route::get('/delete/{id}',	  ['as' =>$route_slug.'delete', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);

	});

	Route::group(array('prefix' => 'notifications'), function () use($route_slug)
	{
		$module_controller = "Admin\NotificationsController@";		
		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::get('/read/{id}',     ['as' => $route_slug.'read',         'uses' => $module_controller.'read']);
		Route::get('/delete/{id}',	  ['as' =>$route_slug.'delete', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);

	});


	Route::group(array('prefix' => 'products'), function () use($route_slug)
	{
		Route::group(array('prefix' => 'supplier'), function () use($route_slug)
		{
			$module_controller = "Admin\ProductController@";
			Route::get('/approve/{id}',	  ['as' =>$route_slug.'block', 'uses' => $module_controller.'approve']);
			Route::get('/reject/{id}',	  ['as' =>$route_slug.'block', 'uses' => $module_controller.'unapprove']);

		});

		Route::group(array('prefix' => 'jewellery'), function () use($route_slug)
		{
			$module_controller = "Admin\JewelleryProductController@";		
			
			Route::get('/create',		  ['as' =>$route_slug.'create', 'uses' => $module_controller.'create']);
			Route::post('/store',		  ['as' =>$route_slug.'store', 'uses' => $module_controller.'store']);
			Route::get('/edit/{id}',	  ['as' =>$route_slug.'edit', 'uses' => $module_controller.'edit']);
			Route::post('/update/{id}',	  ['as' =>$route_slug.'update', 'uses' => $module_controller.'update']);

			Route::get('/get_category',		['as' =>$route_slug.'get_category', 'uses' => $module_controller.'get_category_by_product_type']);
			Route::get('/load_subcategory', ['as' =>$route_slug.'load_subcategory', 'uses' => $module_controller.'load_subcategory']);
			Route::get('/get_product_lines',		['as' =>$route_slug.'get_product_lines', 'uses' => $module_controller.'get_product_lines_by_sub_category']);
			Route::get('/remove_product_img/{id}', ['as' =>$route_slug.'remove_product_img', 'uses' => $module_controller.'remove_product_img']);
		});

		// For all products.

		$module_controller = "Admin\ProductController@";

		Route::post('/add_discount',  ['as' =>$route_slug.'add_discount', 'uses' => $module_controller.'add_discount']);

		// Load data for product listing
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);

		// Product listing(Supplier and admin products)
		Route::get('/{user?}',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);

		// Product details view.
		Route::get('/{user_type}/view/{id}',	  ['as' =>$route_slug.'view', 'uses' => $module_controller.'view']);		

		Route::get('/delete/{id}',	  ['as' =>$route_slug.'delete', 'uses' => $module_controller.'delete']);

		Route::get('/block/{id}',	  ['as' =>$route_slug.'block', 'uses' => $module_controller.'block']);
		Route::get('/unblock/{id}',	  ['as' =>$route_slug.'unblock', 'uses' => $module_controller.'unblock']);
		Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);
		
	});


	Route::group(array('prefix' => 'api_credentials'), function () use($route_slug)
	{
		$module_controller = "Admin\ApiCredentialController@";		
		Route::get('/', ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::post('/update', ['as' =>$route_slug.'index', 'uses' => $module_controller.'update']);

	});


	Route::group(array('prefix' => 'return_product'), function () use($route_slug)
	{
		$module_controller = "Admin\ReturnProductController@";		
		Route::get('/', ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);

		Route::get('/view/{return_product_id}/{order_product_id}', ['as' => $route_slug.'view',  'uses' => $module_controller.'view']);

		Route::get('/accept_request/{return_product_request_id}', ['as' => $route_slug.'accept_request',  'uses' => $module_controller.'accept_request']);
		Route::get('/reject_request/{return_product_request_id}', ['as' => $route_slug.'reject_request',  'uses' => $module_controller.'reject_request']);
		Route::post('/return_amount', ['as' => $route_slug.'return_amount',  'uses' => $module_controller.'return_amount']);
		Route::get('/reject_product/{return_product_request_id}', ['as' => $route_slug.'reject_product',  'uses' => $module_controller.'reject_product']);

	});


	Route::group(array('prefix' => 'replacement_products'), function () use($route_slug)
	{
		$module_controller = "Admin\ReplacementController@";		
		Route::get('/', ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);

		Route::get('/view/{return_product_id}/{order_product_id}', ['as' => $route_slug.'view',  'uses' => $module_controller.'view']);

		Route::get('/accept_request/{return_product_request_id}', ['as' => $route_slug.'accept_request',  'uses' => $module_controller.'accept_request']);
		Route::get('/reject_request/{return_product_request_id}', ['as' => $route_slug.'reject_request',  'uses' => $module_controller.'reject_request']);
		Route::post('/accept_product', ['as' => $route_slug.'accept_product',  'uses' => $module_controller.'accept_product']);
		Route::get('/reject_product/{return_product_request_id}', ['as' => $route_slug.'reject_product',  'uses' => $module_controller.'reject_product']);

	});


	Route::group(array('prefix' => 'valuation'), function () use($route_slug)
	{
		$module_controller = "Admin\ValuationController@";		
		Route::get('/', ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::get('/view/{id}',                     ['as' => $route_slug.'view',          'uses' => $module_controller.'view']);

	});


	/*-------------------------Reports Starts-------------------------*/
	
	Route::group(array('prefix' => 'reports'), function () use($route_slug)
	{
		
		/*-------------------------Users Reports Starts-------------------------*/

		Route::group(array('prefix' => 'users'), function () use($route_slug)
		{
			// For Customers
			$module_controller = "Admin\CustomerReportController@";
			Route::get('/customers',         ['as' =>$route_slug.'index',      'uses' => $module_controller.'index']);
			Route::get('/customers/load',    ['as' =>$route_slug.'load',       'uses' => $module_controller.'load_data']);
			Route::post('/customers/export', ['as' =>$route_slug.'export_csv', 'uses' => $module_controller.'export_csv']);

			// For Suppliers
			$module_controller = "Admin\SupplierReportController@";
			Route::get('/suppliers',         ['as' =>$route_slug.'index',      'uses' => $module_controller.'index']);
			Route::get('/suppliers/load',    ['as' =>$route_slug.'load',       'uses' => $module_controller.'load_data']);
			Route::post('/suppliers/export', ['as' =>$route_slug.'export_csv', 'uses' => $module_controller.'export_csv']);
		});

		Route::group(array('prefix' => 'products'), function () use($route_slug)
		{
			// For Customers
			$module_controller = "Admin\ProductReportController@";
			Route::get('/',['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
			Route::get('/most_viewed_product',['as' =>$route_slug.'index', 'uses' => $module_controller.'most_views']);
		});

		/*-------------------------Users Reports Starts-------------------------*/

		// For Orders
		$module_controller = "Admin\OrdersReportController@";
		Route::get('/orders',         ['as' =>$route_slug.'index',      'uses' => $module_controller.'index']);
		Route::get('/orders/load',    ['as' =>$route_slug.'load',       'uses' => $module_controller.'load_data']);
		Route::post('/orders/export', ['as' =>$route_slug.'export_csv', 'uses' => $module_controller.'export_csv']);

		// For Shopping Cart
		$module_controller = "Admin\ShoppingCartReportController@";
		Route::get('/shopping-cart',         ['as' =>$route_slug.'index',      'uses' => $module_controller.'index']);
		Route::get('/shopping-cart/load',    ['as' =>$route_slug.'load',       'uses' => $module_controller.'load_data']);
		Route::post('/shopping-cart/export', ['as' =>$route_slug.'export_csv', 'uses' => $module_controller.'export_csv']);

		// For Product Reviews
		$module_controller = "Admin\ProductReviewsReportController@";
		Route::get('/product-reviews',         ['as' =>$route_slug.'index',      'uses' => $module_controller.'index']);
		Route::get('/product-reviews/load',    ['as' =>$route_slug.'load',       'uses' => $module_controller.'load_data']);
		Route::post('/product-reviews/export', ['as' =>$route_slug.'export_csv', 'uses' => $module_controller.'export_csv']);

		// For Refund
		$module_controller = "Admin\RefundReportController@";
		Route::get('/refund',         ['as' =>$route_slug.'index',      'uses' => $module_controller.'index']);
		Route::get('/refund/load',    ['as' =>$route_slug.'load',       'uses' => $module_controller.'load_data']);
		Route::post('/refund/export', ['as' =>$route_slug.'export_csv', 'uses' => $module_controller.'export_csv']);

		// For Cancellation & Return
		$module_controller = "Admin\CancellationReturnReportController@";
		Route::get('/cancellation-return',         ['as' =>$route_slug.'index',      'uses' => $module_controller.'index']);
		Route::get('/cancellation-return/load',    ['as' =>$route_slug.'load',       'uses' => $module_controller.'load_data']);
		Route::post('/cancellation-return/export', ['as' =>$route_slug.'export_csv', 'uses' => $module_controller.'export_csv']);

		// For Replacement
		$module_controller = "Admin\ReplacementReportController@";
		Route::get('/replacement',         ['as' =>$route_slug.'index',      'uses' => $module_controller.'index']);
		Route::get('/replacement/load',    ['as' =>$route_slug.'load',       'uses' => $module_controller.'load_data']);
		Route::post('/replacement/export', ['as' =>$route_slug.'export_csv', 'uses' => $module_controller.'export_csv']);


	});

	/*-------------------------Reports Ends-------------------------*/


	/*-------------------------Shopping Cart Starts-------------------------*/
	
	Route::group(array('prefix' => 'shopping-cart'), function () use($route_slug)
	{
		$module_controller = "Admin\ShoppingCartController@";
		Route::get('/abandoned',           ['as' =>$route_slug.'abandoned',    'uses' => $module_controller.'abandoned']);
		Route::get('/abandoned/load',      ['as' =>$route_slug.'load',         'uses' => $module_controller.'load_data']);
		Route::get('/abandoned/view/{id}', ['as' =>$route_slug.'view',         'uses' => $module_controller.'view']);
		Route::get('/load_details/{id}',   ['as' =>$route_slug.'load_details', 'uses' => $module_controller.'load_details']);

	});

	/*-------------------------Shopping Cart Ends-------------------------*/


	/*-------------------------Orders Starts-------------------------*/
	
	Route::group(array('prefix' => 'orders'), function () use($route_slug)
	{
		$module_controller = "Admin\OrdersController@";
		/*Route::get('/',                              ['as' => $route_slug.'index',         'uses' => $module_controller.'index']);
		Route::get('/load',                          ['as' => $route_slug.'load',          'uses' => $module_controller.'load_data']);*/

		Route::get('/new',                           ['as' => $route_slug.'new',           'uses' => $module_controller.'new']);
		Route::get('/new/load',                      ['as' => $route_slug.'new_load',      'uses' => $module_controller.'new_load_data']);

		Route::get('/past',                          ['as' => $route_slug.'past',          'uses' => $module_controller.'past']);
		Route::get('/past/load',                     ['as' => $route_slug.'past_load',     'uses' => $module_controller.'past_load_data']);

		Route::get('/cancelled',                     ['as' => $route_slug.'cancel',        'uses' => $module_controller.'cancel']);
		Route::get('/cancel/load',                   ['as' => $route_slug.'cancel_load',   'uses' => $module_controller.'cancel_load_data']);

		Route::any('/status/{status}/{id}',          ['as' => $route_slug.'change_status', 'uses' => $module_controller.'change_status']);
		Route::get('/{status}/view/{id}',                     ['as' => $route_slug.'view',          'uses' => $module_controller.'view']);
		Route::get('/order_product/{status}/{id}/{order_id}', ['as' => $route_slug.'view',          'uses' => $module_controller.'order_product']);
	});

	/*-------------------------Orders Ends-------------------------*/


	/*-------------------------My Orders Starts-------------------------*/
	
	Route::group(array('prefix' => 'my_orders'), function () use($route_slug)
	{
		$module_controller = "Admin\MyOrdersController@";

		Route::get('/new',                           ['as' => $route_slug.'new',           'uses' => $module_controller.'new']);
		Route::get('/new/load',                      ['as' => $route_slug.'new_load',      'uses' => $module_controller.'new_load_data']);

		Route::get('/past',                          ['as' => $route_slug.'past',          'uses' => $module_controller.'past']);
		Route::get('/past/load',                     ['as' => $route_slug.'past_load',     'uses' => $module_controller.'past_load_data']);

		Route::get('/cancelled',                     ['as' => $route_slug.'cancel',        'uses' => $module_controller.'cancel']);
		Route::get('/cancel/load',                   ['as' => $route_slug.'cancel_load',   'uses' => $module_controller.'cancel_load_data']);

		Route::get('/return',                        ['as' => $route_slug.'return',        'uses' => $module_controller.'return']);
		Route::get('/return/load',                   ['as' => $route_slug.'return_load',   'uses' => $module_controller.'return_load_data']);

		Route::any('/status/{status}/{id}',          ['as' => $route_slug.'change_status', 'uses' => $module_controller.'change_status']);
		Route::get('/view/{id}',                     ['as' => $route_slug.'view',          'uses' => $module_controller.'view']);
		Route::get('/order_product/{id}/{order_id}', ['as' => $route_slug.'view',          'uses' => $module_controller.'order_product']);

		Route::get('/return/view/{return_product_id}/{order_product_id}', ['as' => $route_slug.'return_view',   'uses' => $module_controller.'return_view']);
	});

	/*-------------------------My Orders Ends-------------------------*/


	/*-------------------------Transaction Starts-------------------------*/
	
	Route::group(array('prefix' => 'transaction'), function () use($route_slug)
	{
		
		/*-------------------------Wallet Transaction Starts-------------------------*/
		Route::group(array('prefix' => 'wallet'), function () use($route_slug)
		{
			$module_controller = "Admin\TransactionController@";
			Route::get('/',                  ['as' =>$route_slug.'wallet',       'uses' => $module_controller.'wallet']);
			Route::get('/load',              ['as' =>$route_slug.'load',         'uses' => $module_controller.'load_data']);
			Route::get('/view/{id}',         ['as' =>$route_slug.'view',         'uses' => $module_controller.'view']);
			Route::get('/load_details/{id}', ['as' =>$route_slug.'load_details', 'uses' => $module_controller.'load_details']);
		});

		Route::group(array('prefix' => 'product'), function () use($route_slug)
		{
			$module_controller = "Admin\TransactionController@";
			Route::get('/',                  ['as' =>$route_slug.'wallet',       'uses' => $module_controller.'product_transaction']);
			Route::get('/load',              ['as' =>$route_slug.'load',         'uses' => $module_controller.'load_product_data']);
			Route::get('/view/{id}',         ['as' =>$route_slug.'view',         'uses' => $module_controller.'view_product']);
			
		});
		/*-------------------------Wallet Transaction Ends-------------------------*/

	});

	/*-------------------------Transaction Ends-------------------------*/


	/*-------------------------My Earnings Starts-------------------------*/
	
	Route::group(array('prefix' => 'earnings'), function () use($route_slug)
	{
		$module_controller = "Admin\MyEarningsController@";

		Route::get('/',                              ['as' => $route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',                          ['as' => $route_slug.'load',  'uses' => $module_controller.'load_data']);
		Route::get('/view/{id}',                     ['as' => $route_slug.'view',  'uses' => $module_controller.'view']);
		Route::get('/order_product/{id}/{order_id}', ['as' => $route_slug.'view',  'uses' => $module_controller.'order_product']);
		
	});

	/*-------------------------My Earnings Ends-------------------------*/

	Route::group(array('prefix' => 'bulk-upload'), function () use($route_slug)
	{
		$module_controller = "Admin\BulkUploadController@";

		Route::get('/products', ['as' => $route_slug.'index', 'uses' => $module_controller.'products']);
		Route::post('/products/upload', ['as' => $route_slug.'index', 'uses' => $module_controller.'upload_products']);
		Route::get('/products/template', ['as' => $route_slug.'index', 'uses' => $module_controller.'download_template']);
		Route::get('/products/suggetion', ['as' => $route_slug.'index', 'uses' => $module_controller.'suggetion']);
		Route::get('/images', ['as' => $route_slug.'index', 'uses' => $module_controller.'images']);
		Route::post('/images/upload', ['as' => $route_slug.'index', 'uses' => $module_controller.'upload_images']);
		
	});

});






