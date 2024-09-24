@extends('front.layout.master')
@section('main_content')
<style type="text/css">
	.span-two,.span-three{ display: none; }
	.modal-dialog.modal-address{margin-top: 8%;}
	.box-form.mobilenumber-error .error-smg{line-height: 12px;    bottom: -27px;}
</style>
<!-- Page breadcrumb -->
@include('front.user.layout.breadcrumb')
<!-- /page breadcrumb -->
<div class="container">

	<div class="process-bx">
		<div class="center-row">

			<div class="step_process">
				<div class="step_bor">
					<div class="active_step normal_step" id="logo-personal-details"><i class="fa fa-user"></i>
						<p class="hidden-xs">Personal Details</p>
					</div>
				</div>   

			</div>
			<div class="bg_line">&nbsp;</div>
			<div class="step_process">
				<div class=" step_bor">
					<div class="normal_step" id="logo-billing-details"><i class="fa fa-file-text"></i>
						<p class="hidden-xs">Billing Details</p>
					</div>
				</div>

			</div>
			<div class="bg_line">&nbsp;</div>
			<div class="step_process order-placed">
				<div class="active-step step_bor">
					<div class="normal_step" id="logo-payment"><i class="fa fa-credit-card"></i>
						<p class="hidden-xs">Payment</p>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="row">
