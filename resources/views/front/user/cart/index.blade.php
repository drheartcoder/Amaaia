@extends('front.layout.master')
@section('main_content')
<style type="text/css">
	.error.error-giftcard{position: absolute; left: 0px;color: red;}
	#error-otp{ display: none; }
</style>
<div class="bradcrum-inner">
	<div class="pul-left-title">
		Shopping Cart
	</div>
	<div class="pul-right-sublink">
		<a href="{{url('/')}}">Home</a> / <span>Shopping Cart</span>
	</div>
	<div class="clearfix"></div>
</div>
<div class="min-hieght-class cart-shopping-img dynamic_view">

	@if(get_cart_count()>0)
	<div class="container">
		<div class="shopping-cart-titles">Shopping Cart <span>({{get_cart_count()}} Items)</span></div>
		<div class="table-shopping-cart">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>Product Name</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Insurance</th>
							<th>Subtotal</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<!-- Section 1 Start-->
						@if(isset($arr_cart_product) && is_array($arr_cart_product) && sizeof($arr_cart_product)>0)
						@foreach($arr_cart_product as $key=>$product)
						{{-- {{dd($product)}} --}}
						<tr>
							<td>
								<div class="table-content-txt">
									<div class="shopping-tabl-img">
										<img src="{{get_resized_image($product['product_image']['image'], $product_image_base_path ,67,100)}}" alt="" />
									</div>
									<div class="content-shpng">
										<div class="table-title-shoppings">
										<a href="{{url('/'.$product['product_details']['category']['slug'].'/'.$product['product_details']['sub_category']['slug'].'/'.$product['product_details']['slug'])}}" style="color: #f6929b">{{$product['product_details']['product_name']}}</a>
										</div>
										<div class="ring-size-tbl">
										@if(isset($product['size_details']['size_name']) && $product['size_details']['size_name']!='')
										Size: <span>{{$product['size_details']['size_name']}}</span> 
										@endif

										<a class="flipdashboard-shopping" href="javascript:void(0)" onclick="quick_view('{{"paneldashboard-".$key}}')">Quick View</a></div>
									</div>
								</div>
							</td>
							<td>
								{!!session_currency($product['product_details']['final_price'])!!}
							</td>
							<td>
								<div class="select-box">
									<input type="number" min="1" max="5" value="{{$product['product_quantity']}}" disabled="disabled" />
									<div class="arros">
										<button class="up-arrow-selct" id="up-{{$key}}" onclick="maximize('{{base64_encode($product['id'])}}')"><i class="fa fa-angle-up"></i></button>
										<button class="down-arrow-selct" onclick="minimize('{{base64_encode($product['id'])}}')"><i class="fa fa-angle-down"></i></button>
									</div>
								</div>
							</td>
							<td>
								@if(isset($product['insurance_details']['price']))
								{!!session_currency(($product['insurance_details']['price']/100*$product['product_details']['final_price'])*$product['product_quantity'])!!}

								@else
								NA
								@endif
							</td>
							
							<td>
							{!!session_currency($product['product_details']['final_price']*$product['product_quantity'])!!}
							</td>
							<td>
								<button type="button" class="close-buton-tr" onclick="remove('{{base64_encode($product['id'])}}')"></button>
							</td>
						</tr>
						<tr class="paneldashboard-shopping" id="paneldashboard-{{$key}}">
							<td colspan="5">
								<div class="tabsection-listing-detls">
									<div class="faq-text">

										<div class="tabbing_area">
											<div class="horizontalTab1">
												<ul class="resp-tabs-list">
													<li class="resp-tab-active">Metal Details</li>
													<li>Gemstone Details</li>
												</ul>
												<div class="resp-tabs-container">
													<!--tab-1 start-->
													<div class="resp-tab-content-active">

														<div class="table-ammaia">
															<div class="table-responsive">
																<table class="table table-striped">

																	<tbody>
																		@if($product['product_metals']['metal_name']['metal_name'])
																		<tr>
																			<td> Metal</td>
																			<td> {{$product['product_metals']['metal_name']['metal_name'] or ''}} </td>
																		</tr>
																		@endif
																		@if($product['product_metals']['metal_color']['metal_color'])
																		<tr>
																			<td> Metal Color</td>
																			<td> {{$product['product_metals']['metal_color']['metal_color'] or ''}} </td>
																		</tr>
																		@endif

																		@if($product['product_metals']['metal_quality']['quality_name'])
																		<tr>
																			<td> Metal Quality</td>
																			<td> {{$product['product_metals']['metal_quality']['quality_name'] or ''}} </td>
																		</tr>
																		@endif

																	</tbody>
																</table>
															</div>
														</div>

													</div>
													<!--tab-2 start-->
													<div>
														<div class="table-ammaia">
															<div class="table-responsive">
																<table class="table table-striped">

																	<tbody>
																		@if($product['product_gemstone']['gemstone_type']['type'])
																		<tr>
																			<td> Gemstone</td>
																			<td> {{$product['product_gemstone']['gemstone_type']['type'] or ''}} </td>
																		</tr>
																		@endif
																		@if($product['product_gemstone']['gemstone_color']['gemstone_color'])
																		<tr>
																			<td> Gemstone Color</td>
																			<td> {{$product['product_gemstone']['gemstone_color']['gemstone_color'] or ''}} </td>
																		</tr>
																		@endif

																		@if($product['product_gemstone']['gemstone_quality']['gemstone_quality'])
																		<tr>
																			<td> Gemstone Quality</td>
																			<td> {{$product['product_gemstone']['gemstone_quality']['gemstone_quality'] or ''}} </td>
																		</tr>
																		@endif

																		@if($product['product_gemstone']['gemstone_shape']['shape_name'])
																		<tr>
																			<td> Gemstone Shape</td>
																			<td> {{$product['product_gemstone']['gemstone_shape']['shape_name'] or ''}} </td>
																		</tr>
																		@endif																		

																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

									</div>
								</div>
							</td>
						</tr>
						<!-- Section 1 End-->
						@endforeach
						@endif
					</tbody>
				</table>
			</div>
			<div class="table-footer-section-shipping">
				<div class="list-tabl-footer-dwn">
					<span></span> 30 Days Returns
				</div>
				<div class="list-tabl-footer-dwn">
					<span></span> Eligible for lifetime Exchange &amp; Buy Back
				</div>
				<div class="list-tabl-footer-dwn lastchild-space">
					<span></span> Free &amp; Insured Delivery
				</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-lg-offset-8 col-md-offset-6 col-sm-offset-6 col-xs-offset-0">
				<div class="footer-total-section-shopping">
					<div class="list-totl-shopping">
						<div class="list-totl-shopping-left">
							Subtotal
						</div>
						<div class="list-totl-shopping-right"> <span> {!!session_currency(get_cart_subtotal())!!} </span></div>
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
						<div class="list-totl-shopping-right discont-amt"> {!!session_currency(get_cart_total_insurance())!!}</div>
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
						<div class="list-totl-shopping-right"> <i>{!!session_currency(get_cart_total_discount())!!}</i></div>
						<div class="clearfix"></div>
					</div>

					<div class="order-totl-fotr">
						<div class="ordr-ttl-txt"> Order Total </div>
						<div class="ordr-ttl-txt-right"> {!!session_currency(get_cart_total()+get_cart_total_insurance())!!}</div>
						<div class="clearfix"></div>
					</div>
					<div class="box-form shoppings-crts">
						<label for="flatno">Gift Card Code</label>

						<form id="form-gift-card" method="post" action=""> 
							{{csrf_field()}}
							<input id="flatno" name="code" placeholder="Enter gift card code here" type="text" oninput="clear_error()" />

						</form>

						<div class="error error-giftcard" id="error"></div>

						<a class="button-shop shopping-apply-btn btn-giftcard" href="javascript:void(0)"><span>Apply</span></a>

						<br/>
						<div class="alert alert-danger alert-dismissible fade in error-flash" hidden="">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Error!</strong> Invalid giftcard code.
						</div>

					</div>
					<div class="button-section-user-aacount btn-shop-btn">
						<div class="fullfil-button">
							<a class="button-shop" href="javascript:void(0)" onclick="check_cart()"><span>Proceed to checkout</span></a>
						</div>
						<div class="left-cancle-buton">
							<a class="button-shop" href="{{url('/')}}"><span>Continue Shopping</span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@else
	<div class="min-hieght-class cart-shopping-img">
        <div class="container">
           <div class="empty-cart-div">
               <img src="{{url('/front')}}/images/cart-empty-image.png" alt="" />
           </div>
          <div class="center-btn">
             <a class="button-shop" href="{{url('/')}}"><span>Continue Shopping</span></a>
          </div>        
        </div>
    </div>
	@endif

