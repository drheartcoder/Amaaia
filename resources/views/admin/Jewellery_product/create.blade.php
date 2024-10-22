
@extends('admin.layout.master')    
@section('main_content')
<!-- Page header -->
@include('admin.layout.breadcrumb')  
<!-- /page header -->

<!-- BEGIN Main Content -->

<!-- Content area -->
<div class="content">

	<div class="panel panel-flat">
		@include('admin.layout._operation_status')
		<div class="panel-heading">
			<h5 class="panel-title">{{$sub_module_title or ''}}</h5>
		</div>

		<div class="panel-body">

			<form class="form-horizontal create-class-form" id="frm_add_jewellery_product" name="frm_add_jewellery_product" action="{{$module_url_path}}/store" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="row">
					<div class="col-md-6">
						<fieldset class="content-group">
							
							<legend class="text-bold">Basic Details :</legend>

							<div class="form-group">
								<label class="control-label col-lg-4" for="site_name">Product Type<i class="red">*</i></label>
								<div class="col-lg-8">
									<select class="form-control" id="product_type" name="product_type" data-rule-required="true" data-msg-required="Please select the product type." onchange="get_category(this)">
										<option value="">Select product type</option>
										<option value="1">Classic</option>
										<option value="2">Luxure</option>
									</select>
									<span class="error_product_type error">{{ $errors->first('product_type') }} </span>
								</div>
							</div>

							<div class="form-group" style="display: none" id="category_block">
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
									<select class="form-control" id="subcategory_name" name="subcategory_name" data-msg-required="Please select the subcategory." onchange="get_product_lines(this)">
										<option value="">Select Sub category</option>
									</select>
									<span class="error_category error">{{ $errors->first('subcategory_name') }} </span>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-lg-4" for="product_name">Product name<i class="red">*</i></label>
								<div class="col-lg-8">
									<input type="text" name="product_name" id="product_name" class="form-control" placeholder="Product Name" data-rule-required="true"  data-rule-maxlength="60" value="{{old('product_name')}}">
									<span class="error">{{ $errors->first('product_name') }} </span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="product_model">Product Code/Model<i class="red">*</i></label>
								<div class="col-lg-8">
									<input type="text" name="product_model" id="product_model" class="form-control" placeholder="Product Code/Model" data-rule-required="true"  data-rule-maxlength="60" value="{{old('product_model')}}">
									<span class="error">{{ $errors->first('product_model') }} </span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="quantity">Quantity<i class="red">*</i></label>
								<div class="col-lg-8">
									<input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity" value="{{old('quantity')}}" data-rule-required="true" data-rule-maxlength="6" data-msg-maxlength="Please enter no more than 6 digits." data-rule-digits="true">
									<span class="error">{{ $errors->first('quantity') }} </span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="product_price">Product Price (In RS.)<i class="red">*</i></label>
								<div class="col-lg-8">
									<input type="text" name="product_price" id="product_price" class="form-control" placeholder="Product Price" data-rule-required="true"  data-rule-maxlength="10" data-rule-pattern="\d+(\.\d{1,2})?" data-msg-pattern="Please enter valid price." data-msg-maxlength="Please enter no more than 10 digits." value="{{old('product_price')}}">
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
										<option value="{{$look['id'] or ''}}">{{$look['look'] or '' }}</option>
										@endforeach
										@endif
									</select>
									<span class="error err_look">{{ $errors->first('look') }} </span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="metal_weight">Metal Weight (in gm)<i class="red">*</i></label>
								<div class="col-lg-8">
									<input type="text" name="metal_weight" id="metal_weight" class="form-control" placeholder="Metal Weight" data-rule-required="true" data-rule-pattern="\d+(\.\d{1,2})?" data-rule-maxlength="6" data-msg-pattern="Please enter valid weight." value="{{old('metal_weight')}}" data-msg-maxlength="Please enter no more than 6 digits.">
									<span class="error">{{ $errors->first('metal_weight') }} </span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="length">Length(In MM)</label>
								<div class="col-lg-8">
									<input type="text" name="length" id="length" class="form-control" placeholder="Length" data-rule-required="false"  data-rule-maxlength="10" value="{{old('length')}}" data-rule-pattern="\d+(\.\d{1,2})?" data-msg-pattern="Please enter valid length." data-msg-maxlength="Please enter no more than 10 digits.">
									<span class="error">{{ $errors->first('length') }} </span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="width">Width(In MM)</label>
								<div class="col-lg-8">
									<input type="text" name="width" id="width" class="form-control" placeholder="Width" data-rule-required="false"  data-rule-maxlength="10" data-msg-maxlength="Please enter no more than 10 digits." value="{{old('width')}}">
									<span class="error">{{ $errors->first('width') }} </span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="height">Height(In MM)</label>
								<div class="col-lg-8">
									<input type="text" name="height" id="height" class="form-control" placeholder="Height" value="{{old('height')}}" data-rule-required="false" data-rule-pattern="\d+(\.\d{1,2})?" data-rule-maxlength="6" data-msg-maxlength="Please enter no more than 6 digits.">
									<span class="error">{{ $errors->first('height') }} </span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="product_description">Product Description<i class="red">*</i></label>
								<div class="col-lg-8">
									<textarea name="product_description" id="product_description" class="form-control" placeholder="Product Description" data-rule-required="true"  data-rule-maxlength="550" rows="3">{{old('product_description')}}</textarea>
									<span class="error">{{ $errors->first('product_description') }} </span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-lg-4" for="product_specification">Product Specification<i class="red">*</i></label>
								<div class="col-lg-8">
									<textarea name="product_specification" id="product_specification" class="form-control" placeholder="Product Specification" data-rule-required="true"  data-rule-maxlength="550" rows="3">{{old('product_specification')}}</textarea>
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
												<input type="file" name="product_image[]" id="product_image" class="product_image" style="display:none" data-rule-required="true" data-msg-required="Please select product image." />
											</div>
											<span class="clearfix"></span>
											<span class="error error_product_img">{{ $errors->first('product_image') }} </span>
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
											<option value="{{$metal['id'] or ''}}">{{$metal['metal_name'] or '' }}</option>
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
											<option value="{{$metal_color['id'] or ''}}">{{$metal_color['metal_color'] or '' }}</option>
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
											<option value="{{$metal_quality['id'] or ''}}">{{$metal_quality['quality_name'] or '' }}</option>
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
											<option value="{{$metal['id'] or ''}}">{{$metal['metal_name'] or '' }}</option>
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
											<option value="{{$metal_color['id'] or ''}}">{{$metal_color['metal_color'] or '' }}</option>
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
											<option value="{{$metal_quality['id'] or ''}}">{{$metal_quality['quality_name'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error">{{ $errors->first('metal_quality_2') }} </span>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-lg-4" for="gemstone_quality_3"></label>
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
											<option value="{{$gemstone['id'] or ''}}">{{$gemstone['type'] or '' }}</option>
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
											<option value="{{$gemstone_color['id'] or ''}}">{{$gemstone_color['gemstone_color'] or '' }}</option>
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
											<option value="{{$gemstone_quality['id'] or ''}}">{{$gemstone_quality['gemstone_quality'] or '' }}</option>
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
											<option value="{{$gemstone_shape['id'] or ''}}">{{$gemstone_shape['shape_name'] or '' }}</option>
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
											<option value="{{$gemstone['id'] or ''}}">{{$gemstone['type'] or '' }}</option>
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
											<option value="{{$gemstone_color['id'] or ''}}">{{$gemstone_color['gemstone_color'] or '' }}</option>
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
											<option value="{{$gemstone_quality['id'] or ''}}">{{$gemstone_quality['gemstone_quality'] or '' }}</option>
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
											<option value="{{$gemstone_shape['id'] or ''}}">{{$gemstone_shape['shape_name'] or '' }}</option>
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
											<option value="{{$gemstone['id'] or ''}}">{{$gemstone['type'] or '' }}</option>
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
											<option value="{{$gemstone_color['id'] or ''}}">{{$gemstone_color['gemstone_color'] or '' }}</option>
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
											<option value="{{$gemstone_quality['id'] or ''}}">{{$gemstone_quality['gemstone_quality'] or '' }}</option>
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
											<option value="{{$gemstone_shape['id'] or ''}}">{{$gemstone_shape['shape_name'] or '' }}</option>
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
											<option value="{{$metal_detailing['id'] or ''}}">{{$metal_detailing['metal_detailing_name'] or '' }}</option>
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
											@foreach($arr_collection as $collection)
											<option value="{{$collection['id'] or ''}}">{{$collection['name'] or '' }}</option>
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
											@foreach($arr_occassion as $occassion)
											<option value="{{$occassion['id'] or ''}}">{{$occassion['occasion_name'] or '' }}</option>
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
										<select class="form-control" id="setting" name="setting">
											<option value="">Select Setting</option>
											@if(isset($arr_setting) && !empty($arr_setting) && is_array($arr_setting))
											@foreach($arr_setting as $setting)
											<option value="{{$setting['id'] or ''}}">{{$setting['setting'] or '' }}</option>
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
											<option value="{{$brand['id'] or ''}}">{{$brand['brand_name'] or '' }}</option>
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
											<option value="{{$band_setting['id'] or ''}}">{{$band_setting['band_setting'] or '' }}</option>
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
											<option value="{{$ring_shoulder_type['id'] or ''}}">{{$ring_shoulder_type['ring_shoulder_type'] or '' }}</option>
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
											<option value="{{$shank['id'] or ''}}">{{$shank['shank_type'] or '' }}</option>
											@endforeach
											@endif
										</select>
										<span class="error err_shank_type">{{ $errors->first('shank_type') }} </span>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-lg-4" for="is_size">Is product has size?</label>
									<div class="col-lg-8">
										<input type="checkbox" name="is_size" id="is_size" placeholder="Width">
									</div>
								</div>

								<div class="form-group size_block" style="display: none">
									<label class="control-label col-lg-4" for="size">Size(In MM)<i class="red">*</i></label>
									<div class="col-lg-8">
										<input type="text" name="size[]" id="size" value="" class="form-control" placeholder="size" data-rule-maxlength="10" data-msg-maxlength="Please enter no more than 10 digits." value="{{old('width')}}">
										<span class="error">{{ $errors->first('size') }} </span>
										<span class="error err_size">{{ $errors->first('size') }} </span>
										<span class="clearfix"></span>
										<a data-toggle="modal" data-target="#modal_form_horizontal" id="btn_open_size_modal">+ Add More</a>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-lg-4" for="video_url">Video URL</label>
									<div class="col-lg-8">
										<input type="text" name="video_url" id="video_url" class="form-control" placeholder="Video URL" data-rule-required="false" pattern="https?://.+" data-msg-pattern="Invalid url. It must be youtube's embeded URL." value="{{old('video_url')}}">
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
											<option value="{{$date or ''}}">{{ isset($date) && !empty($date) ? $date.' days' : '' }}</option>
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
											<input type="radio" data-rule-required="true" data-msg-required="Please select an option." name="home_trial" value="2" >Yes
										</label>
										<label class="radio-inline">
											<input type="radio" data-rule-required="true" name="home_trial" value="1" >No
										</label>
										<span class="clearfix"></span>
										<span class="error err_home_trial">{{ $errors->first('home_trial') }} </span>
									</div>
								</div>

								<div class="form-group text-right">
									<div class="col-lg-7">
										<input type="hidden" id="total_images" name="total_images" value="0">
										<input type="hidden" id="total_size"   name="total_size" value="1">
										<input type="hidden" id="subcategory_slug" name="subcategory_slug">
										<input type="hidden" id="category_slug" name="category_slug">

										<button type="submit" class="btn btn-primary">Add</button>
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
											<input type="text" name="new_size[]" id="new_size" placeholder="Size" class="form-control" onkeypress="return isNumberKey(event)" maxlength="10">
											<span class="error">{{ $errors->first('size') }} </span>
										</div>
										<a onclick="appendSizeDiv()" class="text-right">+ Add</a>
									</div>
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
						else if(name === 'product_image[]')
						{
							error.insertAfter('.error_product_img');
						} 
						else if(name === 'metal[]')
						{
							error.insertAfter('.err_metal');
						} 
						else if(name === 'gemstone_type')
						{
							error.insertAfter('.err_gemstone_type');
						} 
						else if(name === 'size[]')
						{
							error.insertAfter('.err_size');
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

			function get_category(product_type_id)
			{
				var classic_diamond_category_slug = "{{config('app.project.slug.classic_diamond_category_slug')}}";
				var luxure_diamond_category_slug = "{{config('app.project.slug.luxure_diamond_category_slug')}}";

				var product_type_id = $(product_type_id).val();

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

									
									if(obj['slug'] !=  classic_diamond_category_slug && obj['slug'] != luxure_diamond_category_slug)
									{
										categories += "<option value="+obj['id']+" data-slug="+obj['slug']+">"+obj['category_name']+"</option>";
									}

								});

								$("#category_name").html(categories);
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
					$("#product_line_block").hide();

					$('#shank_type_block').hide();
					$('#band_setting_block').hide();
					$('#ring_shoulder_type_block').hide();

				}
			}
			function get_product_lines(sub_category)
			{
				var sub_category_id = sub_category.value;

				var classic_jewellery_rings_sub_category_slug = "{{$classic_jewellery_rings_sub_category_slug or ''}}";

				var classic_fashion_jewellery_rings_sub_category_slug = "{{$classic_fashion_jewellery_rings_sub_category_slug or ''}}";

				var selected_option_slug = $('option:selected', sub_category).attr('data-slug');


				$('#subcategory_slug').val(selected_option_slug);

				// to hide and show ring attributes as per selected sub category.

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

										product_lines += "<option value="+obj['id']+">"+obj['product_line_name']+"</option>";

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

			function load_subcategories()
			{
				var cat_id = $('#category_name').val();

				$('#shank_type_block').hide();
				$('#band_setting_block').hide();
				$('#ring_shoulder_type_block').hide();

				selected_option_slug = $('#category_name').find(':selected').attr('data-slug');

				$('#category_slug').val(selected_option_slug);

				if(cat_id)
				{
					{
						$.ajax({
							url:'{{$module_url_path}}/load_subcategory',
							type:'get',
							data:{category_id:cat_id},
							success:function(data)
							{
								$("#sub_category_block").show();
								$('#subcategory_name').html(data);
							}
						});
					}
				}
				else
				{
					$("#sub_category_block").hide();
					$("#product_line_block").hide();
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
					$('#new_size').val($('#size').val());
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


		