@php 
$user = login_user_details('user'); 
@endphp
		<form id="form-order-details" method="post" action="{{$module_url_path.'/place_order'}}">
			{{csrf_field()}}
			<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8 checkout-right-spaces span-one">

				<div class="cart-login">
					<div class="title-logins-accounts">Personal Details</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<div class="box-form">
								<label for="firstname">First Name</label>
								<input id="firstname" name="firstname" value="{{$user->first_name}}" placeholder="Enter your first name" type="text" data-rule-required='true' onkeyup="chk_validation(this)" />
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<div class="box-form">
								<label for="lastname">Last Name</label>
								<input id="lastname"  value="{{$user->last_name}}" name="lastname" placeholder="Enter your last name" type="text" data-rule-required='true' onkeyup="chk_validation(this)" />
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<div class="box-form">
								<label for="emailaddress">Email</label>
								<input id="emailaddress" value="{{$user->email}}" name="emailaddress" placeholder="Enter your Email Address" type="text" data-rule-email="true" data-rule-required='true' />
							</div>
						</div>
						<div class="col-xs-4 col-sm-4 col-md-2 col-lg-2">
							<div class="box-form">
								<label for="mobilemunber">Phone Code</label>
								<div class="select-style select2 udated-select">
									<select class="frm-select" name="country_code">
										@if(isset($arr_country_codes) && is_array($arr_country_codes) && sizeof($arr_country_codes)>0)
										@foreach($arr_country_codes as $code)
										<option value="{{$code['phonecode'] or ''}}" @if($code['id']==$user->country_phone_code_id) selected="selected" @endif>+{{$code['phonecode'] or ''}} ({{$code['CountryCode'] or ''}})</option >
										@endforeach
										@endif
									</select>
								</div>
							</div>
						</div>
						<div class="col-xs-7 col-sm-7 col-md-4 col-lg-4">
							<div class="box-form mobilenumber-error">
								<label for="mobilemunber">Mobile Number</label>
								<input id="mobilemunber" name="mobilemunber" placeholder="Enter your Mobile number" type="text" data-rule-required='true' data-msg-required='Please enter the mobile number for order.' data-rule-pattern="[- +()0-9]+" data-rule-minlength="7" data-rule-maxlength="16" data-msg-minlength="Mobile number should be atleast 7 numbers" data-msg-maxlength="Mobile number should not be more than 16 numbers." value="{{$user->mobile_number}}" />
								<span class="clearfix"></span>
							</div>
						</div>
					</div>  


					<div class="box-form login-carts checkout-mobile-center pull-left">
						<div class="full-button">
							<a href="{{url('/shopping_cart')}}" class="button-shop"><span>Back</span></a>
						</div>
					</div>

					<div class="box-form login-carts checkout-mobile-center">
						<div class="full-button">
							<button type="button" class="button-shop btn-span-one-next"><span>Next</span></button>
						</div>
					</div>

				</div>
			</div>

			<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8 checkout-right-spaces span-two">
				<div class="cart-login dynamic_view">

					<div class="title-logins-accounts">
						Addresses
					</div>

					<div class="row">
						<div class="radio-sections-new">
							@if(isset($arr_addresses) && is_array($arr_addresses) && sizeof($arr_addresses)>0)
							@foreach($arr_addresses as $key=>$address)
							@php  @endphp

							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<div class="radio-btn">
									<input type="checkbox" id="{{$key.'add'}}-option" value="{{base64_encode($address['id'])}}" onchange="uncheck_others(this)" class="address-select" name="address" data-rule-required='true' @if($address['default_address']=='2') checked="checked" @endif>
									<label for="{{$key.'add'}}-option">
										<div class="title-checkboxs">{{$obj_user->first_name or ''}} {{$obj_user->last_name or ''}}</div>
										<div class="address-text">{{$address['flat_no'] or ''}}, {{$address['building_name'] or ''}}, {{$address['address'] or ''}}, {{$address['city'] or ''}}, {{$address['state'] or ''}}, {{$address['country'] or ''}}, {{$address['post_code'] or ''}}</div>
										{{-- <div class="edit-icon-blo" onclick="edit_address('{{base64_encode($address["id"])}}')"><a class="edit-addres" href="javascript:void(0)"></a> </div> --}}
										{{-- <div class="closes-icon-blo"><a class="closes-addres" href="javascript:void(0)" onclick="delete_address('{{base64_encode($address["id"])}}')"></a> </div> --}}
									</label>
									<div class="check"><div class="inside"></div></div>
								</div>
							</div>

							@endforeach
							@else
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<div class="wholsel-pro-block-bg address">
									<a class="plusbtns" href="javascript:void(0)" onclick="add_address()"></a>
								</div>
							</div>
							@endif
						</div>
					</div>
					<div class="box-form login-carts none-psace mobile-btns-shop pull-left">
						<div class="full-button">
							<button type="button" class="button-shop btn-span-two-prev">
								<span>Back</span>
							</button>
						</div>
					</div>

					<div class="box-form login-carts none-psace mobile-btns-shop">
						<div class="full-button">
							<button type="button" class="button-shop btn-span-two-next"><span>Proceed to payment</span></button>
						</div>
					</div>

				</div>
			</div>

			<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8 checkout-right-spaces span-three">
				<div class="cart-login">

					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="title-logins-accounts">Payment</div>
						</div>
						<div class="tabsectionstarts checkout-tabsectionstarts checkbx-list">
							<div class="tabbing_area">
								<div id="horizontalTab">
									<ul class="resp-tabs-list radio-btns checkou-four">
										<li class="radio-btn resp-tab-item resp-tab-active">
											<input type="radio" id="f-option" name="payment_option"	 value="1" checked="checked">
											<label for="f-option">
												<span class="interior-icon">
													<img src="{{url('/front')}}/images/checkout-four-step-1.png" alt="img"/>   
												</span>
												<span class="online-radio-butn">Online Payment</span>
											</label>
											<div class="check"></div>
										</li>
										<li class="radio-btn">
											<input type="radio" id="s-option" name="payment_option" data-rule-required='true' value="2">
											<label for="s-option">
												<span class="interior-icon">
													<img src="{{url('/front')}}/images/checkout-four-step-2.png" alt="img"/>   
												</span>
												<span class="online-radio-butn"> Wire transfer</span>
											</label>
											<div class="check">
												<div class="inside"></div>
											</div>
										</li>

									</ul>
									<div class="resp-tabs-container">
										<div class="resp-tab-content resp-tab-content-active">
											<div class="checkout-accnt-pmts">
												<div class="checkout-tp-checkot">Note</div>
												<div class="clearfix"></div>
												If you prefer cashless and support cashless then you can proceed with online payment option to perform paymets online.
												@if($wallet_total!= 0&& ($wallet_total+($wallet_total/2))<(get_cart_total()+get_cart_total_insurance()))
												<div class="radio-sections-checks">
													<div class="radio-btn">
														<input type="checkbox" id="kk-option" name="apply_wallet" value="yes" >
														<label for="kk-option">
															<p>Apply Wallet (Total Balance {!!session_currency($wallet_total)!!})</p>
														</label>
														<div class="check"></div>
													</div>
												</div>
												@endif

											</div>
											<div class="clearfix"></div>
										</div>

										<div>
											<div class="checkout-accnt-pmts">
												<div class="checkout-tp-checkot">Account Holder Name</div>
												<div class="checkout-tp-inner">{{$arr_bank_details['account_holder_name'] or ''}}</div>
											</div>
											<div class="checkout-accnt-pmts">
												<div class="checkout-tp-checkot">Bank Name</div>
												<div class="checkout-tp-inner">{{$arr_bank_details['bank_name'] or ''}}</div>
											</div>
											<div class="checkout-accnt-pmts">
												<div class="checkout-tp-checkot">Branch</div>
												<div class="checkout-tp-inner">{{$arr_bank_details['branch'] or ''}}</div>
											</div>
											<div class="checkout-accnt-pmts">
												<div class="checkout-tp-checkot">Account Number</div>
												<div class="checkout-tp-inner">{{$arr_bank_details['account_number'] or ''}}</div>
											</div>
											<div class="checkout-accnt-pmts">
												<div class="checkout-tp-checkot">IFSC Code</div>
												<div class="checkout-tp-inner">{{$arr_bank_details['ifsc_code'] or ''}}</div>
											</div>											

											<div class="clearfix"></div>
										</div>

										{{-- <div>
											<div class="checkout-accnt-pmts">
												<div class="checkout-tp-checkot">Wallet</div>
												<div class="checkout-tp-inner">If you prefer cashless and support cashless then you can proceed with online payment option to perform paymets online.</div>
											</div>
											<div class="clearfix"></div>
										</div> --}}
									</div>
								</div>
							</div>

							<div class="check-box ">
								<input id="filled-in-box2" class="filled-in" type="checkbox" name="terms" id="terms" />
								<label for="filled-in-box2">Accept <a href="{{url('/info/terms-of-use')}}">Terms and Conditions</a></label>

							</div>
						</div>
					</div>

					<div class="box-form login-carts none-psace space-on pull-left">
						<div class="full-button">
							<button type="button" class="button-shop btn-span-three-prev">
								<span>Back</span>
							</button>
						</div>
					</div>

					<div class="box-form login-carts none-psace space-on">
						<div class="full-button">
							<a href="javascript:void(0)" class="button-shop btn-submit"><span>Make Payment</span></a>
						</div>
					</div>
				</div>
			</div>

		</form>

		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 ">
			<div class="footer-total-section-shopping login-cart-checkouts-one">
				<div class="title-logins-accounts">Order Summary</div>

				@if(isset($arr_cart_product) && is_array($arr_cart_product) && sizeof($arr_cart_product)>0)
				@foreach($arr_cart_product as $key=>$product)
				<div class="checkout-right-img-section">
					<div class="img-section-shop"> <img src="{{get_resized_image($product['product_image']['image'], $product_image_base_path ,155,204)}}" alt="" /></div>
					<div class="text-section-shop">{{$product['product_details']['product_name']}} <div class="gray-txt-clr">Item: {{$product['product_details']['product_code']}}</div></div>
					<div class="right-text-section-shop">{!!session_currency($product['product_details']['final_price']*$product['product_quantity'])!!}</div>
					<div class="clearfix"></div>
				</div>
				@endforeach
				@endif     

				<div class="list-totl-shopping">
					<div class="list-totl-shopping-left">
						Subtotal
					</div>
					<div class="list-totl-shopping-right"> <span> {!!session_currency(get_cart_subtotal())!!}</span></div>
					<div class="clearfix"></div>
				</div>
				<div class="list-totl-shopping">
					<div class="list-totl-shopping-left">
						Delivery
					</div>
					<div class="list-totl-shopping-right"><span>Free</span></div>
					<div class="clearfix"></div>
				</div>
				<div class="list-totl-shopping">
					<div class="list-totl-shopping-left">
						Insurance
					</div>
					<div class="list-totl-shopping-right">{!!session_currency(get_cart_total_insurance())!!}</div>
					<div class="clearfix"></div>
				</div>

				<div class="list-totl-shopping">
					<div class="list-totl-shopping-left">
						Giftcard @if(get_cart_discount_code()!='')({{get_cart_discount_code()}})@endif
					</div>
					<div class="list-totl-shopping-right discont-amt">- {!!session_currency(get_cart_giftcard_discount())!!}</div>
					<div class="clearfix"></div>
				</div>

				<div class="list-totl-shopping">
					<div class="list-totl-shopping-left">
						Total Savings
					</div>
					<div class="ordr-ttl-txt-right"><i>{!!session_currency(get_cart_total_discount())!!}</i></div>
					<div class="clearfix"></div>
				</div>
				
				<div class="order-totl-fotr">
					<div class="ordr-ttl-txt"> Order Total </div>
					<div class="ordr-ttl-txt-right">{!!session_currency(get_cart_total()+get_cart_total_insurance())!!}	</div>

					<div class="clearfix"></div>
				</div>


			</div>
		</div>   
	</div>
