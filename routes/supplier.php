<?php
$web_supplier_path =config('app.project.supplier_panel_slug');

Route::group(array('prefix' => $web_supplier_path), function ()
{
	$route_slug = 'supplier_';
	$module_controller = "Supplier\AuthController@";
	Route::get('/',['as' =>$route_slug.'login', 'uses' => $module_controller.'login']);

	
	Route::get('/signup',['as' => $route_slug.'signup','uses' => $module_controller.'sign_up']);
	Route::post('/signup/store',['as' => $route_slug.'signup_store','uses' => $module_controller.'signup_store']);

	Route::get('/verify_account/{enc_user_id}/{_token}',['as' =>'verify_account','uses' => $module_controller.'verify_account']);

	Route::post('validate_login', ['as' =>$route_slug.'validate', 'uses' => $module_controller.'validate_login']);
	Route::get('logout',					['as' =>$route_slug.'logout', 'uses' => $module_controller.'logout']);	
	
	$module_controller = "Supplier\PasswordController@";
	Route::get('forgot_password',			['as' =>$route_slug.'forgot_password', 'uses' => $module_controller.'forgot_password']);

	Route::post('forgot_password/post_email',			['as' =>$route_slug.'forgot_password_post_email', 'uses' => $module_controller.'postEmail']);

	Route::post('forgot_password/postReset',			['as' =>$route_slug.'forgot_password_post_reset', 'uses' => $module_controller.'postReset']);

	Route::get('/reset_password/{token?}', ['uses' =>$module_controller.'get_email'])->name('password.reset');

});