</div>

<div class="clearfix"></div>

<div id="myModal" class="gift-cartmodal modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"></button>
				<div class="title-modals">
					OTP
				</div>
			</div>
			<div class="modal-body">
				<form id="form-otp-verify" method="post" action="">
					{{csrf_field()}}
					<div class="box-form">
						<label for="input_otp">OTP Code</label>
						<input id="input_otp" name="val_otp" placeholder="Enter your OTP Code" type="text" data-rule-required='true' />
						<span id="otp-error" class="error-smg"></span>
					</div>
				</form>
				<div class="full-button">
					<a class="button-shop btn-otp-verify" href="javascript:void(0)"><span><i class="fa fa-check"></i> Verify OTP</span></a>
				</div>


				<div class="full-button">
					<p>Don't get the code yet? Request the another one</p>
					<a class="button-shop btn-otp-resend" href="javascript:void(0)"><span>Resend OTP</span></a>
				</div>
			</div>

		</div>

	</div>
</div>

<script type="text/javascript">
	$('.horizontalTab1').easyResponsiveTabs({
		type: 'default',
		width: 'auto',
		fit: true,
		closed: 'accordion',
		activate: function(event) {
			var $tab = $(this);
			var $info = $('#tabInfo');
			var $name = $('span', $info);
			$name.text($tab.text());
			$info.show();
		}
	}); 
	function quick_view(el)
	{
		$('#'+el).fadeToggle("slow");
	}

	$(document).on('click', '.btn-giftcard', function(){
		if($('#flatno').val()=='')
		{
			$('.error-giftcard').html('Please enter giftcard code.');
		}
		else
		{
			var tp_val = $('#flatno').val();

			if(tp_val)
			{
				$.ajax({
					url:'{{$module_url_path}}/apply_giftcard/'+tp_val,
					type:'get',
					beforeSend: showProcessingOverlay(),
					success:function(data)
					{
						if(data.status=='success')
						{
							$("#myModal").modal({
								show: true,
								backdrop: 'static'
							});
							hideProcessingOverlay(); 
						}

						if(data.status=='error')
						{
							hideProcessingOverlay(); 

							$('.error-flash').fadeIn(function()
							{
								$('#flatno').val('');
								$(this).fadeOut(3000);
							});
						}
					}
				});
			}	
		}
	});

	function clear_error()
	{
		$('.error-giftcard').html('');
	}

	function maximize(el)
	{

		$.ajax({
			url:'{{$module_url_path}}/maximize_quantity/'+el,
			type:'get',
			success:function(data)
			{
				if(data=='success')
				{
					$.ajax({
						url : '{{$module_url_path}}',
						beforeSend: showProcessingOverlay(),
					}).done(function (data) {
						$('.dynamic_view').html(data); 
						hideProcessingOverlay(); 
					});
				}
			}
		});
	}

	function minimize(el)
	{
		$.ajax({
			url:'{{$module_url_path}}/minimize_quantity/'+el,
			type:'get',
			success:function(data)
			{
				if(data=='success')
				{
					$.ajax({
						url : '{{$module_url_path}}',
						beforeSend: showProcessingOverlay(),
					}).done(function (data) {
						$('.dynamic_view').html(data); 
						hideProcessingOverlay(); 
					});
				}
			}
		});
	}

	function remove(el)
	{

		swal({
			title: "Are you sure?",
			text: "Do you want to remove product ?",
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
					url:'{{$module_url_path}}/remove_product/'+el,
					type:'get',
					beforeSend: showProcessingOverlay(),
					success:function(data)
					{
						swal.close();
						if(data=='success')
						{
							$.ajax({
								url : '{{$module_url_path}}'
							}).done(function (data) {
								$('.dynamic_view').html(data);  
								$('.cart_count').html(parseInt($('.cart_count').html())-1);
								hideProcessingOverlay();
							});
						}
					}
				});
			}
			else
			{
				swal.close();
			}
		});
	}
	$("#myModal").modal({
		show: false,
		backdrop: 'static'
	});

	$(document).on('click', '.btn-otp-verify', function(){
		var validator = $( "#form-otp-verify" ).validate({
			errorClass: "error-smg",
			errorElement: "span",
			highlight: function(element) { }
		});
		validator.element( "#input_otp" );

		if($("#form-otp-verify").valid()==true)
		{
			var values = $("#form-otp-verify").serialize();

			$.ajax({
				type: 'POST',
				url: "{{$module_url_path.'/verify_otp'}}",
				data: values,
				beforeSend: showProcessingOverlay(),
				success:function(data){
					if(data.status=='success')
					{
						var from_values = $("#form-gift-card").serialize();
						$.ajax({
							type: 'POST',
							url: "{{$module_url_path.'/store_gift_card'}}",
							data: from_values,
							beforeSend: showProcessingOverlay(),
							success:function(data){
								if(data.status=='success')
								{
									$('#myModal').modal('hide');
									hideProcessingOverlay();
									$.ajax({
										url : '{{$module_url_path}}'
									}).done(function (data) {
										$('.dynamic_view').html(data);  
										$('.cart_count').html(parseInt($('.cart_count').html())-1);
										$( "#input_otp").val('');
									});

								}
								if(data.status=='error')
								{
									hideProcessingOverlay();
									$('#myModal').modal('hide');
									swal('',data.message,'error');
									$( "#input_otp").val('');
								}
							}
						});
					}
					if(data.status=='error')
					{
						$('#otp-error').html(data.message);
						$('#otp-error').show();
						hideProcessingOverlay();
					}
				}
			});
		}
	});
	$(document).on('click', '.btn-otp-resend', function(){
		$('.btn-giftcard').click();
	});

	function check_cart()
	{
		var count = "{{get_cart_count()}}";
		count = parseInt(count);
		if(count>0)
		{
			window.location = "{{url('/')}}/order/order_details";
		}
		else
		{
			swal('','Please add item\'s to cart.');
		}
	}
	$(document).keypress(
    function(event){
     if (event.which == '13') {
        event.preventDefault();
      }


});
</script>
@endsection	