</div>


<div id="myModal" class="gift-cartmodal modal fade" role="dialog">
	<div class="modal-dialog modal-address">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"></button>
				<div class="title-modals">
					Edit Address
				</div>
			</div>
			<div class="modal-body">
				<form id="form-edit-address" method="post" action="">
					{{csrf_field()}}
					<input type="hidden" name="el" id="el">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div class="box-form">
							<label for="flatnumber">Flat No.</label>
							<input id="flatnumber" name="flatnumber" placeholder="Enter your flat no." type="text" data-rule-required='true' />
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div class="box-form">
							<label for="buildingname">Building Name</label>
							<input id="buildingname" name="buildingname" placeholder="Enter your Building name" type="text" data-rule-required='true' />
							<!-- <div class="error-smg">Enter Correct... </div>-->
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="box-form">
							<label for="address">Address</label>
							<textarea name="address" id="address" placeholder="Enter your Address" data-rule-required='true'></textarea>
							<!-- <div class="error-smg">Enter Correct... </div>-->
						</div>
					</div>


					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div class="box-form">
							<label for="city">City</label>
							<input id="city" name="city" placeholder="Enter your city" type="text" data-rule-required='true' />
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div class="box-form">
							<label for="state">State</label>
							<input id="state" name="state" placeholder="Enter your state" type="text" data-rule-required='true' />
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div class="box-form">
							<label for="country">Country</label>
							<input id="country" name="country" placeholder="Enter your country" type="text" data-rule-required='true' />
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div class="box-form">
							<label for="postcode">Post Code</label>
							<input id="postcode" name="postcode" placeholder="Enter your Post code" type="text" data-rule-required='true' />
							<!-- <div class="error-smg">Enter Correct... </div>-->
						</div>
					</div>
				</form>

				<div class="full-button">
					<a class="button-shop btn-update" href="javascript:void(0)"><span>Update</span></a>
				</div>
			</div>

		</div>

	</div>
