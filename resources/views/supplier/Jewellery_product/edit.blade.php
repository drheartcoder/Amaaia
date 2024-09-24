
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
		<div class="panel-heading">
			<h5 class="panel-title">{{$sub_module_title or ''}}</h5>
		</div>

		<div class="panel-body">

			<form class="form-horizontal create-class-form" id="frm_add_jewellery_product" name="frm_add_jewellery_product" action="{{$module_url_path}}/update/{{$id}}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="row">
					<div class="col-md-6">
						<fieldset class="content-group">
							<legend class="text-bold">Basic Details :</legend>
							<div class="form-group">
								<label class="control-label col-lg-4" for="site_name">Product Type<i class="red">*</i></label>
								<div class="col-lg-8">
									<select class="form-control" id="product_type" name="product_type" data-rule-required="true" data-msg-required="Please select the product type." onchange="get_category(this,'change')">
										<option value="">Select product type</option>
										<option value="1" {{isset($arr_product['product_type']) && $arr_product['product_type'] == '1' ? 'selected' : ''}}>Classic</option>
										<option value="2" {{isset($arr_product['product_type']) && $arr_product['product_type'] == '2' ? 'selected' : ''}}>Luxure</option>
									</select>
									<span class="error_product_type error">{{ $errors->first('product_type') }} </span>
								</div>
							</div>
							<div class="form-group" id="category_block">
								<label class="control-label col-lg-4" for="site_name">Category<i class="red">*</i></label>
								<div class="col-lg-8">
									<select class="form-control" id="category_name" name="category_name" data-rule-required="true" data-msg-required="Please select the product type." onchange="load_subcategories()">
										
									</select>
									<span class="error_category error">{{ $errors->first('category_name') }} </span>
								</div>
							</div>

							<div class="form-group" id="sub_category_block" style="display: none">
								<label class="control-label col-lg-4" for="site_name">Sub category<i class="red">*</i></label>
								<div class="col-lg-8">
									<select class="form-control" id="subcategory_name" name="subcategory_name" data-rule-required="true" data-msg-required="Please select the subcategory." onchange="get_product_lines(this)">
										<option value="">Select Sub category</option>
									</select>
									<span class="error_category error">{{ $errors->first('subcategory_name') }} </span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-lg-4" for="product_name">Product name<i class="red">*</i></label>
								<div class="col-lg-8">
									<input type="text" name="product_name" id="product_name" class="form-control" placeholder="Product Name" data-rule-required="true"  data-rule-maxlength="60" value="{{$arr_product['product_name'] or '' }}">
									<span class="error">{{ $errors->first('product_name') }} </span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="product_model">Product Code/Model<i class="red">*</i></label>
								<div class="col-lg-8">
									<input type="text" name="product_model" id="product_model" class="form-control" placeholder="Product Code/Model" data-rule-required="true"  data-rule-maxlength="60" value="{{$arr_product['product_code'] or '' }}">
									<span class="error">{{ $errors->first('product_model') }} </span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="quantity">Quantity<i class="red">*</i></label>
								<div class="col-lg-8">
									<input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity" value="{{$arr_product['quantity'] or '' }}" data-rule-required="true" data-rule-maxlength="6" data-msg-maxlength="Please enter no more than 6 digits." data-rule-digits="true">
									<span class="error">{{ $errors->first('quantity') }} </span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="product_price">Product Price (In RS.)<i class="red">*</i></label>
								<div class="col-lg-8">
									<input type="text" name="product_price" id="product_price" class="form-control" placeholder="Product Price" data-rule-required="true"  data-rule-maxlength="10" data-rule-pattern="\d+(\.\d{1,2})?" data-msg-pattern="Please enter valid price." data-msg-maxlength="Please enter no more than 10 digits." value="{{$arr_product['product_price'] or '' }}">
									<span class="error">{{ $errors->first('product_price') }} </span>
								</div>
							</div>

							<legend class="text-bold">Product Specifications :</legend>

							<div class="form-group">
								<label class="control-label col-lg-4" for="look">Look<i class="red">*</i></label>
								<div class="col-lg-8 multi-select-full">
									<select class="form-control" id="look" name="look" data-rule-required="true" data-msg-required="Please select the look.">
										@if(isset($arr_look) && !empty($arr_look) && is_array($arr_look))
										<option value="">Select Look</option>
										@foreach($arr_look as $look)
										<option value="{{$look['id'] or ''}}" {{isset($arr_product['look_id']) && isset($look['id']) && $arr_product['look_id'] == $look['id'] ? 'selected' : ''}} >{{$look['look'] or '' }}</option>
										@endforeach
										@endif
									</select>
									<span class="error err_look">{{ $errors->first('look') }} </span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="metal_weight">Metal Weight (in gm)<i class="red">*</i></label>
								<div class="col-lg-8">
									<input type="text" name="metal_weight" id="metal_weight" class="form-control" placeholder="Metal Weight" data-rule-required="true" data-rule-pattern="\d+(\.\d{1,2})?" data-rule-maxlength="6" data-msg-pattern="Please enter valid weight." value="{{$arr_product['metal_weight'] or '' }}" data-msg-maxlength="Please enter no more than 6 digits.">
									<span class="error">{{ $errors->first('metal_weight') }} </span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="length">Length(In MM)</label>
								<div class="col-lg-8">
									<input type="text" name="length" id="length" class="form-control" placeholder="Length" data-rule-required="false"  data-rule-maxlength="10" value="{{$arr_product['product_length'] or '' }}" data-rule-pattern="\d+(\.\d{1,2})?" data-msg-pattern="Please enter valid length." data-msg-maxlength="Please enter no more than 10 digits.">
									<span class="error">{{ $errors->first('length') }} </span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="width">Width(In MM)</label>
								<div class="col-lg-8">
									<input type="text" name="width" id="width" class="form-control" placeholder="Width" data-rule-required="false"  data-rule-maxlength="10" data-msg-maxlength="Please enter no more than 10 digits." value="{{$arr_product['product_width'] or '' }}">
									<span class="error">{{ $errors->first('width') }} </span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="height">Height(In MM)</label>
								<div class="col-lg-8">
									<input type="text" name="height" id="height" class="form-control" placeholder="Height" value="{{$arr_product['product_height'] or '' }}" data-rule-required="false" data-rule-pattern="\d+(\.\d{1,2})?" data-rule-maxlength="6" data-msg-maxlength="Please enter no more than 6 digits.">
									<span class="error">{{ $errors->first('height') }} </span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="product_description">Product Description<i class="red">*</i></label>
								<div class="col-lg-8">
									<textarea name="product_description" id="product_description" class="form-control" placeholder="Product Description" data-rule-required="true"  data-rule-maxlength="550" rows="3">{{$arr_product['product_description'] or '' }}</textarea>
									<span class="error">{{ $errors->first('product_description') }} </span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="product_specification">Product Specification<i class="red">*</i></label>
								<div class="col-lg-8">
									<textarea name="product_specification" id="product_specification" class="form-control" placeholder="Product Specification" data-rule-required="true"  data-rule-maxlength="550" rows="3">{{$arr_product['product_specification'] or ''}}</textarea>
									<span class="error">{{ $errors->first('product_specification') }} </span>
								</div>
							</div>

							<legend class="text-bold">Product Image :</legend>

							<div class="col-sm-12 col-md-12 col-lg-12"> 
								<div class="lab_img" id="lab_1">
									<div class="col-sm-12 col-lg-12 col-lg-12" style="float:right;"> 
										<span>
											<a href="javascript:void(0);" id='remove_project' class="remove_project" style="display:none;" >
												<span class="glyphicon glyphicon-minus-sign" style="font-size: 20px;"></span>
											</a>
										</span>
									</div>
									<div class="" id="add_lab_div">
										<div class="add_pht upload-pic loc_add_pht" id="div_blank" onclick="return upload_image(this)" style="height: 120px;width: 120px; float: left;"> 
											<img src="{{url('/')}}/web_supplier/assets/images/multy-plus.jpg" alt="plus-image" style="width:100%;height:100%;" /></div>
											<div class="show_photos" id="show_photos" style="width: auto; display: initial;float: none;">
											</div>
											<div id="div_hidden_photo_list" class="div_hidden_photo_list">

												@php $img_counter = 0; @endphp
												@if(isset($arr_product['product_images']) && !empty($arr_product['product_images']) && is_array($arr_product['product_images']))
												@foreach($arr_product['product_images'] as $img)
												@if(isset($img['image']) && file_exists($product_image_base_path.$img['image']))
												@php $img_counter ++; @endphp
												@endif
												@endforeach
												@endif


												<input type="file" name="product_image[]" id="product_image" class="product_image" style="display:none" {{isset($img_counter) && $img_counter == 0 ? 'data-rule-required=true' : ''}} data-msg-required="Please select the product image." />
											</div>

											

											@if(isset($arr_product['product_images']) && !empty($arr_product['product_images']) && is_array($arr_product['product_images']))
											@foreach($arr_product['product_images'] as $img)
											@if(isset($img['image']) && file_exists($product_image_base_path.$img['image']))


											<div class='photo_view2 remove_product_img' data-id="{{base64_encode($img['id'])}}" style='width:120px;height:120px;position:relative;display: inline-block;'><img src="{{$product_image_public_path.$img['image']}}" class='add_pht' id='add_pht upload-pic' style='float: left; padding: 0px ! important; margin:0' width='120' height='120'><div class='overlay2'><span class='plus2'>X</span></div></div>
											@endif
											@endforeach
											@else
											<span class="clearfix"></span>
											No product image available.
											@endif

										</div>
									</div>
								</div>

							</fieldset>
						</div>
						<div class="col-md-6">
							<fieldset class="content-group">

								<legend class="text-bold">Metal & Gemstone :</legend>

								<div class="form-group" id="">
									<label class="control-label col-lg-4" for="metal_name">Metal<i class="red">*</i></label>
									<div class="col-lg-3">
										<select class="form-control" id="metal_name" name="metal_name" data-rule-required="true" data-msg-required="Please select the metal.">
											<option value="">Metal</option>
											@if(isset($arr_metal) && !empty($arr_metal) && is_array($arr_metal))
											@foreach($arr_metal as $metal)
											<option value="{{$metal['id'] or ''}}" {{isset($arr_product['product_metals'][0]['metal_name']['id']) && $arr_product['product_metals'][0]['metal_name']['id'] == $metal['id'] ? 'selected' : ''}}>{{$metal['metal_name'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error">{{ $errors->first('metal_name') }} </span>
									</div>

									<div class="col-lg-3">
										<select class="form-control" id="metal_color" name="metal_color" data-rule-required="true" data-msg-required="Please select the metal color.">
											<option value="">Color</option>
											@if(isset($arr_metal_color) && !empty($arr_metal_color) && is_array($arr_metal_color))
											@foreach($arr_metal_color as $metal_color)
											<option value="{{$metal_color['id'] or ''}}" {{isset($arr_product['product_metals'][0]['metal_color']['id']) && $arr_product['product_metals'][0]['metal_color']['id'] == $metal_color['id'] ? 'selected' : ''}}>{{$metal_color['metal_color'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error">{{ $errors->first('metal_color') }} </span>
									</div>
									<div class="col-lg-2">
										<select class="form-control" id="metal_quality" name="metal_quality" data-rule-required="true" data-msg-required="Please select the metal quality."  style="padding-right: 3px;">
											<option value="">Quality</option>
											@if(isset($arr_metal_quality) && !empty($arr_metal_quality) && is_array($arr_metal_quality))
											@foreach($arr_metal_quality as $metal_quality)
											<option value="{{$metal_quality['id'] or ''}}" {{isset($arr_product['product_metals'][0]['metal_quality']['id']) && $arr_product['product_metals'][0]['metal_quality']['id'] == $metal_quality['id'] ? 'selected' : ''}}>{{$metal_quality['quality_name'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error">{{ $errors->first('metal_quality') }} </span>
									</div>
								</div>

								<div class="form-group" id="">
									<label class="control-label col-lg-4" for="metal_name_2">Metal</label>
									<div class="col-lg-3">
										<select class="form-control" id="metal_name_2" name="metal_name_2" data-msg-required="Please select the metal.">
											<option value="">Metal</option>
											@if(isset($arr_metal) && !empty($arr_metal) && is_array($arr_metal))
											@foreach($arr_metal as $metal)
											<option value="{{$metal['id'] or ''}}" {{isset($arr_product['product_metals'][1]['metal_name']['id']) && $arr_product['product_metals'][1]['metal_name']['id'] == $metal['id'] ? 'selected' : ''}}>{{$metal['metal_name'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error">{{ $errors->first('metal_name_2') }} </span>
									</div>

									<div class="col-lg-3">
										<select class="form-control" id="metal_color_2" name="metal_color_2" data-msg-required="Please select the metal color.">
											<option value="">Color</option>
											@if(isset($arr_metal_color) && !empty($arr_metal_color) && is_array($arr_metal_color))
											@foreach($arr_metal_color as $metal_color)
											<option value="{{$metal_color['id'] or ''}}" {{isset($arr_product['product_metals'][1]['metal_color']['id']) && $arr_product['product_metals'][1]['metal_color']['id'] == $metal_color['id'] ? 'selected' : ''}}>{{$metal_color['metal_color'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error">{{ $errors->first('metal_color_2') }} </span>
									</div>
									<div class="col-lg-2">
										<select class="form-control" id="metal_quality_2" name="metal_quality_2" data-msg-required="Please select the metal quality."  style="padding-right: 3px;">
											<option value="">Quality</option>
											@if(isset($arr_metal_quality) && !empty($arr_metal_quality) && is_array($arr_metal_quality))
											@foreach($arr_metal_quality as $metal_quality)
											<option value="{{$metal_quality['id'] or ''}}" {{isset($arr_product['product_metals'][1]['metal_quality']['id']) && $arr_product['product_metals'][1]['metal_quality']['id'] == $metal_quality['id'] ? 'selected' : ''}}>{{$metal_quality['quality_name'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error">{{ $errors->first('metal_quality_2') }} </span>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-lg-4" for="metal_quality_2"></label>
									<div class="col-lg-8">
										<span class="red">Note : All 3 attributes need to select to add metal.</span>
									</div>
								</div>

								<div class="form-group" id="">
									<label class="control-label col-lg-4" for="gemstone_type">Gemstone<i class="red">*</i></label>
									<div class="col-lg-4">
										<select class="form-control"  id="gemstone_type" name="gemstone_type" data-rule-required="true" data-msg-required="Please select the gemstone type.">
											<option value="">Select Type</option>
											@if(isset($arr_gemstone) && !empty($arr_gemstone) && is_array($arr_gemstone))
											@foreach($arr_gemstone as $gemstone)

											<option value="{{$gemstone['id'] or ''}}" {{isset($arr_product['product_gemstones'][0]['gemstone_type']['id']) && $arr_product['product_gemstones'][0]['gemstone_type']['id'] == $gemstone['id'] ? 'selected' : ''}}>{{$gemstone['type'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error err_gemstone_type">{{ $errors->first('gemstone_type') }} </span>
									</div>

									<div class="col-lg-4">
										<select class="form-control"  id="gemstone_color" name="gemstone_color" data-rule-required="true" data-msg-required="Please select the gemstone color.">
											<option value="">Select Color</option>
											@if(isset($arr_gemstone_color) && !empty($arr_gemstone_color) && is_array($arr_gemstone_color))
											@foreach($arr_gemstone_color as $gemstone_color)
											<option value="{{$gemstone_color['id'] or ''}}" {{isset($arr_product['product_gemstones'][0]['gemstone_color']['id']) && $arr_product['product_gemstones'][0]['gemstone_color']['id'] == $gemstone_color['id'] ? 'selected' : ''}}>{{$gemstone_color['gemstone_color'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error err_gemstone">{{ $errors->first('gemstone_color') }} </span>
									</div>
									<span class="clearfix"></span>
									<br>
									<label class="control-label col-lg-4" for="gemstone_quality"></label>
									<div class="col-lg-4">
										<select class="form-control"  id="gemstone_quality" name="gemstone_quality" data-rule-required="true" data-msg-required="Please select the gemstone quality.">
											<option value="">Select Quality</option>
											@if(isset($arr_gemstone_quality) && !empty($arr_gemstone_quality) && is_array($arr_gemstone_quality))
											@foreach($arr_gemstone_quality as $gemstone_quality)
											<option value="{{$gemstone_quality['id'] or ''}}" {{isset($arr_product['product_gemstones'][0]['gemstone_quality']['id']) && $arr_product['product_gemstones'][0]['gemstone_quality']['id'] == $gemstone_quality['id'] ? 'selected' : ''}}>{{$gemstone_quality['gemstone_quality'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error err_gemstone">{{ $errors->first('gemstone_quality') }} </span>
									</div>
									<div class="col-lg-4">
										<select class="form-control"  id="gemstone_shape" name="gemstone_shape" data-rule-required="true" data-msg-required="Please select the gemstone shape.">
											<option value="">Select Shape</option>
											@if(isset($arr_gemstone_shape) && !empty($arr_gemstone_shape) && is_array($arr_gemstone_shape))
											@foreach($arr_gemstone_shape as $gemstone_shape)
											<option value="{{$gemstone_shape['id'] or ''}}" {{isset($arr_product['product_gemstones'][0]['gemstone_shape']['id']) && $arr_product['product_gemstones'][0]['gemstone_shape']['id'] == $gemstone_shape['id'] ? 'selected' : ''}}>{{$gemstone_shape['shape_name'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error err_gemstone">{{ $errors->first('gemstone_shape') }} </span>
									</div>
								</div>

								<div class="form-group" id="">
									<label class="control-label col-lg-4" for="gemstone_type_2">Gemstone</label>
									<div class="col-lg-4">
										<select class="form-control"  id="gemstone_type_2" name="gemstone_type_2" data-msg-required="Please select the gemstone type.">
											<option value="">Select Type</option>
											@if(isset($arr_gemstone) && !empty($arr_gemstone) && is_array($arr_gemstone))
											@foreach($arr_gemstone as $gemstone)
											<option value="{{$gemstone['id'] or ''}}" {{isset($arr_product['product_gemstones'][1]['gemstone_type']['id']) && $arr_product['product_gemstones'][1]['gemstone_type']['id'] == $gemstone['id'] ? 'selected' : ''}}>{{$gemstone['type'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error err_gemstone">{{ $errors->first('gemstone_type_2') }} </span>
									</div>

									<div class="col-lg-4">
										<select class="form-control"  id="gemstone_color_2" name="gemstone_color_2" data-msg-required="Please select the gemstone color.">
											<option value="">Select Color</option>
											@if(isset($arr_gemstone_color) && !empty($arr_gemstone_color) && is_array($arr_gemstone_color))
											@foreach($arr_gemstone_color as $gemstone_color)
											<option value="{{$gemstone_color['id'] or ''}}" {{isset($arr_product['product_gemstones'][1]['gemstone_color']['id']) && $arr_product['product_gemstones'][1]['gemstone_color']['id'] == $gemstone_color['id'] ? 'selected' : ''}}>{{$gemstone_color['gemstone_color'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error err_gemstone">{{ $errors->first('gemstone_color_2') }} </span>
									</div>
									<span class="clearfix"></span>
									<br>
									<label class="control-label col-lg-4" for="gemstone_quality_2"></label>
									<div class="col-lg-4">
										<select class="form-control"  id="gemstone_quality_2" name="gemstone_quality_2" data-msg-required="Please select the gemstone quality.">
											<option value="">Select Quality</option>
											@if(isset($arr_gemstone_quality) && !empty($arr_gemstone_quality) && is_array($arr_gemstone_quality))
											@foreach($arr_gemstone_quality as $gemstone_quality)
											<option value="{{$gemstone_quality['id'] or ''}}" {{isset($arr_product['product_gemstones'][1]['gemstone_quality']['id']) && $arr_product['product_gemstones'][1]['gemstone_quality']['id'] == $gemstone_quality['id'] ? 'selected' : ''}}>{{$gemstone_quality['gemstone_quality'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error err_gemstone">{{ $errors->first('gemstone_quality_2') }} </span>
									</div>
									<div class="col-lg-4">
										<select class="form-control"  id="gemstone_shape_2" name="gemstone_shape_2"  data-msg-required="Please select the gemstone shape.">
											<option value="">Select Shape</option>
											@if(isset($arr_gemstone_shape) && !empty($arr_gemstone_shape) && is_array($arr_gemstone_shape))
											@foreach($arr_gemstone_shape as $gemstone_shape)
											<option value="{{$gemstone_shape['id'] or ''}}"  {{isset($arr_product['product_gemstones'][1]['gemstone_shape']['id']) && $arr_product['product_gemstones'][1]['gemstone_shape']['id'] == $gemstone_shape['id'] ? 'selected' : ''}}>{{$gemstone_shape['shape_name'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error err_gemstone">{{ $errors->first('gemstone_shape_2') }} </span>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-lg-4" for="gemstone_quality_3"></label>
									<div class="col-lg-8">
										<span class="red">Note : All 4 attributes need to select to add gemstone.</span>
									</div>
								</div>

								<div class="form-group" id="">
									<label class="control-label col-lg-4" for="gemstone_type_3">Gemstone</label>
									<div class="col-lg-4">
										<select class="form-control"  id="gemstone_type_3" name="gemstone_type_3" data-msg-required="Please select the gemstone type.">
											<option value="">Select Type</option>
											@if(isset($arr_gemstone) && !empty($arr_gemstone) && is_array($arr_gemstone))
											@foreach($arr_gemstone as $gemstone)
											<option value="{{$gemstone['id'] or ''}}" {{isset($arr_product['product_gemstones'][2]['gemstone_type']['id']) && $arr_product['product_gemstones'][2]['gemstone_type']['id'] == $gemstone['id'] ? 'selected' : ''}}>{{$gemstone['type'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error err_gemstone">{{ $errors->first('gemstone_type_3') }} </span>
									</div>

									<div class="col-lg-4">
										<select class="form-control"  id="gemstone_color_3" name="gemstone_color_3" data-msg-required="Please select the gemstone color.">
											<option value="">Select Color</option>
											@if(isset($arr_gemstone_color) && !empty($arr_gemstone_color) && is_array($arr_gemstone_color))
											@foreach($arr_gemstone_color as $gemstone_color)
											<option value="{{$gemstone_color['id'] or ''}}" {{isset($arr_product['product_gemstones'][2]['gemstone_color']['id']) && $arr_product['product_gemstones'][2]['gemstone_color']['id'] == $gemstone_color['id'] ? 'selected' : ''}}>{{$gemstone_color['gemstone_color'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error err_gemstone">{{ $errors->first('gemstone_color_3') }} </span>
									</div>
									<span class="clearfix"></span>
									<br>
									<label class="control-label col-lg-4" for="gemstone_quality_3"></label>
									<div class="col-lg-4">
										<select class="form-control"  id="gemstone_quality_3" name="gemstone_quality_3" data-msg-required="Please select the gemstone quality.">
											<option value="">Select Quality</option>
											@if(isset($arr_gemstone_quality) && !empty($arr_gemstone_quality) && is_array($arr_gemstone_quality))
											@foreach($arr_gemstone_quality as $gemstone_quality)
											<option value="{{$gemstone_quality['id'] or ''}}" {{isset($arr_product['product_gemstones'][2]['gemstone_quality']['id']) && $arr_product['product_gemstones'][2]['gemstone_quality']['id'] == $gemstone_quality['id'] ? 'selected' : ''}}>{{$gemstone_quality['gemstone_quality'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error err_gemstone">{{ $errors->first('gemstone_quality_3') }} </span>
									</div>
									<div class="col-lg-4">
										<select class="form-control"  id="gemstone_shape_3" name="gemstone_shape_3"  data-msg-required="Please select the gemstone shape.">
											<option value="">Select Shape</option>
											@if(isset($arr_gemstone_shape) && !empty($arr_gemstone_shape) && is_array($arr_gemstone_shape))
											@foreach($arr_gemstone_shape as $gemstone_shape)
											<option value="{{$gemstone_shape['id'] or ''}}" {{isset($arr_product['product_gemstones'][2]['gemstone_shape']['id']) && $arr_product['product_gemstones'][2]['gemstone_shape']['id'] == $gemstone_shape['id'] ? 'selected' : ''}}>{{$gemstone_shape['shape_name'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error err_gemstone">{{ $errors->first('gemstone_shape_3') }} </span>

									</div>

								</div>
								<div class="form-group">
									<label class="control-label col-lg-4" for="gemstone_quality_3"></label>
									<div class="col-lg-8">
										<span class="red">Note : All 4 attributes need to select to add gemstone.</span>
									</div>
								</div>


								<div class="form-group" id="">
									<label class="control-label col-lg-4" for="metal_detailing">Metal Detailing</label>
									<div class="col-lg-8 multi-select-full">
										<select class="form-control" id="metal_detailing" name="metal_detailing" data-rule-required="false" data-msg-required="Please select the metal detailing.">
											@if(isset($arr_metal_detailing) && !empty($arr_metal_detailing) && is_array($arr_metal_detailing))
											<option value="">Select Metal Detailing</option>
											@foreach($arr_metal_detailing as $metal_detailing)
											<option value="{{$metal_detailing['id'] or ''}}" {{isset($arr_product['product_metal_detailing_id']) && isset($metal_detailing['id']) && $arr_product['product_metal_detailing_id'] == $metal_detailing['id'] ? 'selected' : ''}} >{{$metal_detailing['metal_detailing_name'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error err_metal_detailing">{{ $errors->first('metal_detailing') }} </span>
									</div>
								</div>

								<legend class="text-bold">Other Details :</legend>

								<div class="form-group">
									<label class="control-label col-lg-4" for="collection">Collection<i class="red">*</i></label>
									<div class="col-lg-8 multi-select-full">
										<select class="multiselect" multiple="multiple" id="collection" name="collection[]" data-rule-required="true" data-msg-required="Please select the collection.">
											@if(isset($arr_collection) && !empty($arr_collection) && is_array($arr_collection))

											@if(isset($arr_product['product_collections']) && !empty($arr_product['product_collections']))
											@foreach($arr_product['product_collections'] as $key => $value) 
											@php 

											$arr_collection_ids[] = isset($value['collection']['id']) ? $value['collection']['id'] : 0; 
											@endphp
											@endforeach
											@endif

											@foreach($arr_collection as $collection)
											@if(isset($arr_collection_ids) && isset($collection['id']) && in_array($collection['id'], $arr_collection_ids))
											@php $collection_selected = 'selected' @endphp;
											@else
											@php $collection_selected = '' @endphp;
											@endif
											<option value="{{$collection['id'] or ''}}" {{$collection_selected or ''}}>{{$collection['name'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error err_collection">{{ $errors->first('collection') }} </span>
									</div>
								</div>

								<div class="form-group" id="">
									<label class="control-label col-lg-4" for="occasion_name">Occasion<i class="red">*</i></label>
									<div class="col-lg-8 multi-select-full">
										<select class="multiselect" multiple="multiple" id="occasion_name" name="occasion_name[]" data-rule-required="true" data-msg-required="Please select occassion.">
											@if(isset($arr_occassion) && !empty($arr_occassion) && is_array($arr_occassion))
											@if(isset($arr_product['product_occasions']) && !empty($arr_product['product_occasions']))
											@foreach($arr_product['product_occasions'] as $key => $value) 
											@php 
											$arr_occasion_ids[] = isset($value['occasion']['id']) ? $value['occasion']['id'] : 0; 
											@endphp
											@endforeach
											@endif

											@foreach($arr_occassion as $occassion)
											@if(isset($arr_occasion_ids) && isset($occassion['id']) && in_array($occassion['id'], $arr_occasion_ids))
											@php $occasion_selected = 'selected' @endphp;
											@else
											@php $occasion_selected = '' @endphp;
											@endif
											<option value="{{$occassion['id'] or ''}}" {{$occasion_selected or ''}}>{{$occassion['occasion_name'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error err_occasion_name">{{ $errors->first('occasion_name') }} </span>
									</div>
								</div>

								<div class="form-group" style="display: none" id="product_line_block">
									<label class="control-label col-lg-4" for="site_name">Product Line<i class="red">*</i></label>
									<div class="col-lg-8">
										<select class="form-control" id="product_line" name="product_line" data-rule-required="true" data-msg-required="Please select the product line." onchange="get_product_line()">

										</select>
										<span class="error_category error">{{ $errors->first('product_line') }} </span>
									</div>
								</div>

								<div class="form-group" id="">
									<label class="control-label col-lg-4" for="setting">Setting</label>
									<div class="col-lg-8">
										<select class="form-control" id="setting" name="setting" data-rule-required="false" data-msg-required="Please select the setting.">
											<option value="">Select Setting</option>
											@if(isset($arr_setting) && !empty($arr_setting) && is_array($arr_setting))
											@foreach($arr_setting as $setting)
											<option value="{{$setting['id'] or ''}}" {{isset($arr_product['setting_id']) && $arr_product['setting_id'] == $setting['id'] ? 'selected' : '' }}>{{$setting['setting'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error">{{ $errors->first('setting') }} </span>
									</div>
								</div>

								<div class="form-group" id="">
									<label class="control-label col-lg-4" for="brand">Brand</label>
									<div class="col-lg-8">
										<select class="form-control" id="brand" name="brand" data-rule-required="false" data-msg-required="Please select the brand.">
											<option value="">Select Brand</option>
											@if(isset($arr_brand) && !empty($arr_brand) && is_array($arr_brand))
											@foreach($arr_brand as $brand)
											<option value="{{$brand['id'] or ''}}" {{isset($arr_product['product_brand_id']) && isset($brand['id']) && $arr_product['product_brand_id'] == $brand['id'] ? 'selected' : ''}} >{{$brand['brand_name'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error">{{ $errors->first('brand') }} </span>
									</div>
								</div>

								<div class="form-group" id="band_setting_block" style="display: none;">
									<label class="control-label col-lg-4" for="band_setting">Band Setting<i class="red">*</i></label>
									<div class="col-lg-8 multi-select-full">
										<select class="form-control" id="band_setting" name="band_setting" data-msg-required="Please select the band setting.">
											@if(isset($arr_band_setting) && !empty($arr_band_setting) && is_array($arr_band_setting))
											<option value="">Select Band Setting</option>
											@foreach($arr_band_setting as $band_setting)
											<option value="{{$band_setting['id'] or ''}}" {{isset($arr_product['band_setting']['id']) && isset($band_setting['id']) && $arr_product['band_setting']['id'] == $band_setting['id'] ? 'selected' : '' }} >{{$band_setting['band_setting'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error err_band_setting">{{ $errors->first('band_setting') }} </span>
									</div>
								</div>
								<div class="form-group" id="ring_shoulder_type_block" style="display: none;">
									<label class="control-label col-lg-4" for="ring_shoulder_type">Ring Shoulder Type<i class="red">*</i></label>
									<div class="col-lg-8 multi-select-full">
										<select class="form-control" id="ring_shoulder_type" name="ring_shoulder_type" data-msg-required="Please select the ring shoulder type.">
											@if(isset($arr_ring_shoulder) && !empty($arr_ring_shoulder) && is_array($arr_ring_shoulder))
											<option value="">Select Ring Shoulder Type</option>
											@foreach($arr_ring_shoulder as $ring_shoulder_type)
											<option value="{{$ring_shoulder_type['id'] or ''}}"  {{isset($arr_product['ring_shoulder']['id']) && isset($ring_shoulder_type['id']) && $arr_product['ring_shoulder']['id'] == $ring_shoulder_type['id'] ? 'selected' : '' }}  >{{$ring_shoulder_type['ring_shoulder_type'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error err_ring_shoulder_type">{{ $errors->first('ring_shoulder_type') }} </span>
									</div>
								</div>

								<div class="form-group" id="shank_type_block" style="display: none">
									<label class="control-label col-lg-4" for="shank_type">Shank Type<i class="red">*</i></label>
									<div class="col-lg-8 multi-select-full">
										<select class="form-control" id="shank_type" name="shank_type" data-msg-required="Please select the shank type.">
											@if(isset($arr_shank_type) && !empty($arr_shank_type) && is_array($arr_shank_type))
											<option value="">Select Shank Type</option>
											@foreach($arr_shank_type as $shank)
											<option value="{{$shank['id'] or ''}}" {{isset($arr_product['shank_type_id']) && $arr_product['shank_type_id'] == $shank['id'] ? 'selected' : ''}}>{{$shank['shank_type'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error err_shank_type">{{ $errors->first('shank_type') }} </span>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-lg-4" for="is_size">Is product has size?</label>
									<div class="col-lg-8">
										<input type="checkbox" name="is_size" id="is_size" placeholder="Width" {{isset($arr_product['product_size']) && sizeof($arr_product['product_size']) > 0 ? 'checked' : ''}}>
									</div>
								</div>

								@php $counter = 0; @endphp
								@if(isset($arr_product['product_size']) && !empty($arr_product['product_size']))
								<div id="document_div_{{$size['id'] or ''}}">
									<div class="form-group size_block">
										<label class="control-label col-lg-4" for="size">
											@if($counter == 0)
											Size(In MM)<i class="red">*</i>
											@endif
										</label>
										<div class="col-lg-8">
											@foreach($arr_product['product_size'] as $size)
											@if(isset($size['size_name']))
											@php  $sizes[] = $size['size_name']; @endphp 
											@endif
											@endforeach
											
											@if(isset($sizes) && !empty($sizes))
											{{implode(",",$sizes)}}

											<span class="clearfix"></span>
											<a data-toggle="modal" data-target="#modal_form_horizontal" id="btn_open_size_modal">+ Add More</a>
											@endif
										</div>
									</div>
								</div>
								@else

								<div class="form-group size_block" style="display: none">
									<label class="control-label col-lg-4" for="size">Size<i class="red">*</i></label>
									<div class="col-lg-8">
										<input type="text" name="size[]" id="size" value="" class="form-control" placeholder="size" data-rule-maxlength="10" data-msg-maxlength="Please enter no more than 10 digits." value="{{old('width')}}">
										<span class="error">{{ $errors->first('size') }} </span>
										<span class="error err_size">{{ $errors->first('size') }} </span>
										<span class="clearfix"></span>
										<a data-toggle="modal" data-target="#modal_form_horizontal" id="btn_open_size_modal">+ Add More</a>
									</div>
								</div>

								@endif


								<div class="form-group">
									<label class="control-label col-lg-4" for="video_url">Video URL</label>
									<div class="col-lg-8">
										<input type="text" name="video_url" id="video_url" class="form-control" placeholder="Video URL" data-rule-required="false" pattern="https?://.+" data-msg-pattern="Invalid url. It must be youtube's embeded URL." value="{{$arr_product['video_url'] or ''}}">
										<span class="error">{{ $errors->first('video_url') }} </span>
										<span class="clearfix"></span>
										<span class="red">Note : Only Youtube's embed URL is allowed. </span>
									</div>
								</div>

								<div class="form-group" id="">
									<label class="control-label col-lg-4" for="delivery_date">Delivery Date<i class="red">*</i></label>
									@php
									$arr_delivery_date = array('0-5','5-10','10-20','20-30');
									@endphp
									<div class="col-lg-8 multi-select-full">
										<select class="form-control" id="delivery_date" name="delivery_date" data-rule-required="true" data-msg-required="Please select the delivery date.">

											@if(isset($arr_delivery_date))
											<option value="">Select Delivery Date</option>
											@foreach($arr_delivery_date as $date)
											<option value="{{$date or ''}}" {{isset($arr_product['delivery_date']) && $arr_product['delivery_date'] == $date ? 'selected' : ''}}>{{ isset($date) && !empty($date) ? $date.' days' : '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error">{{ $errors->first('delivery_date') }} </span>
									</div>
								</div>

								<div class="form-group" id="">
									<label class="control-label col-lg-4" for="band_setting">Allow Product For Home Trial?<i class="red">*</i></label>
									<div class="col-lg-8">
										<label class="radio-inline">
											<input type="radio" data-rule-required="true" data-msg-required="Please select an option." name="home_trial" value="2" {{isset($arr_product['allow_product_home_trial']) && $arr_product['allow_product_home_trial'] == '2' ? 'checked' : ''}}>Yes
										</label>
										<label class="radio-inline">
											<input type="radio" data-rule-required="true" name="home_trial" value="1"  {{isset($arr_product['allow_product_home_trial']) && $arr_product['allow_product_home_trial'] == '1' ? 'checked' : ''}}>No
										</label>
										<span class="clearfix"></span>
										<span class="error err_home_trial">{{ $errors->first('home_trial') }} </span>
									</div>
								</div>

								<div class="form-group text-right">
									<div class="col-lg-7">
										<input type="hidden" id="total_images" name="total_images" value="{{$img_counter or 0}}">
										<input type="hidden" id="total_size"   name="total_size" value="{{isset($arr_product['product_size']) ? sizeof($arr_product['product_size']) : 1}}">
										<input type="hidden" id="subcategory_slug" name="subcategory_slug">
										<input type="hidden" id="category_slug" name="category_slug">
										<button type="submit" class="btn btn-primary">Update</button>
									</div>
								</div>

							</fieldset>
						</div>
					</div>
					<!-- size modal start -->
					<div id="modal_form_horizontal" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h5 class="modal-title">Size</h5>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<div class="col-sm-9">
											@if(isset($arr_product['product_size']) && !empty($arr_product['product_size']))
											@php $size_name_attribute ='size[]'; @endphp
											@else
											@php $size_name_attribute ='new_size[]'; @endphp
											@endif
											
											<input type="text" name="{{$size_name_attribute or ''}}" value="{{$arr_product['product_size'][0]['size_name'] or ''}}" id="new_size" placeholder="Size" class="form-control" onkeypress="return isNumberKey(event)" maxlength="10">

											
											<span class="error">{{ $errors->first('size') }} </span>
										</div>
										<a onclick="appendSizeDiv()" class="text-right">+ Add</a>
									</div>
									@if(isset($arr_product['product_size']))
									@if(isset($arr_product['product_size'][0]['size_name']))
									@php unset($arr_product['product_size'][0]['size_name']); @endphp
									@endif
									@foreach($arr_product['product_size'] as $size)
									@if(isset($size['size_name']))
									@php  $sizes[] = $size['size_name']; @endphp 
									<div id="document_div_{{$size['id'] or ''}}">
										<div class="form-group">
											<div class="col-sm-9"> 
												<input type="text" value="{{$size['size_name'] or ''}}" placeholder="Size" onkeypress="return isNumberKey(event)" maxlength="10" class="validate-document certificate_document form-control" name="size[]" data-rule-maxlength="10" data-msg-maxlength="Please enter no more than 10 digits." id="size_'+new_add_index+'">
											</div>
											<a onclick="removeSizeDiv('{{$size['id'] or ''}}')" class="text-right">- Remove</a>
										</div>
									</div>
									@endif
									@endforeach
									@endif
									<div id="appendSizeDiv" class="size_block"></div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<!-- /size  modal close -->
				</form>
			</div>
		</div>

		<script>

			$(document).ready(function(){
				@if(isset($arr_product['product_type']) && !empty($arr_product['product_type']))

				var product_type =   '{{$arr_product['product_type']}}';

				get_category(product_type,'page_load');

				@endif

				$('#frm_add_jewellery_product').validate({
					ignore: [],
					highlight: function(element) { },
					errorPlacement: function(error, element) 
					{ 
						var name = $(element).attr("name");

						if (name === "shank_type") 
						{
							error.insertAfter('.err_shank_type');
						}
						else if (name === "band_setting") 
						{
							error.insertAfter('.err_band_setting');
						}
						else if (name === "metal_detailing") 
						{
							error.insertAfter('.err_metal_detailing');
						}
						else if (name === "occasion_name[]") 
						{
							error.insertAfter('.err_occasion_name');
						}
						else if(name === 'category_name')
						{
							error.insertAfter('.error_category');
						} 
						else if(name === 'home_trial')
						{
							error.insertAfter('.err_home_trial');
						}
						else if(name === 'ring_shoulder_type')
						{
							error.insertAfter('.err_ring_shoulder_type');
						}
						else if(name === 'collection[]')
						{
							error.insertAfter('.err_collection');
						}
						else if(name === 'metal[]')
						{
							error.insertAfter('.err_metal');
						} 
						else if(name === 'gemstone[]')
						{
							error.insertAfter('.err_gemstone');
						}  
						else
						{
							error.insertAfter(element);
						}
					} 
				});

				$('#is_size').change(function(){
					if($(this).is(':checked') == true)
					{
						$('.size_block').show();

						$('#size').data('rule-required',true);
					}
					else
					{
						$('.size_block').hide();	
						$('#size').data('rule-required',false);
						$('#appendSizeDiv').html('');
					}
				});

			});

			function get_category(product_type_id,action)
			{
				var classic_diamond_category_slug = "{{config('app.project.slug.classic_diamond_category_slug')}}";
				var luxure_diamond_category_slug = "{{config('app.project.slug.luxure_diamond_category_slug')}}";

				if(action == 'change')
				{
					var product_type_id = $(product_type_id).val();

				}
				else if(action == 'page_load')
				{
					var product_type_id = product_type_id;
				}

				$("#product_line_block").hide();


				if(product_type_id != '')
				{
					$.ajax({
						url:'{{$module_url_path}}/get_category',
						type:'get',
						data:{product_type_id:product_type_id},
						success:function(data){
							if(data)
							{
								$("#category_block").show();
								var categories = '<option value="">Select Category</option>';
								$.each(data,function(i, obj){

									var category_id = selected_cat = "";
									if(action == 'page_load')
									{
										category_id =   '{{$arr_product['category_id'] or ''}}';
										if(category_id == obj['id'])
										{
											selected_cat = 'selected';
										}
										else
										{
											selected_cat = "";
										}
									}
									if(obj['slug'] !=  classic_diamond_category_slug && obj['slug'] != luxure_diamond_category_slug)
									{
										categories += "<option "+selected_cat+" value="+obj['id']+" data-slug="+obj['slug']+">"+obj['category_name']+"</option>";
									}

								});

								$("#category_name").html(categories);
								if(action == 'page_load')
								{
									load_subcategories();
								}

							}
							else
							{
								$("#category_name").html("<option>No Category found</option>");
							}
						}
					});
				}
				else
				{
					$("#category_block").hide();
					$("#sub_category_block").hide();

					$('#shank_type_block').hide();
					$('#band_setting_block').hide();
					$('#ring_shoulder_type_block').hide();

				}
			}

			function load_subcategories()
			{
				var cat_id = $('#category_name').val();

				$('#shank_type_block').hide();
				$('#band_setting_block').hide();
				$('#ring_shoulder_type_block').hide();

				var sub_category_id = "{{$arr_product['subcategory_id'] or ''}}";

				selected_option_slug = $('#category_name').find(':selected').attr('data-slug');

				$('#category_slug').val(selected_option_slug);

				if(cat_id)
				{
					{
						$.ajax({
							url:'{{$module_url_path}}/load_subcategory',
							type:'get',
							data:{category_id:cat_id,sub_category_id:sub_category_id},
							success:function(data)
							{
								$("#sub_category_block").show();
								$('#subcategory_name').html(data);
								$("#subcategory_name").change();
							}
						});
					}
				}
				else
				{
					$("#sub_category_block").hide();
				}
			}


			var url = "{{$module_url_path}}";

			$(document).on('click','.remove_product_img', function(){
				var image_id = $(this).attr('data-id');

				remove_element = $(this);
				swal({
					title: "Are you sure?",
					text: "Do you really want to delete this image?",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-danger",
					confirmButtonText: "Yes delete it",
					cancelButtonText: "Cancel",
					closeOnConfirm: false
				},
				function(){
					$.ajax({
						url :url+'/remove_product_img/'+image_id,
						type:'get',
						success:function(data){
							if(data.status == 'success')
							{

								remove_element.prev('.fileupload-new').remove();
								remove_element.remove();

								var total_images = $('#total_images').val();

								var total_images  = total_images-Number(1);
								$('#total_images').val(total_images);

								if(total_images == 0)
								{
									$('#product_image_0').attr('data-rule-required','true');
								}
							}

							showAlert(data.message,data.status);                   
						}
					});
				});

			});

			function get_product_lines(sub_category)
			{
				var sub_category_id = sub_category.value;

				var classic_jewellery_rings_sub_category_slug = "{{$classic_jewellery_rings_sub_category_slug or ''}}";

				var classic_fashion_jewellery_rings_sub_category_slug = "{{$classic_fashion_jewellery_rings_sub_category_slug or ''}}";

				var selected_option_slug = $('option:selected', sub_category).attr('data-slug');

				var classic_jewellery_slug = 'jewellery';
				var selected_cat_slug = $('#category_name').find(':selected').attr('data-slug');

				if(classic_jewellery_slug == selected_cat_slug)
				{
					if(sub_category_id != '')
					{
						$('#product_line').data('rule-required',true);

						$.ajax({
							url:'{{$module_url_path}}/get_product_lines',
							type:'get',
							data:{sub_category_id:sub_category_id},
							success:function(data){
								if(data)
								{
									$("#product_line_block").show();
									var product_lines = '<option value="">Select Product Line</option>';
									$.each(data,function(i, obj){

										if(product_line_id == obj['id'])
										{
											selected_product_line = 'selected';
										}
										else
										{
											selected_product_line = '';
										}

										product_lines += "<option "+selected_product_line+" value="+obj['id']+">"+obj['product_line_name']+"</option>";

									});

									$("#product_line").html(product_lines);
								}
								else
								{
									$("#product_line").html("<option>No Product line found</option>");
								}
							}
						});
					}
					else
					{
						$('#product_line').data('rule-required',false);
						$("#product_line_block").hide();
					}
				}
				else
				{
					$('#product_line').data('rule-required',false);
					$("#product_line_block").hide();
				}


				// Get stored product line id
				var product_line_id = "{{$arr_product['product_line_id'] or ''}}";

				$('#subcategory_slug').val(selected_option_slug);

				if(selected_option_slug == classic_jewellery_rings_sub_category_slug || selected_option_slug == classic_fashion_jewellery_rings_sub_category_slug)
				{
					$('#shank_type_block').show();
					$('#band_setting_block').show();
					$('#ring_shoulder_type_block').show();

					$('#shank_type').data('rule-required',true);  
					$('#band_setting').data('rule-required',true);  
					$('#ring_shoulder_type').data('rule-required',true); 
				}
				else
				{
					$('#shank_type_block').hide();
					$('#band_setting_block').hide();
					$('#ring_shoulder_type_block').hide();

					$('#shank_type').data('rule-required',false);  
					$('#band_setting').data('rule-required',false);  
					$('#ring_shoulder_type').data('rule-required',false);  
				}
			}

			function appendSizeDiv()
			{
				var html = '';
				var add_limit         = '20';
				var add_index         = $("#total_size").val();
				var new_add_index     = parseInt(add_index) + 1;      

				if(new_add_index<=add_limit)
				{
					html+='<div id="document_div_'+new_add_index+'">'
					html+='<div class="form-group"><div class="col-sm-9"> <input type="text" placeholder="Size" onkeypress="return isNumberKey(event)" maxlength="10" class="validate-document certificate_document form-control" name="size['+new_add_index+']" data-rule-maxlength="10" data-msg-maxlength="Please enter no more than 10 digits." id="size_'+new_add_index+'"></div><a onclick="removeSizeDiv('+new_add_index+')" class="text-right">- Remove</a></div>'
					html+='</div>'
					$('#appendSizeDiv').append(html);
					$("#total_size").val(new_add_index);  
				}
				else
				{
					showAlert("You cannot add sizes more that 20."  ,"error");
					return false;
				}  
			}

			function removeSizeDiv(ref)
			{
				var append_document_index = $('#total_size').val();
				$('#document_div_'+ref).remove();
				var remaining_document = append_document_index-Number(1);
				$('#total_size').val(remaining_document);
			}

		</script>

		<script type="text/javascript">
			var total_images = 5;

			var file_size = 2200000;

			var count = parseInt($("#total_images").val());  

			function upload_image(ref)
			{
				var count = parseInt($("#total_images").val());    
				add_image(ref,total_images,count,file_size);
			}

			$(document).ready(function(){

				$('#btn_open_size_modal').click(function(){
					if($('#size').val() != '' && typeof $('#size').val() != 'undefined')
					{
						$('#new_size').val($('#size').val());
					}
				});

				$('#new_size').keyup(function(){
					$($('#size').val($(this).val()));
				});

				$("#occasion_name,#collection").on("change", function() {  // whenever a selection is made
				    $(this).valid(); // force validation in order to remove any messages
				});
				
			});

		</script>

		@endsection


