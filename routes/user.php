<?php
Route::group(['middleware' => 'front_general'], function ()
{
	
	/*---------------------Route group only visit before login---------------------*/
	
	Route::group(['middleware' => 'user_auth_check'], function ()
	{
		$route_slug        = "user_login_";
		$module_controller = "Front\User\AuthController@";
		Route::get('/login',['as' => $route_slug.'login','uses' => $module_controller.'login']);
		Route::post('/validate_login',['as'=> $route_slug.'validate_login','uses'=>$module_controller.'validate_login']);
		Route::get('/signup',['as' => $route_slug.'signup','uses' => $module_controller.'signup']);
		Route::post('/signup_store',['as' => $route_slug.'signup_store','uses' => $module_controller.'signup_store']);
		Route::get('user/verify_account/{enc_user_id}/{_token}',['as' =>'verify_account','uses' => $module_controller.'verify_account']);
	});
	$route_slug        = "user_login_";
	$module_controller = "Front\User\AuthController@";
	Route::get('user/logout',['as' => $route_slug.'logout','uses' => $module_controller.'logout']);

	/*--------------------after login routes--------------------*/
	Route::group(['prefix' => 'user','middleware' => 'user'], function ()
	{
		$route_slug        = "user_dashboard_";
		$module_controller = "Front\User\DashboardController@";
		Route::get('dashboard',['as' => $route_slug.'dashboard','uses' => $module_controller.'index']);

		Route::group(array('prefix' => 'my_account'), function ()
		{
			$route_slug        = "user_account_";
			$module_controller = "Front\User\AccountSettingController@";
			Route::get('/{id?}',['as' => $route_slug.'manage', 'uses' => $module_controller.'index']);
			Route::get('/edit/{enc_id}',['as' => $route_slug.'edit', 'uses' => $module_controller.'edit']);
			Route::post('/update',	['as' =>$route_slug.'update', 'uses' => $module_controller.'update']);
			Route::post('password/update/{enc_id}',			['as' =>$route_slug.'update_password', 'uses' => $module_controller.'update_password']);
			Route::post('bank_details/update/{enc_id}',			['as' =>$route_slug.'update_bank_details', 'uses' => $module_controller.'update_bank_details']);
		});

		Route::group(array('prefix' => 'my_orders'), function ()
		{
			$route_slug        = "user_orders_";
			$module_controller = "Front\User\MyOrderController@";
			Route::get('/',['as' => $route_slug.'manage', 'uses' => $module_controller.'index']);
			Route::get('/{order_id}',['as' => $route_slug.'product_details', 'uses' => $module_controller.'products']);
			Route::get('/details/{order_product_id}',['as' => $route_slug.'manage', 'uses' => $module_controller.'details']);
			Route::get('/return/{order_product_id}',['as' => $route_slug.'return', 'uses' => $module_controller.'return_product']);
			Route::post('/return/proceed',['as' => $route_slug.'proceed_return_request', 'uses' => $module_controller.'proceed_return_request']);

		});

		Route::group(array('prefix' => 'replacement'), function ()
		{
			$route_slug        = "replacement_";
			$module_controller = "Front\User\ReplacementController@";
			Route::get('/',['as' => $route_slug.'manage', 'uses' => $module_controller.'index']);
			Route::get('/replace_product/{order_product_id}',['as' => $route_slug.'replace_product', 'uses' => $module_controller.'replace_product']);
			Route::post('/proceed',['as' => $route_slug.'proceed_replacement_request', 'uses' => $module_controller.'proceed_replacement_request']);
			Route::get('/details/{order_product_id}',['as' => $route_slug.'manage', 'uses' => $module_controller.'details']);
			/*Route::get('/return/{order_product_id}',['as' => $route_slug.'return', 'uses' => $module_controller.'return_product']);
			Route::post('/return/proceed',['as' => $route_slug.'proceed_return_request', 'uses' => $module_controller.'proceed_return_request']);*/

		});

		Route::group(array('prefix' => 'valuation'), function ()
		{
			$route_slug        = "valuation_";
			$module_controller = "Front\User\ValuationController@";
			Route::get('/',['as' => $route_slug.'manage', 'uses' => $module_controller.'index']);
			Route::get('/send_request',['as' => $route_slug.'send_request', 'uses' => $module_controller.'send_request']);
			Route::post('/proceed_request',['as' => $route_slug.'proceed_request', 'uses' => $module_controller.'proceed_request']);

		});

		Route::group(array('prefix' => 'my_addresses'), function ()
		{
			$route_slug        = "my_addresses_";
			$module_controller = "Front\User\MyAddressesController@";
			Route::get('/',['as' => $route_slug.'manage', 'uses' => $module_controller.'index']);
			Route::post('/store',['as' => $route_slug.'store', 'uses' => $module_controller.'store']);
			Route::post('/update',['as' => $route_slug.'update', 'uses' => $module_controller.'update']);
			Route::get('/make_default_address/{enc_address_id}',['as' => $route_slug.'make_default_address', 'uses' => $module_controller.'make_default_address']);
			Route::get('/delete/{enc_address_id}',['as' => $route_slug.'delete', 'uses' => $module_controller.'delete']);

		});


		Route::group(array('prefix' => 'notifications'), function () use($route_slug)
		{
			$module_controller = "Front\User\NotificationsController@";		
			Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
			Route::get('/delete/{id}',	  ['as' =>$route_slug.'delete', 'uses' => $module_controller.'delete']);
		});

		Route::group(array('prefix' => 'wishlist'), function () use($route_slug)
		{
			$module_controller = "Front\User\WishListController@";		
			Route::get('/',				  ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
			Route::get('/remove/{id}',	  ['as' =>$route_slug.'remove', 'uses' => $module_controller.'remove']);
		});

		Route::group(array('prefix' => 'gift_card'), function () use($route_slug)
		{
			$route_slug        = "gift_card_";
			$module_controller = "Front\User\GiftCardController@";
			Route::get('/send',     ['as' => $route_slug.'send',     'uses' => $module_controller.'send']);
			Route::get('/received', ['as' => $route_slug.'received', 'uses' => $module_controller.'received']);
		});

		Route::group(array('prefix' => 'my_wallet'), function () use($route_slug)
		{
			$route_slug        = "my_wallet_";
			$module_controller = "Front\User\MyWalletController@";
			Route::get('/',              ['as' => $route_slug.'index', 'uses' => $module_controller.'index']);
			Route::get('/view/{enc_id}', ['as' => $route_slug.'view',  'uses' => $module_controller.'view']);
		});

		Route::group(array('prefix' => 'transaction_history'), function () use($route_slug)
		{
			$route_slug        = "my_wallet_";
			$module_controller = "Front\User\TransactionController@";
			Route::get('/', ['as' => $route_slug.'index', 'uses' => $module_controller.'index']);
		});

	});
	
	Route::group(array('prefix' => 'shopping_cart', 'middleware' => 'user'), function () use($route_slug)
	{
		$module_controller = "Front\User\CartController@";		
		Route::get('/', ['as' =>$route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/maximize_quantity/{enc_id}', ['as' =>$route_slug.'index', 'uses' => $module_controller.'maximize_quantity']);
		Route::get('/minimize_quantity/{enc_id}', ['as' =>$route_slug.'index', 'uses' => $module_controller.'minimize_quantity']);
		
		Route::get('/remove_product/{enc_id}', ['as' =>$route_slug.'index', 'uses' => $module_controller.'remove_product']);

		Route::get('/apply_giftcard/{enc_id}', ['as' =>$route_slug.'index', 'uses' => $module_controller.'apply_giftcard']);

		Route::post('/verify_otp', ['as' =>$route_slug.'index', 'uses' => $module_controller.'verify_otp']);
		Route::post('/store_gift_card', ['as' =>$route_slug.'index', 'uses' => $module_controller.'store_gift_card']);

		Route::post('/add_product_to_session', ['as' => $route_slug.'products_session', 'uses' => $module_controller.'addsession']);
		
	});

	Route::group(array('prefix' => 'order', 'middleware' => 'user'), function () use($route_slug)
	{
		$module_controller = "Front\User\OrderController@";
		Route::get('/order_details', ['as' =>$route_slug.'index', 'uses' => $module_controller.'order_details']);

		Route::get('/get_address/{enc_id}', ['as' =>$route_slug.'index', 'uses' => $module_controller.'get_address']);

		Route::get('/delete_address/{enc_id}', ['as' =>$route_slug.'index', 'uses' => $module_controller.'delete_address']);

		Route::post('/update_address', ['as' =>$route_slug.'index', 'uses' => $module_controller.'update_address']);
		
		Route::post('/add_address', ['as' =>$route_slug.'index', 'uses' => $module_controller.'add_address']);
		Route::post('/place_order', ['as' =>$route_slug.'index', 'uses' => $module_controller.'place_order']);

		Route::get('/success', ['as' =>$route_slug.'success', 'uses' => $module_controller.'order_success']);
	});
	
	$module_controller = "Front\User\CartController@";		
	Route::post('/shopping_cart/store', ['as' =>$route_slug.'index', 'uses' => $module_controller.'store']);
	
	
	

});


?>