</div>

<div id="myModalAdd" class="gift-cartmodal modal fade" role="dialog">
	<div class="modal-dialog modal-address">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"></button>
				<div class="title-modals">
					Add New Address
				</div>
			</div>
			<div class="modal-body">
				<form id="form-add-address" method="post" action="">
					{{csrf_field()}}
					<input type="hidden" name="el" id="el">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div class="box-form">
							<label for="flatnumber">Flat No.</label>
							<input id="flatnumber" name="flatnumber" placeholder="Enter your flat no." type="text" data-rule-required='true' />
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div class="box-form">
							<label for="buildingname">Building Name</label>
							<input id="buildingname" name="buildingname" placeholder="Enter your Building name" type="text" data-rule-required='true' />
							<!-- <div class="error-smg">Enter Correct... </div>-->
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="box-form">
							<label for="address">Address</label>
							<textarea name="address" id="address" placeholder="Enter your Address" data-rule-required='true'></textarea>
							<!-- <div class="error-smg">Enter Correct... </div>-->
						</div>
					</div>


					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div class="box-form">
							<label for="city">City</label>
							<input id="city" name="city" placeholder="Enter your city" type="text" data-rule-required='true' />
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div class="box-form">
							<label for="state">State</label>
							<input id="state" name="state" placeholder="Enter your state" type="text" data-rule-required='true' />
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div class="box-form">
							<label for="country">Country</label>
							<input id="country" name="country" placeholder="Enter your country" type="text" data-rule-required='true' />
						</div>
					</div>
					<input type="reset" name="reset" hidden="hidden" id="btn-reset">

					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div class="box-form">
							<label for="postcode">Post Code</label>
							<input id="postcode" name="postcode" placeholder="Enter your Post code" type="text" data-rule-required='true' />
							<!-- <div class="error-smg">Enter Correct... </div>-->
						</div>
					</div>
				</form>

				<div class="full-button">
					<a class="button-shop btn-save" href="javascript:void(0)"><span>Save</span></a>
				</div>
			</div>

		</div>

	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		var validator = $( "#form-order-details" ).validate({errorClass: "error-smg", highlight: function(element) { }, errorElement: "span"});


		$('.btn-span-one-next').click(function(){

			validator.element( "#firstname" );
			validator.element( "#lastname" );
			validator.element( "#emailaddress" );
			validator.element( "#mobilemunber" );

			if($( "#form-order-details" ).valid() == true)
			{

				$('.normal_step').removeClass("active_step");
				$('#logo-billing-details').addClass('active_step');

				$('.span-one').fadeOut('slow', function(){
					$('.span-two').fadeIn();
				});

			}
		});



		$('.btn-span-three-prev').click(function(){

			$('.normal_step').removeClass("active_step");
			$('#logo-billing-details').addClass('active_step');

			$('.span-three').fadeOut('slow', function(){
				$('.span-two').fadeIn();
			});

		});

		$('.btn-span-two-prev').click(function(){

			$('.normal_step').removeClass("active_step");
			$('#logo-personal-details').addClass('active_step');

			$('.span-two').fadeOut('slow', function(){
				$('.span-one').fadeIn();
			});

		});
	});



