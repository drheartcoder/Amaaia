
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
											{{isset($arr_product['order_id']) && !empty($arr_product['order_id']) ?$arr_product['order_id']:"NA"}}
										</td>
									</tr>
									<tr>
										<th>Product Name:</th>
										<td class="text-right">
											{{isset($arr_product['product_name']) && !empty($arr_product['product_name']) ?$arr_product['product_name']:"NA"}}
										</td>
									</tr>
									<tr>
										<th>Product Category:</th>
										<td class="text-right">
											{{isset($arr_product['product_category_name']) && !empty($arr_product['product_category_name']) ?$arr_product['product_category_name']:"NA"}}
										</td>
									</tr>
									<tr>
										<th>Product Sub Category:</th>
										<td class="text-right">
											{{isset($arr_product['product_subcategory_name']) && !empty($arr_product['product_subcategory_name']) ?$arr_product['product_subcategory_name']:"NA"}}
										</td>
									</tr>
									<tr>
										<th>Product line Name:</th>
										<td class="text-right">
											{{isset($arr_product['product_line_name']) && !empty($arr_product['product_line_name']) ?$arr_product['product_line_name']:"NA"}}
										</td>
									</tr>
									<tr>
										<th>Product Setting Name:</th>
										<td class="text-right">
											{{isset($arr_product['product_setting_name']) && !empty($arr_product['product_setting_name']) ?$arr_product['product_setting_name']:"NA"}}
										</td>
									</tr>
									<tr>
										<th>Product Ring Shoulder Name:</th>
										<td class="text-right">
											{{isset($arr_product['product_ring_shoulder_name']) && !empty($arr_product['product_ring_shoulder_name']) ?$arr_product['product_ring_shoulder_name']:"NA"}}
										</td>
									</tr>
									<tr>
										<th>Product Metal Detailing Name:</th>
										<td class="text-right">
											{{isset($arr_product['product_metal_detailing_name']) && !empty($arr_product['product_metal_detailing_name']) ?$arr_product['product_metal_detailing_name']:"NA"}}
										</td>
									</tr>
									<tr>
										<th>Product Band Setting Name:</th>
										<td class="text-right">
											{{isset($arr_product['product_band_setting_name']) && !empty($arr_product['product_band_setting_name']) ?$arr_product['product_band_setting_name']:"NA"}}
										</td>
									</tr>	
									<tr>
										<th>Product look Name:</th>
										<td class="text-right">
											{{isset($arr_product['product_look_name']) && !empty($arr_product['product_look_name']) ?$arr_product['product_look_name']:"NA"}}
										</td>
									</tr>	
									<tr>
										<th>Product Shank Type Name:</th>
										<td class="text-right">
											{{isset($arr_product['product_shank_type_name']) && !empty($arr_product['product_shank_type_name']) ?$arr_product['product_shank_type_name']:"NA"}}
										</td>
									</tr>
									<tr>
										<th>Product Discount:</th>
										<td class="text-right">{{isset($arr_product['product_discount']) && !empty($arr_product['product_discount']) ?$arr_product['product_discount'].'%':"NA"}}</td>
									</tr>
									<tr>
										<th>Product Additional Markup:</th>
										<td class="text-right">{{isset($arr_product['product_additional_markup']) && !empty($arr_product['product_additional_markup']) ?$arr_product['product_additional_markup'].'%':"NA"}}</td>
									</tr>
									<tr>
										<th>Product Supplier Markup:</th>
										<td class="text-right">{{isset($arr_product['product_supplier_markup']) && !empty($arr_product['product_supplier_markup']) ?$arr_product['product_supplier_markup'].'%':"NA"}}</td>
									</tr>
									<tr>
										<th>Market Orientation Markup:</th>
										<td class="text-right">{{isset($arr_product['product_market_orientation']) && !empty($arr_product['product_market_orientation']) ?$arr_product['product_market_orientation'].'%':"NA"}}</td>
									</tr>
									<tr>
										<th>Product Transaction Charges:</th>
										<td class="text-right">{{isset($arr_product['product_transaction_charges']) && !empty($arr_product['product_transaction_charges']) ?$arr_product['product_transaction_charges'].'%':"NA"}}</td>
									</tr>
									<tr>
										<th>Product Gst:</th>
										<td class="text-right">{{isset($arr_product['product_gst']) && !empty($arr_product['product_gst']) ?$arr_product['product_gst'].'%':"NA"}}</td>
									</tr>	
									<tr>
										<th>Product Insurance:</th>
										<td class="text-right">{{isset($arr_product['product_insurance']) && !empty($arr_product['product_insurance']) ?$arr_product['product_insurance'].'%':"NA"}}</td>
									</tr>	
									<tr>
										<th>Product Discount  (<i class="fa fa-inr"></i>):</th>
										<td class="text-right">{{isset($arr_product['discount_on_product']) && !empty($arr_product['discount_on_product']) ?$arr_product['discount_on_product']:"NA"}}</td>
									</tr>		
									<tr>
										<th>Additional Markup On Product (<i class="fa fa-inr"></i>):</th>
										<td class="text-right">{{isset($arr_product['additional_markup_on_product']) && !empty($arr_product['additional_markup_on_product']) ?$arr_product['additional_markup_on_product']:"NA"}}</td>
									</tr>
									<tr>
										<th>Supplier Markup On Product (<i class="fa fa-inr"></i>):</th>
										<td class="text-right">{{isset($arr_product['supplier_markup_on_product']) && !empty($arr_product['supplier_markup_on_product']) ?$arr_product['supplier_markup_on_product']:"NA"}}</td>
									</tr>
									<tr>
										<th>Transaction Charges On Product (<i class="fa fa-inr"></i>):</th>
										<td class="text-right">{{isset($arr_product['transaction_charges_on_product']) && !empty($arr_product['transaction_charges_on_product']) ?$arr_product['transaction_charges_on_product']:"NA"}}</td>
									</tr>		
									<tr>
										<th>Market Orientation On Product (<i class="fa fa-inr"></i>):</th>
										<td class="text-right">{{isset($arr_product['market_orientation_on_product']) && !empty($arr_product['market_orientation_on_product']) ?$arr_product['market_orientation_on_product']:"NA"}}</td>
									</tr>	

									<tr>
										<th>Gst On Product (<i class="fa fa-inr"></i>):</th>
										<td class="text-right">{{isset($arr_product['gst_on_product']) && !empty($arr_product['gst_on_product']) ?$arr_product['gst_on_product']:"NA"}}</td>
									</tr>	
									<tr>
										<th>Insurance On Product (<i class="fa fa-inr"></i>):</th>
										<td class="text-right">{{isset($arr_product['insurance_on_product']) && !empty($arr_product['insurance_on_product']) ?$arr_product['insurance_on_product']:"NA"}}</td>
									</tr>
									<tr>
										<th>Product Price  (<i class="fa fa-inr"></i>):</th>
										<td class="text-right">{{isset($arr_product['product_price']) && !empty($arr_product['product_price']) ?$arr_product['product_price']:"NA"}}</td>
									</tr>
									<tr>
										<th>Product Final Price  (<i class="fa fa-inr"></i>):</th>
										<td class="text-right">{{isset($arr_product['product_final_price']) && !empty($arr_product['product_final_price']) ?$arr_product['product_final_price']:"NA"}}</td>
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
									<td class="text-right">{{isset($arr_product['product_metal_weight']) && !empty($arr_product['product_metal_weight']) ?$arr_product['product_metal_weight']:"NA"}} gm</td>
								</tr>													
								<tr>
									<th>Product Height:</th>
									<td class="text-right">{{isset($arr_product['product_height']) && !empty($arr_product['product_height']) ?$arr_product['product_height']:"NA"}} mm</td>
								</tr>	
								<tr>
									<th>Product Width:</th>
									<td class="text-right">{{isset($arr_product['product_width']) && !empty($arr_product['product_width']) ?$arr_product['product_width']:"NA"}} mm</td>
								</tr>
								<tr>
									<th>Product Length:</th>
									<td class="text-right">{{isset($arr_product['product_length']) && !empty($arr_product['product_length']) ?$arr_product['product_length']:"NA"}} mm</td>
								</tr>
								<tr>
									<th>Product Quantity:</th>
									<td class="text-right">{{isset($arr_product['product_quantity']) && !empty($arr_product['product_quantity']) ?$arr_product['product_quantity']:"NA"}}</td>
								</tr>
								<tr>
									<th>Product Code:</th>
									<td class="text-right">{{isset($arr_product['product_code']) && !empty($arr_product['product_code']) ?$arr_product['product_code']:"NA"}}</td>
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
									<td class="text-right">{{isset($arr_product['product_delivery_date']) && !empty($arr_product['product_delivery_date']) ?$arr_product['product_delivery_date']:"NA"}}</td>
								</tr>	
								<tr>
									<th>Name On Product:</th>
									<td class="text-right">{{isset($arr_product['name_on_product']) && !empty($arr_product['name_on_product']) ?$arr_product['name_on_product']:"NA"}}</td>
								</tr>	
								<tr>
									<th>Product Insurance Company:</th>
									<td class="text-right">{{isset($arr_product['product_insurance_company']) && !empty($arr_product['product_insurance_company']) ?$arr_product['product_insurance_company']:"NA"}}</td>
								</tr>	
								<tr>
									<th>Product Metal Type:</th>
									<td class="text-right">{{isset($arr_product['product_metal_type']) && !empty($arr_product['product_metal_type']) ?$arr_product['product_metal_type']:"NA"}}</td>
								</tr>	
								<tr>
									<th>Product Metal Color:</th>
									<td class="text-right">{{isset($arr_product['product_metal_color']) && !empty($arr_product['product_metal_color']) ?$arr_product['product_metal_color']:"NA"}}</td>
								</tr>
								<tr>
									<th>Product Metal Quality:</th>
									<td class="text-right">{{isset($arr_product['product_metal_quality']) && !empty($arr_product['product_metal_quality']) ?$arr_product['product_metal_quality']:"NA"}}</td>
								</tr>
								<tr>
									<th>Product Gemstone Type:</th>
									<td class="text-right">{{isset($arr_product['product_gemstone_type']) && !empty($arr_product['product_gemstone_type']) ?$arr_product['product_gemstone_type']:"NA"}}</td>
								</tr>
								<tr>
									<th>Product Gemstone Color:</th>
									<td class="text-right">{{isset($arr_product['product_gemstone_color']) && !empty($arr_product['product_gemstone_color']) ?$arr_product['product_gemstone_color']:"NA"}}</td>
								</tr>
								<tr>
									<th>Product Gemstone Quality:</th>
									<td class="text-right">{{isset($arr_product['product_gemstone_quality']) && !empty($arr_product['product_gemstone_quality']) ?$arr_product['product_gemstone_quality']:"NA"}}</td>
								</tr>
								<tr>
									<th>Product Gemstone Shape:</th>
									<td class="text-right">{{isset($arr_product['product_gemstone_shape']) && !empty($arr_product['product_gemstone_shape']) ?$arr_product['product_gemstone_shape']:"NA"}}</td>
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
											{{isset($arr_product['supplier_details']['first_name'])?$arr_product['supplier_details']['first_name'].' '.$arr_product['supplier_details']['last_name']:"NA"}}
										</td>
									</tr>
									<tr>
										<th>Address:</th>
										<td class="text-right">
											{{isset($arr_product['supplier_details']['address']) && !empty($arr_product['supplier_details']['address']) ?$arr_product['supplier_details']['address']:"NA"}}
										</td>
									</tr>
									<tr>
										<th>Mobile Number:</th>
										<td class="text-right">
											{{isset($arr_product['supplier_details']['mobile_number']) && !empty($arr_product['supplier_details']['mobile_number']) ?$arr_product['supplier_details']['mobile_number']:"NA"}}
										</td>
									</tr>
									<tr>
										<th>Email:</th>
										<td class="text-right">
											{{isset($arr_product['supplier_details']['email']) && !empty($arr_product['supplier_details']['email']) ?$arr_product['supplier_details']['email']:"NA"}}
										</td>
									</tr>
								</tbody>
							</table>
				</div>					
		</div>
		</div>
		 <div class="row">
                <div class="col-md-12" style="text-align: right;">
                    <p>
                        <br>
                        <a class="btn btn-default" href="{{$module_url or 'javascript:void(0)'}}">Back</a>
                    </p>

                </div>
        </div>

		</div>

		

	</div>
	<script>
	    $(document).ready(function(){
	    	$('#frm_add_discount').validate({
	    		ignore: [],
	    		highlight: function(element) { },
	               errorPlacement: function(error, element) 
	               { 
	                    error.insertAfter(element);
	               } 
	    	});
	    });

	</script>

	@endsection


