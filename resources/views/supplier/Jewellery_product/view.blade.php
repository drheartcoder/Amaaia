
@extends('supplier.layout.master')    
@section('main_content')
<!-- Page header -->
@include('supplier.layout.breadcrumb')  
<!-- /page header -->

<!-- BEGIN Main Content -->

<!-- Content area -->
<div class="content">

	<div class="panel panel-flat">
		@include('supplier.layout._operation_status')
		{{-- <div class="panel-heading">
			<h5 class="panel-title">{{$sub_module_title or ''}}</h5>
		</div> --}}
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
									
									@if(isset($arr_product['product_name']))
									<tr>
										<th>Product Name:</th>
										<td class="text-right">{{$arr_product['product_name']}}</td>
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

									{{-- <tr>
										<th>Discount(In %):</th>
										<td class="text-right">  {{isset($arr_product['discount']) ? $arr_product['discount'].'%' : '-'}}</td>
									</tr>

									<tr>
										<th>Market Orientation Markup(In %):</th>
										<td class="text-right">  {{isset($arr_product['sub_category']['market_orientation_markup']) ? $arr_product['sub_category']['market_orientation_markup'].'%' : '-'}}</td>
									</tr>

									<tr>
										<th>Supplier Markup(In %):</th>
										<td class="text-right">  {{isset($admin_commission_percent) ? $admin_commission_percent.'%' : '-'}}</td>
									</tr>

									<tr>
										<th>Additional Markup(In %):</th>
										<td class="text-right">  {{isset($arr_product['additional_markup']) ? $arr_product['additional_markup'].'%' : '-'}}</td>
									</tr>

									<tr>
										<th>GST(In %):</th>
										<td class="text-right">  {{isset($gst_percent) ? $gst_percent.'%' : '-'}}</td>
									</tr> --}}
									

									@if(isset($arr_product['product_price']))
									<tr>
										<th>Price:</th>
										<td class="text-right"><i class="fa fa-inr"></i>  {{$arr_product['product_price'] or 'NA'}}</td>
									</tr>
									@endif

									{{-- <tr>
										<th>Discount Amount:</th>
										<td class="text-right">
											@if(isset($arr_product['product_price']) && !empty($arr_product['product_price']) && isset($arr_product['discount']) && !empty($arr_product['discount']))
												@php
													$discount_amt = $arr_product['product_price'] * $arr_product['discount'] / 100 ;
												@endphp
											@endif
											@if(isset($discount_amt) && !empty($discount_amt))
													<i class="fa fa-inr"> {{$discount_amt}}</i>
											@else
												-
											@endif
										</td>
									</tr>

									<tr>
										<th>Market Orientation Markup Amount:</th>
										<td class="text-right">
											@if(isset($arr_product['product_price']) && !empty($arr_product['product_price']) && isset($arr_product['sub_category']['market_orientation_markup']) && !empty($arr_product['sub_category']['market_orientation_markup']))
												@php
													$market_orientation_markup_amt = $arr_product['product_price'] * $arr_product['sub_category']['market_orientation_markup'] / 100 ;
												@endphp
											@endif
											@if(isset($market_orientation_markup_amt) && !empty($market_orientation_markup_amt))
													<i class="fa fa-inr"> {{$market_orientation_markup_amt}}</i>
											@else
												-
											@endif
										</td>
									</tr>

									<tr>
										<th>Supplier Markup Amount:</th>
										<td class="text-right">
											@if(isset($arr_product['product_price']) && !empty($arr_product['product_price']) && isset($admin_commission_percent) && !empty($admin_commission_percent))
												@php
													$supplier_markup_amt = $arr_product['product_price'] * $admin_commission_percent / 100 ;
												@endphp
											@endif
											@if(isset($supplier_markup_amt) && !empty($supplier_markup_amt))
													<i class="fa fa-inr"> {{$supplier_markup_amt}}</i>
											@else
												-
											@endif
										</td>
									</tr>

									<tr>
										<th>Additional Markup Amount:</th>
										<td class="text-right">
											@if(isset($arr_product['product_price']) && !empty($arr_product['product_price']) && isset($arr_product['additional_markup']) && !empty($arr_product['additional_markup']))
												@php
													$market_orientation_markup_amt = $arr_product['product_price'] * $arr_product['additional_markup'] / 100 ;
												@endphp
											@endif
											@if(isset($market_orientation_markup_amt) && !empty($market_orientation_markup_amt))
													<i class="fa fa-inr"> {{$market_orientation_markup_amt}}</i>
											@else
												-
											@endif
										</td>
									</tr>

									<tr>
										<th>GST Amount:</th>
										<td class="text-right">
											@if(isset($arr_product['final_price']) && !empty($arr_product['final_price']) && isset($gst_percent) && !empty($gst_percent))
												@php
													$gst_amount = $arr_product['final_price'] * $gst_percent / 100 ;
												@endphp
											@endif
											@if(isset($gst_amount) && !empty($gst_amount))
													<i class="fa fa-inr"> {{$gst_amount}}</i>
											@else
												-
											@endif
										</td>
									</tr>

									<tr>
										<th>Total Price:</th>
										<td class="text-right">@if(isset($arr_product['final_price']) && !empty($arr_product['final_price']))<i class="fa fa-inr"></i>  {{$arr_product['final_price'] or 'NA'}}@else - @endif</td>
									</tr>
									
									 <tr>
										<th>Price(Without discount):</th>
										<td class="text-right">@if(isset($arr_product['base_price']) && !empty($arr_product['base_price']))<i class="fa fa-inr"></i>  <strike>{{$arr_product['base_price'] or 'NA'}}</strike>@else - @endif</td>
									</tr> --}}

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

									@if(isset($arr_product['band_setting']['band_setting']) && !empty($arr_product['band_setting']['band_setting']))
									<tr>
										<th>Band Setting:</th>
										<td class="text-right">{{$arr_product['band_setting']['band_setting'] or 'NA'}}</td>
									</tr>
									@endif
									@if(isset($arr_product['ring_shoulder']['ring_shoulder_type']) && !empty($arr_product['ring_shoulder']['ring_shoulder_type']))
									<tr>
										<th>Ring Shoulder Type:</th>
										<td class="text-right">{{$arr_product['ring_shoulder']['ring_shoulder_type']}}</td>
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
											<th>Occasions:</th>
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
				<div class="text-right">
					
				
					<a href="javascript:history.back(1)" class="btn btn-primary">Back</a>
					</div>
				</div>

			</div>

			@endsection


		

		{{-- <div class="panel-body">

			<form class="form-horizontal" id="frm_add_jewellery_product" name="frm_add_jewellery_product" action="{{$module_url_path}}/store" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="row">
					<div class="col-md-6">
						<fieldset class="content-group">	
							<div class="form-group">
								<label class="control-label col-lg-4" for="site_name">Product Type</label>
								<div class="col-lg-8">
									{{isset($arr_product['product_type']) && $arr_product['product_type'] == '1' ? 'Classic' : ''}}
									{{isset($arr_product['product_type']) && $arr_product['product_type'] == '2' ? 'Luxury' : ''}}
								</div>
							</div>
							<div class="form-group"  id="category_block">
								<label class="control-label col-lg-4" for="site_name">Category</label>
								<div class="col-lg-8">
									{{$arr_product['category']['category_name'] or 'NA'}}
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-lg-4" for="product_name">Product name</label>
								<div class="col-lg-8">
									{{$arr_product['product_name'] or 'NA'}}
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-lg-4" for="product_model">Product Code/Model</label>
								<div class="col-lg-8">
									{{$arr_product['product_code'] or 'NA'}}
								</div>
							</div>

							<div class="form-group" id="">
								<label class="control-label col-lg-4" for="metal">Metal</label>
								<div class="col-lg-8">
									{{$arr_product['metal']['metal_name'] or 'NA'}}
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="metal_weight">Metal Weight (in gm)</label>
								<div class="col-lg-8">
									{{$arr_product['metal_weight'] or 'NA'}}
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="height">Height</label>
								<div class="col-lg-8">
									{{$arr_product['product_height'] or 'NA'}}
								</div>
							</div>

							<div class="form-group" id="">
								<label class="control-label col-lg-4" for="setting">Setting</label>
								<div class="col-lg-8">
									{{$arr_product['setting']['setting'] or 'NA'}}
								</div>
							</div>
							<div class="form-group" id="">
								<label class="control-label col-lg-4" for="occasion_name">Collections</label>
								<div class="col-lg-8 multi-select-full">
									@if(isset($arr_product['product_collections']) && !empty($arr_product['product_collections']) && is_array($arr_product['product_collections']))
										@foreach($arr_product['product_collections'] as $occasion)
											<ul class="media-list">
												<li> {{$occasion['collection']['name'] or 'NA'}} </li>
											</ul>
										@endforeach
									@endif
								</div>
							</div>
							@if(isset($arr_product['shank_type']['shank_type']) && !empty($arr_product['shank_type']['shank_type']))
								<div class="form-group" id="shank_type_block">
									<label class="control-label col-lg-4" for="shank_type">Shank Type</label>
									<div class="col-lg-8 multi-select-full">
										{{$arr_product['shank_type']['shank_type'] or 'NA'}}
									</div>
								</div>
							@endif

							<div class="form-group">
								<label class="control-label col-lg-4" for="setting">Product Images</label>
								<div class="col-lg-8">
									@if(isset($arr_product['product_images']) && !empty($arr_product['product_images']) && is_array($arr_product['product_images']))
										@foreach($arr_product['product_images'] as $img)
												@if(isset($img['image']) && file_exists($product_image_base_path.$img['image']))
													<div class="fileupload-new img-thumbnail" style="width: 170px; height: 100px;">
															<img src="{{$product_image_public_path.$img['image']}}" style="max-width: 100%;max-height:100%">
													</div>
												@endif
										@endforeach
									@else
										NA
									@endif
								</div>
							</div>

							<span class="help-block" id=""></span>
							
							<div class="form-group text-center">
								<div class="col-lg-7">
									<a href="javascript:history.back(1)" class="btn btn-primary">Back</a>
								</div>
							</div>
						</fieldset>
					</div>
					<div class="col-md-6">
						<fieldset class="content-group">
							
							<div class="form-group" id="">
								<label class="control-label col-lg-4" for="brand">Brand</label>
								<div class="col-lg-8">
									{{$arr_product['brand']['brand_name'] or 'NA'}}
								</div>
							</div>

							<div class="form-group" id="sub_category_block">
								<label class="control-label col-lg-4" for="site_name">Sub category</label>
								<div class="col-lg-8">
									{{$arr_product['sub_category']['subcategory_name'] or 'NA'}}
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="product_description">Product Description</label>
								<div class="col-lg-8">
									{{$arr_product['product_description'] or 'NA'}}
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="product_price">Product Price (In RS.)</label>
								<div class="col-lg-8">
									{{$arr_product['product_price'] or 'NA'}}
								</div>
							</div>

							<div class="form-group" id="">
								<label class="control-label col-lg-4" for="metal_detailing">Metal Detailing</label>
								<div class="col-lg-8 multi-select-full">
									{{$arr_product['metal_detailing']['metal_detailing_name'] or 'NA'}}
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="length">Length</label>
								<div class="col-lg-8">
									{{$arr_product['product_length'] or 'NA'}}
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="width">Width</label>
								<div class="col-lg-8">
									{{$arr_product['product_width'] or 'NA'}}
								</div>
							</div>

							<div class="form-group" id="">
								<label class="control-label col-lg-4" for="occasion_name">Occassion</label>
								<div class="col-lg-8 multi-select-full">
									@if(isset($arr_product['product_occasions']) && !empty($arr_product['product_occasions']) && is_array($arr_product['product_occasions']))
										@foreach($arr_product['product_occasions'] as $occasion)
											<ul class="media-list">
												<li> {{$occasion['occasion']['occasion_name'] or 'NA'}} </li>
											</ul>
										@endforeach
									@endif
								</div>
							</div>
							@if(isset($arr_product['band_setting']['band_setting']) && !empty($arr_product['band_setting']['band_setting']))
								<div class="form-group" id="band_setting_block">
									<label class="control-label col-lg-4" for="band_setting">Band Setting</label>
									<div class="col-lg-8 multi-select-full">
										{{$arr_product['band_setting']['band_setting'] or 'NA'}}
									</div>
								</div>
							@endif
							@if(isset($arr_product['ring_shoulder']['ring_shoulder_type']) && !empty($arr_product['ring_shoulder']['ring_shoulder_type']))
								<div class="form-group" id="ring_shoulder_type_block">
									<label class="control-label col-lg-4" for="ring_shoulder_type">Ring Shoulder Type</label>
									<div class="col-lg-8 multi-select-full">
										{{$arr_product['ring_shoulder']['ring_shoulder_type'] or 'NA'}}
									</div>
								</div>
							@endif
							<div class="form-group" id="">
								<label class="control-label col-lg-4" for="band_setting">Allow Product For Home Trial?</label>
								<div class="col-lg-8">
									{{isset($arr_product['allow_product_home_trial']) && $arr_product['allow_product_home_trial'] == '1' ? 'No' : ''}}
									{{isset($arr_product['allow_product_home_trial']) && $arr_product['allow_product_home_trial'] == '2' ? 'Yes' : ''}}
								</div>
							</div>

						</fieldset>
					</div>
				</div>
			</form>
		</div>
	</div> --}}

	{{-- @endsection --}}


	