Route::group(array('prefix' => $web_supplier_path, 'middleware'=>'auth_supplier'), function ()
{
	$route_slug = 'supplier_';
	$module_controller = "Supplier\DashboardController@";
	Route::get('/dashboard',['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);

	$module_controller = "Supplier\AccountSettingController@";

	Route::get('password/change',			['as' =>$route_slug.'change_password', 'uses' => $module_controller.'change_password']);
	Route::post('password/update/{enc_id}',			['as' =>$route_slug.'update_password', 'uses' => $module_controller.'update_password']);

	Route::group(array('prefix' => 'account_setting'), function () use($route_slug,$module_controller)
	{
		Route::get('/personal',		  ['as' =>$route_slug.'personal', 'uses' => $module_controller.'personal_details']);

		Route::post('/personal/update/{enc_id}',	['as' =>$route_slug.'personal_details_update', 'uses' => $module_controller.'personal_details_update']);

		Route::get('/business',		  ['as' =>$route_slug.'business', 'uses' => $module_controller.'business_details']);

		Route::post('/business/update/{enc_id}',	['as' =>$route_slug.'business_details_update', 'uses' => $module_controller.'business_details_update']);
		
		Route::get('/financial',		  ['as' =>$route_slug.'financial', 'uses' => $module_controller.'financial_details']);

		Route::post('/financial/update/{enc_id}',	['as' =>$route_slug.'financial_details_update', 'uses' => $module_controller.'financial_details_update']);

		

	});


	Route::group(array('prefix' => 'product'), function () use($route_slug)
	{
		Route::group(array('prefix' => 'jewellery'), function () use($route_slug)
		{
			$module_controller = "Supplier\JewelleryProductController@";		
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

			Route::get('/view/{id}',	  ['as' =>$route_slug.'view', 'uses' => $module_controller.'view']);

			Route::get('/get_category',		['as' =>$route_slug.'get_category', 'uses' => $module_controller.'get_category_by_product_type']);
			Route::get('/load_subcategory', ['as' =>$route_slug.'load_subcategory', 'uses' => $module_controller.'load_subcategory']);
			Route::get('/get_product_lines',		['as' =>$route_slug.'get_product_lines', 'uses' => $module_controller.'get_product_lines_by_sub_category']);
			Route::get('/remove_product_img/{id}', ['as' =>$route_slug.'remove_product_img', 'uses' => $module_controller.'remove_product_img']);
		});
	});

	Route::group(array('prefix' => 'notifications'), function () use($route_slug)
	{
		$module_controller = "Supplier\NotificationsController@";		
		Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',		      ['as' =>$route_slug.'load', 'uses' => $module_controller.'load_data']);
		Route::get('/read/{id}',      ['as' => $route_slug.'read',         'uses' => $module_controller.'read']);
		Route::get('/delete/{id}',	  ['as' =>$route_slug.'delete', 'uses' => $module_controller.'delete']);
		Route::post('/multi_action',  ['as' =>$route_slug.'multi_action', 'uses' => $module_controller.'multi_action']);

	});


	/*-------------------------Orders Starts-------------------------*/
	
	Route::group(array('prefix' => 'orders'), function () use($route_slug)
	{
		$module_controller = "Supplier\OrdersController@";

		Route::get('/download-invoice/{id?}',                           ['as' => $route_slug.'new',           'uses' => $module_controller.'download_invoice']);
		Route::get('/return-download-invoice/{return_product_request_id}/{order_product_id}',                           ['as' => $route_slug.'return-download-invoice',           'uses' => $module_controller.'download_return_invoice']);

		Route::get('/new',                           ['as' => $route_slug.'new',           'uses' => $module_controller.'new']);
		Route::get('/new/load',                      ['as' => $route_slug.'new_load',      'uses' => $module_controller.'new_load_data']);

		Route::get('/past',                          ['as' => $route_slug.'past',          'uses' => $module_controller.'past']);
		Route::get('/past/load',                     ['as' => $route_slug.'past_load',     'uses' => $module_controller.'past_load_data']);

		Route::get('/cancelled',                     ['as' => $route_slug.'cancel',        'uses' => $module_controller.'cancel']);
		Route::get('/cancel/load',                   ['as' => $route_slug.'cancel_load',   'uses' => $module_controller.'cancel_load_data']);

		Route::get('/return',                        ['as' => $route_slug.'return',        'uses' => $module_controller.'return']);
		Route::get('/return/load',                   ['as' => $route_slug.'return_load',   'uses' => $module_controller.'return_load_data']);

		Route::get('/status/{status}/{id}',          ['as' => $route_slug.'change_status', 'uses' => $module_controller.'change_status']);
		Route::get('/{status}/view/{id}',                     ['as' => $route_slug.'view',          'uses' => $module_controller.'view']);
		Route::get('/order_product/{status}/{id}/{order_id}', ['as' => $route_slug.'view',          'uses' => $module_controller.'order_product']);

		Route::get('/return/view/{return_product_id}/{order_product_id}', ['as' => $route_slug.'return_view',   'uses' => $module_controller.'return_view']);
	});

	/*-------------------------Orders Ends-------------------------*/

	/*-------------------------My Earnings Starts-------------------------*/
	
	Route::group(array('prefix' => 'earnings'), function () use($route_slug)
	{
		$module_controller = "Supplier\MyEarningsController@";

		Route::get('/',                              ['as' => $route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/load',                          ['as' => $route_slug.'load',  'uses' => $module_controller.'load_data']);
		Route::get('/view/{id}',                     ['as' => $route_slug.'view',  'uses' => $module_controller.'view']);
		Route::get('/order_product/{id}/{order_id}', ['as' => $route_slug.'view',  'uses' => $module_controller.'order_product']);
		Route::get('/download-invoice/{id?}',                           ['as' => $route_slug.'new',           'uses' => $module_controller.'download_invoice']);
		
	});

	Route::group(array('prefix' => 'bulk-upload'), function () use($route_slug)
	{
		$module_controller = "Supplier\BulkUploadController@";

		Route::get('/products', ['as' => $route_slug.'index', 'uses' => $module_controller.'products']);
		Route::post('/products/upload', ['as' => $route_slug.'index', 'uses' => $module_controller.'upload_products']);
		Route::get('/products/template', ['as' => $route_slug.'index', 'uses' => $module_controller.'download_template']);
		Route::get('/products/suggetion', ['as' => $route_slug.'index', 'uses' => $module_controller.'suggetion']);
		Route::get('/images', ['as' => $route_slug.'index', 'uses' => $module_controller.'images']);
		Route::post('/images/upload', ['as' => $route_slug.'index', 'uses' => $module_controller.'upload_images']);
		
	});

	/*-------------------------My Earnings Ends-------------------------*/
	
});