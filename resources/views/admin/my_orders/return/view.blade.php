
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
										<td class="text-right">{{isset($arr_product['name_on_product'])?$arr_product['name_on_product']:""}}</td>
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
									<tr>
										<th>Product Price <i class="fa fa-inr"></i>:</th>
										<td class="text-right">{{isset($arr_product['product_price'])?$arr_product['product_price']:""}}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="row invoice-payment">
				<div class="col-sm-6">
					<form class="form-horizontal" id="frm_return_amt" name="frm_return_amt" action="{{url($module_url_path.'/return_amount')}}" method="post" enctype="multipart/form-data">
						<div class="content-group">
							<h6>Product return request Details</h6>
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
												{{$arr_product['return_request']['customer_details']['first_name'] or ""}}
												{{$arr_product['return_request']['customer_details']['last_name'] or ""}}
											</td>
										</tr>
										
										<tr>
											<th>Delivery Method:</th>
											<td class="text-right">
												{{$arr_product['return_request']['delivery_method'] or "NA"}}
											</td>
										</tr>

										<tr>
											<th>Product Price <i class="fa fa-inr"></i>:</th>
											<td class="text-right">{{isset($arr_product['product_price'])?$arr_product['product_price']:""}}</td>
										</tr>

										<tr>
											<th>Refund Payment Method:</th>
											<td class="text-right">
												<input type="hidden" name="refund_payment_method" id="refund_payment_method" value="{{$arr_product['return_request']['refund_payment_method'] or ""}}">
												{{isset($arr_product['return_request']['refund_payment_method']) && $arr_product['return_request']['refund_payment_method'] == '1' ? 'Add In Amaaia Wallet' : '' }}
												{{isset($arr_product['return_request']['refund_payment_method']) && $arr_product['return_request']['refund_payment_method'] == '2' ? 'Add in Bank Account' : '' }}
											</td>
										</tr>
										@if(isset($arr_product['return_request']['wallet_details']['amount_credited']) && !empty($arr_product['return_request']['wallet_details']['amount_credited']))
											<tr>
												<th>Transfered amount to wallet <i class="fa fa-inr"></i>:</th>
												<td class="text-right">
													
													{{$arr_product['return_request']['wallet_details']['amount_credited'] or ''}}
												</td>
											</tr>
										@endif
										
										<tr>
											<th>Mobile No:</th>
											<td class="text-right">
												{{isset($arr_product['return_request']['mobile_number']) ? $arr_product['return_request']['mobile_number'] : "NA"}}
											</td>
										</tr>
										<tr>
											<th>User Comment:</th>
											<td class="" width="50%">
												{{$arr_product['return_request']['comment'] or "NA"}}
											</td>
										</tr>
										
										<tr>
											<th>Reason:</th>
											<td class="text-right">
												{{$arr_product['return_request']['reason'] or "NA"}}
											</td>
										</tr>

										<tr>
											<th>Status:</th>
											<td class="text-right">
												@if(isset($arr_product['return_request']['status']))
												@if($arr_product['return_request']['status'] == '1')
												Request Pending
												@elseif($arr_product['return_request']['status'] == '2')
												Request Accepted
												@elseif($arr_product['return_request']['status'] == '3')
												Request Rejected
												@elseif($arr_product['return_request']['status'] == '4')
												Completed
												@elseif($arr_product['return_request']['status'] == '5')
												Product Rejected
												@endif
												@endif
											</td>
										</tr>

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

			$('#frm_return_amt').validate({
				ignore: [],
				errorPlacement: function(error, element) 
				{ 
					var name = $(element).attr("receipt");
					if (name === "site_status") 
					{
						error.insertAfter('.error_receipt');
					} 
					else
					{
						error.insertAfter(element);
					}

				} 
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
				$('.product_return_request').attr('checked',false);
			});

			$('.product_approval').change(function(){

				return_product_request_id = "{{isset($arr_product['return_request']['id']) ? base64_encode($arr_product['return_request']['id']) : 0}}";

				if($(this).val() == 'yes')
				{
					if($('#refund_payment_method').val() == '1')
					{
						$('#amount').data('rule-required',true);
						$('.wallet_amt_block').show();
						$('#payment_sent_block').show();
					}
					else if($('#refund_payment_method').val() == '2')
					{
						$('#amount').data('rule-required',false);  
						$('#payment_sent_block').show();
					}
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
                            	window.location = '{{$module_url_path}}/reject_product/'+return_product_request_id;
                            }
                        });
				}	
			});

			$('.payment_confirmation').change(function(){
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
			});

			 $(document).on("change",".validate-document", function()
		     {
		     	$(this).valid();        
		        var file=this.files;
		        validatePaymentReceipt(this.files);
		     });



		});

	</script>

	@endsection