</script>

<script type="text/javascript">
	$(document).ready(function(){

		var validator = $( "#form-order-details" ).validate({errorClass: "error-smg", highlight: function(element) { }, errorElement: "span"});
		$('.btn-span-two-next').click(function(){
			validator.element('#address');

			if($( "#form-order-details" ).valid() == true)
			{
				$('.normal_step').removeClass("active_step");
				$('#logo-payment').addClass('active_step');

				$('.span-two').fadeOut('slow', function(){
					$('.span-three').fadeIn();
				});
			}

		});

		$('.btn-submit').click(function(){
			if($( "#form-order-details" ).valid() == true)
			{
				if($('[name="terms"]').prop('checked')==false)
				{
					swal("", "Please accept terms & conditions", "error");
				}
				else
				{
					$( "#form-order-details" ).submit();
				}

			}

		});




		$('.btn-update').click(function(){
			var edit_validator = $('#form-edit-address').validate({errorClass: "error-smg", highlight: function(element) { }, errorElement: "span"});
			if($('#form-edit-address').valid()==true)
			{
				var values = $("#form-edit-address").serialize();
				$.ajax({
					type: 'post',
					url: "{{$module_url_path.'/update_address'}}",
					data: values,
					beforeSend: showProcessingOverlay(),
					success:function(data){
						if(data.status=='success')
						{
							$.ajax({
								url : '{{$module_url_path}}'+'/order_details'
							}).done(function (data) {
								$('.dynamic_view').html(data);  
								$('#myModal').modal('hide');
								hideProcessingOverlay();
							});

						}
					}
				});

			}
		});

		$('.btn-save').click(function(){
			var edit_validator = $('#form-add-address').validate({errorClass: "error-smg", highlight: function(element) { }, errorElement: "span"});
			if($('#form-add-address').valid()==true)
			{
				var values = $("#form-add-address").serialize();
				$.ajax({
					type: 'post',
					url: "{{$module_url_path.'/add_address'}}",
					data: values,
					beforeSend: showProcessingOverlay(),
					success:function(data){
						if(data.status=='success')
						{
							$.ajax({
								url : '{{$module_url_path}}'+'/order_details'
							}).done(function (data) {
								$('.dynamic_view').html(data);  
								$('#myModalAdd').modal('hide');
								hideProcessingOverlay();
								$('#btn-reset').click();
							});

						}
					}
				});

			}
		});

	});

	function edit_address(el)
	{
		$.ajax({
			url:'{{$module_url_path}}'+'/get_address/'+el,
			type: 'get',
			success:function(data)
			{
				if(data.status=='success')
				{
					$('#flatnumber').val(data.address.flat_no);
					$('#buildingname').val(data.address.building_name);
					$('#address').val(data.address.address);
					$('#city').val(data.address.city);
					$('#state').val(data.address.state);
					$('#country').val(data.address.country);
					$('#postcode').val(data.address.post_code);
					$('#el').val(el);

					$("#myModal").modal({
						show: true,
						backdrop: 'static'
					});
				}
			}

		});

	}

	function delete_address(el)
	{



		swal({
			title: "Are you sure?",
			text: "Do you want to remove address ?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: '#DD6B55',
			confirmButtonText: 'Yes',
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false
		},
		function(isConfirm){

			if (isConfirm){
				$.ajax({
					url:'{{$module_url_path}}'+'/delete_address/'+el,
					type: 'get',
					success:function(data)
					{
						if(data.status=='success')
						{
							$.ajax({
								url : '{{$module_url_path}}'+'/order_details'
							}).done(function (data) {
								$('.dynamic_view').html(data);  
								$('#myModalAdd').modal('hide');
								hideProcessingOverlay();
							});
						}
					}

				});
				swal.close();
			}
			else
			{
				swal.close();
			}
		});
	}

	function add_address()
	{
		$("#myModalAdd").modal({
			show: true,
			backdrop: 'static'
		});
	}

	function uncheck_others(element)
	{
		if($(element).prop('checked'))
		{
			$('.address-select').prop('checked', false);
			$(element).prop('checked', true);
		}
		else
		{
			$('.address-select').prop('checked', false);
			$(element).prop('checked', false);
		}

	}

</script>
@endsection
