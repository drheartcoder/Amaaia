
@extends('admin.layout.master')    
@section('main_content')
<!-- Page header -->
@include('admin.layout.breadcrumb')  
<style type="text/css">
#product_image{
	height: 80px;
}
</style>
<!-- /page header -->

<!-- BEGIN Main Content -->

<!-- Content area -->
<div class="content">
	@include('admin.layout._operation_status')
	<!-- Invoice template -->
	<div class="panel panel-white">
		<div class="panel-heading">
			<h6 class="panel-title">{{title_case($arr_product['product_name'])	}}</h6>
		</div>

		<div class="panel-body">
			<div class="row invoice-payment">
				<div class="col-sm-6">
					<div class="content-group">
						<h6>Product Details</h6>
						<div class="table-responsive no-border">
							<table class="table">
								<tbody>
									<tr>
										<th>Order Id:</th>
										<td class="text-right">
											{{isset($arr_product['order_id'])?$arr_product['order_id']:""}}
										</td>
									</tr>
									<tr>
										<th>Product Name:</th>
										<td class="text-right">
											{{isset($arr_product['product_name'])?$arr_product['product_name']:""}}
										</td>
									</tr>
									<tr>
										<th>Product Category:</th>
										<td class="text-right">
											{{isset($arr_product['product_category_name'])?$arr_product['product_category_name']:""}}
										</td>
									</tr>
									<tr>
										<th>Product Sub Category:</th>
										<td class="text-right">
											{{isset($arr_product['product_subcategory_name'])?$arr_product['product_subcategory_name']:""}}
										</td>
									</tr>
									<tr>
										<th>Product line Name:</th>
										<td class="text-right">
											{{isset($arr_product['product_line_name'])?$arr_product['product_line_name']:""}}
										</td>
									</tr>
									<tr>
										<th>Product Setting Name:</th>
										<td class="text-right">
											{{isset($arr_product['product_setting_name'])?$arr_product['product_setting_name']:""}}
										</td>
									</tr>
									<tr>
										<th>Product Ring Shoulder Name:</th>
										<td class="text-right">
											{{isset($arr_product['product_ring_shoulder_name'])?$arr_product['product_ring_shoulder_name']:""}}
										</td>
									</tr>
									<tr>
										<th>Product Metal Detailing Name:</th>
										<td class="text-right">
											{{isset($arr_product['product_metal_detailing_name'])?$arr_product['product_metal_detailing_name']:""}}
										</td>
									</tr>
									<tr>
										<th>Product Band Setting Name:</th>
										<td class="text-right">
											{{isset($arr_product['product_band_setting_name'])?$arr_product['product_band_setting_name']:""}}
										</td>
									</tr>	
									<tr>
										<th>Product look Name:</th>
										<td class="text-right">
											{{isset($arr_product['product_look_name'])?$arr_product['product_look_name']:""}}
										</td>
									</tr>	
									<tr>
										<th>Product Shank Type Name:</th>
										<td class="text-right">
											{{isset($arr_product['product_shank_type_name'])?$arr_product['product_shank_type_name']:""}}
										</td>
									</tr>
									
									<tr>
										<th>Product Discount:</th>
										<td class="text-right">{{isset($arr_product['product_discount'])?$arr_product['product_discount'].'%':""}}</td>
									</tr>
									<tr>
										<th>Product Additional Markup:</th>
										<td class="text-right">{{isset($arr_product['product_additional_markup'])?$arr_product['product_additional_markup'].'%':""}}</td>
									</tr>
									<tr>
										<th>Product Supplier Markup:</th>
										<td class="text-right">{{isset($arr_product['product_supplier_markup'])?$arr_product['product_supplier_markup'].'%':""}}</td>
									</tr>
									<tr>
										<th>Market Orientation Markup:</th>
										<td class="text-right">{{isset($arr_product['product_market_orientation'])?$arr_product['product_market_orientation'].'%':"NA"}}</td>
									</tr>
									<tr>
										<th>Product Transaction Charges:</th>
										<td class="text-right">{{isset($arr_product['product_transaction_charges'])?$arr_product['product_transaction_charges'].'%':""}}</td>
									</tr>
									<tr>
										<th>Product Gst:</th>
										<td class="text-right">{{isset($arr_product['product_gst'])?$arr_product['product_gst'].'%':""}}</td>
									</tr>	
									<tr>
										<th>Product Insurance:</th>
										<td class="text-right">{{isset($arr_product['product_insurance'])?$arr_product['product_insurance'].'%':""}}</td>
									</tr>	
									<tr>
										<th>Product Discount(<i class="fa fa-inr"></i>):</th>
										<td class="text-right">{{isset($arr_product['discount_on_product'])?$arr_product['discount_on_product']:""}}</td>
									</tr>		
									<tr>
										<th>Additional Markup On Product(<i class="fa fa-inr"></i>):</th>
										<td class="text-right">{{isset($arr_product['additional_markup_on_product'])?$arr_product['additional_markup_on_product']:""}}</td>
									</tr>
									<tr>
										<th>Supplier Markup On Product(<i class="fa fa-inr"></i>):</th>
										<td class="text-right">{{isset($arr_product['supplier_markup_on_product'])?$arr_product['supplier_markup_on_product']:""}}</td>
									</tr>
									<tr>
										<th>Transaction Charges On Product(<i class="fa fa-inr"></i>):</th>
										<td class="text-right">{{isset($arr_product['transaction_charges_on_product'])?$arr_product['transaction_charges_on_product']:""}}</td>
									</tr>		
									<tr>
										<th>Market Orientation On Product(<i class="fa fa-inr"></i>):</th>
										<td class="text-right">{{isset($arr_product['market_orientation_on_product'])?$arr_product['market_orientation_on_product']:""}}</td>
									</tr>	
									<tr>
										<th>Gst On Product(<i class="fa fa-inr"></i>):</th>
										<td class="text-right">{{isset($arr_product['gst_on_product'])?$arr_product['gst_on_product']:""}}</td>
									</tr>	
									<tr>
										<th>Insurance On Product(<i class="fa fa-inr"></i>):</th>
										<td class="text-right">{{isset($arr_product['insurance_on_product'])?$arr_product['insurance_on_product']:""}}</td>
									</tr>
									<tr>
										<th>Product Price (<i class="fa fa-inr"></i>):</th>
										<td class="text-right">{{isset($arr_product['product_price'])?$arr_product['product_price']:""}}</td>
									</tr>
									<tr>
										<th>Product Final Price (<i class="fa fa-inr"></i>):</th>
										<td class="text-right">{{isset($arr_product['product_final_price'])?$arr_product['product_final_price']:""}}</td>
									</tr>		
								</tbody>
							</table>
						</div>
					</div>
					
				</div>

				<div class="col-sm-6">
					<div class="content-group">
						<h6>Product Details</h6>
						<div class="table-responsive no-border">
							<table class="table">
								<tbody>
									<tr>
										<th>Product Metal Weight:</th>
										<td class="text-right">{{isset($arr_product['product_metal_weight'])?$arr_product['product_metal_weight']:""}} gm</td>
									</tr>													
									<tr>
										<th>Product Height:</th>
										<td class="text-right">{{isset($arr_product['product_height'])?$arr_product['product_height']:""}} mm</td>
									</tr>	
									<tr>
										<th>Product Width:</th>
										<td class="text-right">{{isset($arr_product['product_width'])?$arr_product['product_width']:""}} mm</td>
									</tr>
									<tr>
										<th>Product Length:</th>
										<td class="text-right">{{isset($arr_product['product_length'])?$arr_product['product_length']:""}} mm</td>
									</tr>
									<tr>
										<th>Product Quantity:</th>
										<td class="text-right">{{isset($arr_product['product_quantity'])?$arr_product['product_quantity']:""}}</td>
									</tr>
									<tr>
										<th>Product Code:</th>
										<td class="text-right">{{isset($arr_product['product_code'])?$arr_product['product_code']:""}}</td>
									</tr>
									<tr>
										<th>Product Type:</th>
										<td class="text-right">
											@if(isset($arr_product['product_type']) && $arr_product['product_type']=="1")
											Classic
											@elseif(isset($arr_product['product_type']) && $arr_product['product_type']=="2")
											Luxury
											@endif	
										</td>
									</tr>
									<tr>
										<th>Product Delivery Date:</th>
										<td class="text-right">{{isset($arr_product['product_delivery_date'])?$arr_product['product_delivery_date']:""}}</td>
									</tr>	
									<tr>
										<th>Name On Product:</th>
										<td class="text-right">{{isset($arr_product['name_on_product']) && !empty($arr_product['name_on_product']) ?$arr_product['name_on_product']:"NA"}}</td>
									</tr>	
									<tr>
										<th>Product Insurance Company:</th>
										<td class="text-right">{{isset($arr_product['product_insurance_company'])?$arr_product['product_insurance_company']:""}}</td>
									</tr>	
									<tr>
										<th>Product Metal Type:</th>
										<td class="text-right">{{isset($arr_product['product_metal_type'])?$arr_product['product_metal_type']:""}}</td>
									</tr>	
									<tr>
										<th>Product Metal Color:</th>
										<td class="text-right">{{isset($arr_product['product_metal_color'])?$arr_product['product_metal_color']:""}}</td>
									</tr>
									<tr>
										<th>Product Metal Quality:</th>
										<td class="text-right">{{isset($arr_product['product_metal_quality'])?$arr_product['product_metal_quality']:""}}</td>
									</tr>
									<tr>
										<th>Product Gemstone Type:</th>
										<td class="text-right">{{isset($arr_product['product_gemstone_type'])?$arr_product['product_gemstone_type']:""}}</td>
									</tr>
									<tr>
										<th>Product Gemstone Color:</th>
										<td class="text-right">{{isset($arr_product['product_gemstone_color'])?$arr_product['product_gemstone_color']:""}}</td>
									</tr>
									<tr>
										<th>Product Gemstone Quality:</th>
										<td class="text-right">{{isset($arr_product['product_gemstone_quality'])?$arr_product['product_gemstone_quality']:""}}</td>
									</tr>
									<tr>
										<th>Product Gemstone Shape:</th>
										<td class="text-right">{{isset($arr_product['product_gemstone_shape'])?$arr_product['product_gemstone_shape']:""}}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="content-group">
						<h6>Supplier Details</h6>
					</div>	
					<div class="table-responsive no-border">
						<table class="table">
							<tbody>
								<tr>
									<th>Name:</th>
									<td class="text-right">
										{{isset($arr_product['supplier_details']['first_name'])?$arr_product['supplier_details']['first_name'].' '.$arr_product['supplier_details']['last_name']:""}}
									</td>
								</tr>
								<tr>
									<th>Address:</th>
									<td class="text-right">
										{{isset($arr_product['supplier_details']['address'])?$arr_product['supplier_details']['address']:""}}
									</td>
								</tr>
								<tr>
									<th>Mobile Number:</th>
									<td class="text-right">
										{{isset($arr_product['supplier_details']['mobile_number'])?$arr_product['supplier_details']['mobile_number']:""}}
									</td>
								</tr>
								<tr>
									<th>Email:</th>
									<td class="text-right">
										{{isset($arr_product['supplier_details']['email'])?$arr_product['supplier_details']['email']:""}}
									</td>
								</tr>
							</tbody>
						</table>
					</div>					
				</div>
			</div>
			<div class="row invoice-payment">
				<div class="col-sm-6">
					<form class="form-horizontal" id="frm_replacement_amt" name="frm_replacement_amt" action="{{url($module_url_path.'/accept_product')}}" method="post" enctype="multipart/form-data">
						<div class="content-group">
							<h6>Product replacement request Details</h6>
							<div class="table-responsive no-border">
								<table class="table">
									<tbody>
										<tr>
											<th>Order Id:</th>
											<td class="text-right">
												{{isset($arr_product['order_id'])?$arr_product['order_id']:""}}
											</td>
										</tr>

										<tr>
											<th>Item No:</th>
											<td class="text-right">
												{{isset($arr_product['item_number'])?$arr_product['item_number']:""}}
											</td>
										</tr>

										<tr>
											<th>Customer Name:</th>
											<td class="text-right">
												{{$arr_product['replacement_request']['customer_details']['first_name'] or ""}}
												{{$arr_product['replacement_request']['customer_details']['last_name'] or ""}}
											</td>
										</tr>
										
										<tr>
											<th>Delivery Method:</th>
											<td class="text-right">
												{{$arr_product['replacement_request']['delivery_method'] or "NA"}}
											</td>
										</tr>

										<tr>
											<th>Product Price <i class="fa fa-inr"></i>:</th>
											<td class="text-right">{{isset($arr_product['product_final_price'])?$arr_product['product_final_price']:""}}</td>
										</tr>
										
										@if(isset($arr_product['replacement_request']['wallet_details']['amount_credited']) && !empty($arr_product['replacement_request']['wallet_details']['amount_credited']))
											<tr>
												<th>Transfered amount to wallet <i class="fa fa-inr"></i>:</th>
												<td class="text-right">
													
													{{$arr_product['replacement_request']['wallet_details']['amount_credited'] or ''}}
												</td>
											</tr>
										@endif

										<tr>
											<th>Mobile No:</th>
											<td class="text-right">
												{{isset($arr_product['replacement_request']['mobile_number']) ? $arr_product['replacement_request']['mobile_number'] : "NA"}}
											</td>
										</tr>
										<tr>
											<th>User Comment:</th>
											<td class="" width="50%">
												{{$arr_product['replacement_request']['comment'] or "NA"}}
											</td>
										</tr>
										
										<tr>
											<th>Reason:</th>
											<td class="text-right">
												{{$arr_product['replacement_request']['reason'] or "NA"}}
											</td>
										</tr>

										<tr>
											<th>Status:</th>
											<td class="text-right">
												@if(isset($arr_product['replacement_request']['status']))
												@if($arr_product['replacement_request']['status'] == '1')
												Request Pending
												@elseif($arr_product['replacement_request']['status'] == '2')
												Request Accepted
												@elseif($arr_product['replacement_request']['status'] == '3')
												Request Rejected
												@elseif($arr_product['replacement_request']['status'] == '4')
												Completed
												@elseif($arr_product['replacement_request']['status'] == '5')
												Product Rejected
												@endif
												@endif
											</td>
										</tr>
										
										@if(isset($arr_product['replacement_request']['status']))
											@if($arr_product['replacement_request']['status'] == '1')
											<tr>
												<th>Do you want to accept product replacement request?</th>
												<td class="text-right">
													<label class="radio-inline">
														<input type="radio" value="yes" name="product_replacement_request" class="product_replacement_request">
														Yes
													</label>

													<label class="radio-inline">
														<input type="radio" value="no" name="product_replacement_request" class="product_replacement_request">
														No
													</label>
												</td>
											</tr>
											@elseif($arr_product['replacement_request']['status'] == '2')
											<tr>
												<th>Did you get product from customer?</th>
												<td class="text-right">
													<input type="checkbox" name="product_request" class="product_request">
												</td>
											</tr>

											<tr id="product_acceptance_rejection_block" style="display: none">
												<th>Do you accept product?</th>
												<td class="text-right">
													<label class="radio-inline">
														<input type="radio" value="yes" name="product_approval" class="product_approval">
														Yes
													</label>

													<label class="radio-inline">
														<input type="radio" value="no" name="product_approval" class="product_approval">
														No
													</label>
												</td>
											</tr>

											{{csrf_field()}}
											<tr class="wallet_amt_block" style="display: none;">
												<th>Return Amount(In Rs):</th>
												<td>
													<input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Return Amount"  @if(isset($arr_product['product_final_price']) && !empty($arr_product['product_final_price'])) data-rule-max="{{$arr_product['product_final_price']}}" data-msg-max="Amount shouldn't be more than product's final amount." @endif  data-rule-pattern="\d+(\.\d{1,2})?" data-msg-pattern="Please enter valid price." value="{{old('amount')}}">
													<span class="error">{{$errors->first('receipt')}}</span>
												</td>
											</tr>
											<tr class="wallet_amt_block" style="display: none;">
												<td>
													<div class="form-group text-right">
														<input type="hidden" name="order_id" id="order_id" value="{{isset($arr_product['order_id'])?$arr_product['order_id']:""}}">
														<input type="hidden" name="product_id" id="product_id" value="{{isset($arr_product['product_id'])?$arr_product['product_id']:""}}">
														<input type="hidden" name="user_id" id="user_id" value="{{isset($arr_product['user_id'])?$arr_product['user_id']:""}}">
														<input type="hidden" name="replacement_product_request_id" id="replacement_product_request_id" value="{{isset($replacement_product_request_id)?$replacement_product_request_id:""}}">
														<button type="submit" id="btn_return_amt" name="btn_return_amt" class="btn btn-primary">Add Amount to Wallet</button>
													</div>
												</td>
											</tr>
											@endif
										@endif

									</tbody>
								</table>
							</div>
						</div>
					</form>
					
				</div>
				
			</div>
			<div class="row">
				<div class="col-md-12" style="text-align: right;">
					<p>
						<br>
						<a class="btn btn-default" href="javascript:history.back(1)">Back</a>
					</p>

				</div>
			</div>

		</div>

		

	</div>
	<script>
		$(document).ready(function(){

			$('#frm_replacement_amt').validate({
				ignore: [],
				errorPlacement: function(error, element) 
				{ 
					error.insertAfter(element);

				} 
			});

			$('.product_replacement_request').change(function(){

				replacement_product_request_id = "{{isset($arr_product['replacement_request']['id']) ? base64_encode($arr_product['replacement_request']['id']) : 0}}";
				
				

				if($(this).val() == 'yes')
				{
					swal_title = 'Are you sure?';
					swal_text = 'Do your really want to accept product replacement request?';
					url = '{{$module_url_path}}/accept_request/'+replacement_product_request_id;
				}
				else if($(this).val() == 'no')
				{
					swal_title = 'Are you sure ?';
					swal_text = 'Do your really want to reject product replacement request?';
					url = '{{$module_url_path}}/reject_request/'+replacement_product_request_id;
				}
				else
				{
					swal('','Something went to wrong! Please try again later.','error');
					return false;
				}

				swal({
                            title: swal_title,
                            text: swal_text,
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Proceed",
                            cancelButtonText: "No",
                            closeOnConfirm: false,
                            closeOnCancel: true
                        },
                        function(isConfirm)
                        {
                            if(isConfirm==true)
                            {
                            	window.location = url;
                            }
                        });
			});

			$('.product_request').change(function(){
				if($(this).is(':checked') == true)
				{
					$('#product_acceptance_rejection_block').show();
				}
				else
				{
					$('#product_acceptance_rejection_block').hide();
				}
			});

			$(document).on('click','.cancel',function(){
				$('.product_replacement_request').attr('checked',false);
			});

			$('.product_approval').change(function(){

				replacement_product_request_id = "{{isset($arr_product['replacement_request']['id']) ? base64_encode($arr_product['replacement_request']['id']) : 0}}";

				if($(this).val() == 'yes')
				{
					$('#amount').data('rule-required',true);
					$('.wallet_amt_block').show();
					$('#payment_sent_block').show();
				}
				else
				{
					swal({
                            title: 'Are you sure?',
                            text: 'Do you really want to reject product?',
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Proceed",
                            cancelButtonText: "No",
                            closeOnConfirm: false,
                            closeOnCancel: true
                        },
                        function(isConfirm)
                        {
                            if(isConfirm==true)
                            {
                            	window.location = '{{$module_url_path}}/reject_product/'+replacement_product_request_id;
                            }
                        });
				}	
			});

			/*$('.payment_confirmation').change(function(){
				if($(this).is(':checked') == true)
				{
					$('#validate-document').data('rule-required',true);
					$('.send_receipt_block').show();
				}
				else
				{
					$('#validate-document').data('rule-required',false);
					$('.send_receipt_block').hide();
				}
			});*/

			 /*$(document).on("change",".validate-document", function()
		     {
		     	$(this).valid();        
		        var file=this.files;
		        validatePaymentReceipt(this.files);
		     });*/
		});

	</script>

	@endsection


