<?php
Route::group(['middleware' => 'front_general'], function ()
{
	$route_slug        = "user_login_";
	$module_controller = "Front\User\AuthController@";
	Route::any('/validate_login',['as'=> $route_slug.'validate_login','uses'=>$module_controller.'validate_login']);
	
	$module_controller = "Front\User\PasswordController@";
	Route::get('/forget_password',['as'=> $route_slug.'forget_password','uses'=>$module_controller.'index']);
	Route::post('/postEmail',['as'=> $route_slug.'postEmail','uses'=>$module_controller.'postEmail']);
	Route::get('/user/reset_password/{token}',['as'=> $route_slug.'postEmail','uses'=>$module_controller.'get_email']);
	Route::post('/postReset',['as'=> $route_slug.'postReset','uses'=>$module_controller.'postReset']);

	$module_controller = "Front\HomeController@";
	Route::get('/', ['as' => 'home_page' , 'uses' => $module_controller.'index']);
	Route::get('/home', ['as' => 'home_page' , 'uses' => $module_controller.'index']);	
	Route::get('/subscribe', ['as' => 'home_page' , 'uses' => $module_controller.'subscribe']);	
	
	Route::get('/get_wishlist_count',      ['as'=> $route_slug.'get_wishlist_count', 'uses'=>$module_controller.'get_wishlist_count']);
	Route::get('/set_currency/{currency}', ['as'=> $route_slug.'set_currency',       'uses'=>$module_controller.'set_currency']);


	Route::group(array('prefix' => 'blog'), function ()
	{
		$route_slug        = "blog_";
		$module_controller = "Front\BlogController@";
		Route::get('/',				['as' => $route_slug.'index', 'uses' => $module_controller.'index']);
		Route::get('/{slug}',		['as' => $route_slug.'view', 'uses' => $module_controller.'view']);
		Route::post('/comment/store',['as' => $route_slug.'comment_store', 'uses' => $module_controller.'comment_store']);
		Route::get('/category/{slug}',['as' => $route_slug.'category_blog', 'uses' => $module_controller.'category_blog']);
	});

	Route::group(array('prefix' => 'review_and_rating'), function ()
	{
		$route_slug        = "review_and_rating_";
		$module_controller = "Front\ReviewAndRatingController@";
		Route::get('/{product_id}/{order_product_id?}',				['as' => $route_slug.'index', 'uses' => $module_controller.'index']);
		Route::post('/store',				['as' => $route_slug.'store', 'uses' => $module_controller.'store']);


		
	});

	Route::group(array('prefix' => 'payment'), function ()
	{
		$module_controller = "Front\PaymentController@";
		$route_slug        = "payment_";
		Route::get('/error', ['as' => $route_slug.'payment', 'uses' => $module_controller.'payment_error']);
	});

	// -----------------------Demo Routes-----------------------
	Route::get('/send_otp',['as' => 'home_page' ,'uses' => 'Front\DemoController@send_otp']);	
	Route::get('/payment',['as' => 'home_page' ,'uses' => 'Front\DemoController@payment']);	
	Route::post('ccavenue/response',['as' => $route_slug.'payment','uses' => 'Front\PaymentController@get_response']);
	// -----------------------Demo Routes-----------------------



	Route::any('/services',['as'=> $route_slug.'services','uses'=>'Front\ServicesController@index']);
	Route::post('/services/store',['as'=> $route_slug.'store_contact_inquiry','uses'=>'Front\ServicesController@store_contact_inquiry']);
	Route::any('/services/{slug?}',['as'=> $route_slug.'view','uses'=>'Front\ServicesController@view']);


	/*-------------------Gift card-------------------*/
	Route::group(array('prefix' => 'gift_cards'), function ()
	{
		$route_slug        = "gift_cards_";
		$module_controller = "Front\GiftCardController@";

		Route::get('/',		['as' => $route_slug.'index', 'uses' => $module_controller.'index']);

		$module_controller = "Front\PaymentController@";

		Route::post('/send',		['as' => $route_slug.'gift_card_payment', 'uses' => $module_controller.'gift_card_payment']);
	});
	/*-------------------Gift card Ends-------------------*/


	/*-------------------Contact Us Starts-------------------*/
	Route::group(array('prefix' => 'contact_us'), function ()
	{
		$route_slug        = "contact_us_";
		$module_controller = "Front\ContactUsController@";

		Route::get('/',		['as' => $route_slug.'index', 'uses' => $module_controller.'index']);
		Route::post('/store',['as' => $route_slug.'store', 'uses' => $module_controller.'store']);
	});
	/*-------------------Contact Us Ends-------------------*/


	/*-------------------FAQ Starts-------------------*/
	Route::group(array('prefix' => 'faq'), function ()
	{
		$route_slug        = "faq_";
		$module_controller = "Front\FaqController@";

		Route::get('/',		['as' => $route_slug.'index', 'uses' => $module_controller.'index']);
		Route::post('/store',['as' => $route_slug.'store', 'uses' => $module_controller.'store']);
	});
	/*-------------------FAQ Ends-------------------*/

	Route::group(array('prefix' => 'info'), function ()
	{
		$route_slug        = "front_pages_";
		$module_controller = "Front\FrontPagesController@";
		Route::get('/{slug}',		['as' => $route_slug.'index', 'uses' => $module_controller.'index']);
	});
	$route_slug        = "front_pages_";
	$module_controller = "Front\FrontPagesController@";
	
	Route::get('/tieup',		['as' => $route_slug.'tieup', 'uses' => $module_controller.'tieup']);
	Route::get('/curation',		['as' => $route_slug.'curation', 'uses' => $module_controller.'curation']);

	/*-------------------Product Listing Starts-------------------*/

	// For Diamond 
	Route::group(array('prefix' => 'diamond'), function ()
	{
		$route_slug        = "diamond_";
		$module_controller = "Front\Product\DiamondController@";

		Route::get('/', ['as' => $route_slug.'index', 'uses' => $module_controller.'index']);
		
		Route::get('/{sub_category_slug}', ['as' => $route_slug.'products_listing', 'uses' => $module_controller.'products_listing']);

		Route::get('/{sub_category_slug}/{product_line_slug}', ['as' => $route_slug.'products_listing', 'uses' => $module_controller.'products_listing']);
	});


	// For Jewellery 
	Route::group(array('prefix' => 'jewellery'), function ()
	{
		$route_slug        = "jewellery_";
		$module_controller = "Front\Product\JewelleryController@";

		Route::get('/', ['as' => $route_slug.'index', 'uses' => $module_controller.'index']);

		Route::get('/add_product_to_wish_list/{enc_product_id}', ['as' => $route_slug.'add_product_to_wish_list', 'uses' => $module_controller.'add_product_to_wish_list']);

		Route::get('/{sub_category_slug}', ['as' => $route_slug.'products_listing', 'uses' => $module_controller.'products_listing']);

		Route::get('/{sub_category_slug}/{product_line_slug}', ['as' => $route_slug.'products_listing', 'uses' => $module_controller.'products_listing']);


	});

	// Compare list. 
	Route::group(array('prefix' => 'compare_list'), function ()
	{
		$route_slug        = "compare_list_";
		$module_controller = "Front\Product\CompareListController@";
		Route::post('/add',                    ['as' => $route_slug.'add_product',    'uses' => $module_controller.'add_product']);
		Route::get('/view',                    ['as' => $route_slug.'view',           'uses' => $module_controller.'view']);
		Route::get('/remove/{enc_product_id}', ['as' => $route_slug.'remove_product', 'uses' => $module_controller.'remove_product']);
		Route::get('/clear_all',               ['as' => $route_slug.'clear_all',      'uses' => $module_controller.'clear_all']);
	});


	// For Fashion Jewellery 
	Route::group(array('prefix' => 'fashion-jewellery'), function ()
	{
		$route_slug        = "fashion_jewellery_";
		$module_controller = "Front\Product\FashionJewelleryController@";

		Route::get('/', ['as' => $route_slug.'index', 'uses' => $module_controller.'index']);

		Route::get('/add_product_to_wish_list/{enc_product_id}', ['as' => $route_slug.'add_product_to_wish_list', 'uses' => $module_controller.'add_product_to_wish_list']);

		Route::get('/{sub_category_slug}', ['as' => $route_slug.'products_listing', 'uses' => $module_controller.'products_listing']);

		Route::get('/{sub_category_slug}/{product_line_slug}', ['as' => $route_slug.'products_listing', 'uses' => $module_controller.'products_listing']);
	});


	// For Collection
	Route::group(array('prefix' => 'collection'), function ()
	{
		$route_slug        = "collection_";
		$module_controller = "Front\Product\CollectionController@";
		
		Route::get('/', ['as' => $route_slug.'index', 'uses' => $module_controller.'index']);		
		Route::get('/{collection_slug}', ['as' => $route_slug.'index', 'uses' => $module_controller.'collection']);
	});


	// For Search 
	Route::group(array('prefix' => 'products'), function ()
	{
		$route_slug        = "search_";
		$module_controller = "Front\Product\SearchController@";

		Route::get('/', ['as' => $route_slug.'index', 'uses' => $module_controller.'index']);

	});

	/*-------------------Product Listing Ends-------------------*/	

	// About Us Page
	Route::group(array('prefix' => 'about_us'), function ()
	{
		$route_slug        = "about_us_";
		$module_controller = "Front\FrontPagesController@";
		Route::get('/',		['as' => $route_slug.'about_us', 'uses' => $module_controller.'about_us']);
	});

	

});


?>