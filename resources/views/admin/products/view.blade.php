
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
						<h6>General Information</h6>
						<div class="table-responsive no-border">
							<table class="table">
								<tbody>
									@if(isset($arr_product['product_type']))
									<tr>
										<th>Product Type:</th>
										<td class="text-right">									{{isset($arr_product['product_type']) && $arr_product['product_type'] == '1' ? 'Classic' : ''}}
											{{isset($arr_product['product_type']) && $arr_product['product_type'] == '2' ? 'Luxury' : ''}}
										</td>
									</tr>
									@endif

									@if(isset($arr_product['brand']['brand_name']))
									<tr>
										<th>Brand:</th>
										<td class="text-right">{{$arr_product['brand']['brand_name'] or ''}}</td>
									</tr>
									@endif

									@if(isset($arr_product['category']['category_name']))
									<tr>
										<th>Category:</th>
										<td class="text-right">{{$arr_product['category']['category_name'] or ''}}</td>
									</tr>
									@endif

									@if(isset($arr_product['sub_category']['subcategory_name']))
									<tr>
										<th>Sub Category:</th>
										<td class="text-right">{{$arr_product['sub_category']['subcategory_name'] or 'NA'}}</td>
									</tr>
									@endif

									@if(isset($arr_product['product_code']))
									<tr>
										<th>Product Code/Model:</th>
										<td class="text-right">{{$arr_product['product_code'] or 'NA'}}</td>
									</tr>
									@endif

									<tr>
										<th>Quantity:</th>
										<td class="text-right">{{$arr_product['quantity'] or 'NA'}}</td>
									</tr>

									@if(isset($arr_product['product_price']))
									<tr>
										<th>Price:</th>
										<td class="text-right"><i class="fa fa-inr"></i>  {{$arr_product['product_price'] or 'NA'}}</td>
									</tr>
									@endif

									<tr>
										<th>Discount:</th>
										<td class="text-right">  {{isset($arr_product['discount']) ? $arr_product['discount'].'%' : '-'}}</td>
									</tr>

									
									<tr>
										<th>Discount Price:</th>
										<td class="text-right">@if(isset($arr_product['discount_price']) && !empty($arr_product['discount_price']))<i class="fa fa-inr"></i>  <strike>{{$arr_product['discount_price'] or 'NA'}}</strike>@else - @endif</td>
									</tr>
									
									
									<tr>
										<th>Additional Markup:</th>
										<td class="text-right">  {{isset($arr_product['additional_markup']) && !empty($arr_product['additional_markup']) ? $arr_product['additional_markup'].'%' : '-'}}</td>
									</tr>

								</tbody>
							</table>
						</div>

					</div>
					<div class="col-sm-12">
						<div class="content-group">
							<h6>Product Images</h6>
							<hr>
							@if(isset($arr_product['product_images']) && !empty($arr_product['product_images']) && is_array($arr_product['product_images']))
							@foreach($arr_product['product_images'] as $img)
							@if(isset($img['image']) && file_exists($product_image_base_path.$img['image']))
							<div class="col-lg-3 col-sm-6">
								<div class="thumbnail">
									<div class="thumb">
										<img src="{{$product_image_public_path.$img['image']}}" alt="" id="product_image">
										<div class="caption-overflow">
											<span>
												<a href="{{$product_image_public_path.$img['image']}}" target="_blank" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5"><i class="icon-link2"></i></a>
											</span>
										</div>
									</div>
								</div>
							</div>
							@endif
							@endforeach
							@endif
						{{-- </div> --}}
					</div>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="content-group">
					<h6>Specifications</h6>
					<div class="table-responsive no-border">
						<table class="table">
							<tbody>

								@if(isset($arr_product['product_line']['product_line_name']))
								<tr>
									<th>Product Line:</th>
									<td class="text-right">{{$arr_product['product_line']['product_line_name'] or 'NA'}}</td>
								</tr>													
								@endif

								@if(isset($arr_product['product_metals']) && !empty($arr_product['product_metals']) && is_array($arr_product['product_metals']))
								<tr>
									<th>Metals:</th>
									<td class="text-right">
										@foreach($arr_product['product_metals'] as $metal)
										<ul class="media-list">
											<li> {{$metal['metal_name']['metal_name'] or ''}}-{{$metal['metal_color']['metal_color'] or ''}}-{{$metal['metal_quality']['quality_name'] or ''}}
											</li>
										</ul>
										@endforeach
									</td>
								</tr>
								@endif

								@if(isset($arr_product['look']['look']))
								<tr>
									<th>Look:</th>
									<td class="text-right">{{$arr_product['look']['look'] or 'NA'}}</td>
								</tr>													
								@endif

								@if(isset($arr_product['product_gemstones']) && !empty($arr_product['product_gemstones']) && is_array($arr_product['product_gemstones']))
								<tr>
									<th>Gemstones:</th>
									<td class="text-right">
										@foreach($arr_product['product_gemstones'] as $gemstone)
										<ul class="media-list">
											<li> {{$gemstone['gemstone_type']['type'] or ''}}-{{$gemstone['gemstone_color']['gemstone_color'] or ''}}-{{$gemstone['gemstone_quality']['gemstone_quality'] or ''}}-{{$gemstone['gemstone_shape']['shape_name'] or ''}} </li>
										</ul>
										@endforeach
									</td>
								</tr>
								@endif

								@if(isset($arr_product['metal_detailing']['metal_detailing_name']))
								<tr>
									<th>Metal Detailing:</th>
									<td class="text-right">{{$arr_product['metal_detailing']['metal_detailing_name'] or 'NA'}}</td>
								</tr>													
								@endif

								@if(isset($arr_product['metal_weight']))
								<tr>
									<th>Metal Weight:</th>
									<td class="text-right">{{$arr_product['metal_weight'] or 'NA'}} gm</td>
								</tr>													
								@endif

								@if(isset($arr_product['product_height']))
								<tr>
									<th>Height:</th>
									<td class="text-right">{{$arr_product['product_height'] or 'NA'}} mm</td>
								</tr>
								@endif

								@if(isset($arr_product['product_width']))
								<tr>
									<th>Width:</th>
									<td class="text-right">{{$arr_product['product_width'] or 'NA'}} mm</td>
								</tr>
								@endif

								@if(isset($arr_product['product_length']))
								<tr>
									<th>Length:</th>
									<td class="text-right">{{$arr_product['product_length'] or 'NA'}} mm</td>
								</tr>
								@endif

								@if(isset($arr_product['product_size']))
								<tr>
									<th>Sizes(In MM)</th>
									<td class="text-right">
										@foreach($arr_product['product_size'] as $size)
										@php  $sizes[] = $size['size_name']; @endphp 
										@endforeach
										@if(isset($sizes) && !empty($sizes))
										{{implode(",",$sizes)}}
										@endif
									</td>
								</tr>
								@endif

								@if(isset($arr_product['shank_type']['shank_type']))
								<tr>
									<th>Shank Type:</th>
									<td class="text-right">{{$arr_product['shank_type']['shank_type'] or 'NA'}} mm</td>
								</tr>
								@endif

								@if(isset($arr_product['setting']['setting']))
								<tr>

									<th>Setting:</th>
									<td class="text-right">{{$arr_product['setting']['setting'] or 'NA'}}</td>
								</tr>
								@endif


								<tr>
									@if(isset($arr_product['product_collections']) && !empty($arr_product['product_collections']) && is_array($arr_product['product_collections']))
									<th>Collections:</th>
									<td class="text-right">
										@foreach($arr_product['product_collections'] as $collection)
										<ul class="media-list">
											<li> {{$collection['collection']['name'] or 'NA'}} </li>
										</ul>
										@endforeach
									</tr>
								@endif</td>
								<tr>
									@if(isset($arr_product['product_occasions']) && !empty($arr_product['product_occasions']) && is_array($arr_product['product_occasions']))
									<th>Occation:</th>
									<td class="text-right">
										@foreach($arr_product['product_occasions'] as $occasion)
										<ul class="media-list">
											<li> {{$occasion['occasion']['occasion_name'] or 'NA'}} </li>
										</ul>
										@endforeach
									</td>
									@endif
								</tr>

								@if(isset($arr_product['setting']['setting']))
								<tr>

									<th>Allow Product For Home Trial?</th>
									<td class="text-right">
										{{isset($arr_product['allow_product_home_trial']) && $arr_product['allow_product_home_trial'] == '1' ? 'No' : ''}}
										{{isset($arr_product['allow_product_home_trial']) && $arr_product['allow_product_home_trial'] == '2' ? 'Yes' : ''}}
									</td>
								</tr>
								@endif



							</tbody>
						</table>

					</div>


				</div>


			</div>
		</div>

		@if(isset($arr_product['product_description']))
		<h6>Description</h6>
		<p class="text-muted">{{$arr_product['product_description'] or 'NA'}}</p>
		@endif
		@if(isset($arr_product['product_specification']))
		<h6>Specification</h6>
		<p class="text-muted">{{$arr_product['product_specification'] or 'NA'}}</p>
		@endif
		@if(isset($arr_product['delivery_date']) && !empty($arr_product['delivery_date']))
		<h6>Delivery Date</h6>
		<p class="text-muted">{{$arr_product['delivery_date'] }} days</p>
		@endif
		@if(isset($arr_product['video_url']))
		<h6>Video Link</h6>
		<p class="text-muted"><a href="{{$arr_product['video_url'] or 'javascript:void(0)'}}" target="_blank" >View</a></p>
		@endif

		<form method="POST" action="{{url('/').'/'.$admin_panel_slug}}/products/add_discount" class="form-horizontal" id="frm_add_discount" name="frm_add_discount">
			{{ csrf_field() }}
			<input type="hidden" name="product_id" value="{{isset($id) ? base64_encode($id) : 0}}">

			<legend class="text-bold">Product Discount and Additional Markup :</legend>

			<fieldset class="content-group">	
				
				<div class="form-group">
					<label class="control-label col-lg-2" for="discount">Discount (In %)</label>
					<div class="col-lg-4">
						<input type="text" name="discount" id="discount" class="form-control" placeholder="Discount" data-rule-maxlength="5" data-rule-max="99" data-rule-pattern="\d+(\.\d{1,2})?" data-msg-pattern="Please enter valid discount." data-msg-maxlength="Please enter no more than 5 digits." value="{{$arr_product['discount'] or ''}}">
						<span class="error">{{ $errors->first('discount') }} </span>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-lg-2" for="additional_markup">Additional Markup (In %)</label>
					<div class="col-lg-4">
						<input type="text" name="additional_markup" id="additional_markup" class="form-control" placeholder="Additional Markup" data-rule-maxlength="5" data-rule-max="99" data-rule-pattern="\d+(\.\d{1,2})?" data-msg-pattern="Please enter valid discount." data-msg-maxlength="Please enter no more than 5 digits." value="{{$arr_product['additional_markup'] or ''}}">
						<span class="error">{{ $errors->first('additional_markup') }} </span>
					</div>
				</div>
				<div class="form-group text-center">
					<div class="col-lg-7">
						<button type="submit" name="btn_add_discount" id="btn_add_discount" class="btn btn-primary">Save</button>
					</div>
				</div>
			</fieldset>
			<legend class="text-bold"></legend>
		</form>



		<div class="text-right">

			@if($arr_product['admin_approval']=='0')
			<a href="{{$module_url_path.'/supplier/approve/'.base64_encode($id)}}" onclick='return confirm_action(this,event,"Do you really want to approve product ?")' class="btn btn-primary btn-labeled"><b><i class="glyphicon glyphicon-ok"></i></b> Approve Product</a>
			<a href="{{$module_url_path.'/supplier/reject/'.base64_encode($id)}}" onclick='return confirm_action(this,event,"Do you really want to reject product ?")' class="btn btn-danger btn-labeled"><b><i class="glyphicon 
				glyphicon-remove"></i></b> Reject Product</a>
				@endif



				@if($arr_product['admin_approval']=='2')
				<a href="{{$module_url_path.'/supplier/approve/'.base64_encode($id)}}" onclick='return confirm_action(this,event,"Do you really want to approve product ?")' class="btn btn-primary btn-labeled"><b><i class="glyphicon glyphicon-ok"></i></b> Approve Product</a>

				@endif

				<a href="{{url('/admin/products/supplier')}}" class="btn btn-primary">Back</a>

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


