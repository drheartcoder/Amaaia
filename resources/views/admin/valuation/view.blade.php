
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

		<div class="panel-body">
			<div class="row invoice-payment">
				<div class="col-sm-6">
					<div class="content-group">
						<h6>Valuation Details</h6>
						<div class="table-responsive no-border">
							<table class="table">
								<tbody>
									<tr>
										<th>User Name:</th>
										<td class="text-right">
											{{$arr_valuation['user_details']['first_name'] or ""}}
											{{$arr_valuation['user_details']['last_name'] or ""}}
										</td>
									</tr>
									<tr>
										<th>Appointment Date:</th>
										<td class="text-right">
											{{isset($arr_valuation['appointment_date'])? date('d M,Y',strtotime($arr_valuation['appointment_date'])) :""}}
										</td>
									</tr>
									<tr>
										<th>Appointment Time:</th>
										<td class="text-right">
											{{isset($arr_valuation['appointment_time'])? date('h:i a',strtotime($arr_valuation['appointment_time'])) :""}}
										</td>
									</tr>
									<tr>
										<th>Contact Number:</th>
										<td class="text-right">
											{{$arr_valuation['mobile_number']}}
										</td>
									</tr>
									<tr>
										<th>Product Description:</th>
										<td>
											{{$arr_valuation['product_description'] or ""}}
										</td>
									</tr>

									

									@if(isset($arr_valuation['product_image']) && !empty($arr_valuation['product_image']) && file_exists($valuation_img_base_path.$arr_valuation['product_image']))
										<tr>
											<th>Product Image:</th>
											<td class="text-right">
												<div class="thumbnail">
													<div class="thumb" >
														
														<img src="{{ get_resized_image($arr_valuation['product_image'], $valuation_img_base_path, 500, 500 )}}" alt="" id="product_image" style="height:10% !important">
														<div class="caption-overflow">
															<span>
																<a href="{{$valuation_img_public_path.$arr_valuation['product_image']}}" target="_blank" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5"><i class="icon-link2"></i></a>
															</span>
														</div>
													</div>
												</div>
											</td>
										</tr>
									@endif
								</tbody>
							</table>
						</div>
					</div>
					
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

			$('.product_return_request').change(function(){

				return_product_request_id = "{{isset($arr_valuation['return_request']['id']) ? base64_encode($arr_valuation['return_request']['id']) : 0}}";
				
				

				if($(this).val() == 'yes')
				{
					swal_title = 'Are you sure?';
					swal_text = 'Do your really want to accept product return request?';
					url = '{{$module_url_path}}/accept_request/'+return_product_request_id;
				}
				else if($(this).val() == 'no')
				{
					swal_title = 'Are you sure ?';
					swal_text = 'Do your really want to reject product return request?';
					url = '{{$module_url_path}}/reject_request/'+return_product_request_id;
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
				$('.product_return_request').attr('checked',false);
			});

			$('.product_approval').change(function(){

				return_product_request_id = "{{isset($arr_valuation['return_request']['id']) ? base64_encode($arr_valuation['return_request']['id']) : 0}}";

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


