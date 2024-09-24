
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
			<form class="form-horizontal" id="frm_add_product_line" name="frm_add_product_line" action="{{$module_url_path}}/store" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
				<fieldset class="content-group">
					<div class="form-group">
						<label class="control-label col-lg-2" for="site_name">Product Type<i class="red">*</i></label>
						<div class="col-lg-5">
						<select class="form-control" id="product_type" name="product_type" data-rule-required="true" data-msg-required="Please select the product type." onchange="load_categories()">
								<option value="">Select product type</option>
								<option value="1" {{ old('product_type') == 1 ? 'selected' : ''}}>Classic</option>
								<option value="2" {{ old('product_type') == 2 ? 'selected' : ''}}>Luxure</option>
							</select>
							<span class="error_product_type error">{{ $errors->first('product_type') }} </span>
						</div>
					</div>
					<div class="form-group" id="category_block">
						<label class="control-label col-lg-2" for="site_name">Category<i class="red">*</i></label>
						<div class="col-lg-5">
							<select class="form-control" id="category_name" name="category_name" data-rule-required="true" data-msg-required="Please select the product type." onchange="load_subcategories()">
								<option value="">Select Category</option>
								<option value="">Select Product Type First</option>
							</select>
							<span class="error_category error">{{ $errors->first('category_name') }} </span>
						</div>
					</div>

					<div class="form-group" id="category_block">
						<label class="control-label col-lg-2" for="site_name">Subcategory<i class="red">*</i></label>
						<div class="col-lg-5">
							<select class="form-control" id="subcategory_name" name="subcategory_name" data-rule-required="true" data-msg-required="Please select the subcategory.">
								<option value="">Select Subcategory</option>
								<option value="">Select Category First</option>
							</select>
							<span class="error_category error">{{ $errors->first('subcategory_name') }} </span>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2" for="product_line_name">Product Line<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="product_line_name" id="product_line_name" class="form-control" placeholder="Product Line" data-rule-required="true"  data-rule-maxlength="60" value="">
							<span class="error">{{ $errors->first('product_line_name') }} </span>
						</div>
					</div>

					{{-- <div class="form-group">
										<label class="col-sm-3 col-lg-2 control-label">Icon<i class="red">*</i></label>
										<div class="col-sm-9 col-lg-10 controls">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												@php $image_required = $prev_image_url = ""; @endphp
												<div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
													@if(isset($arr_sub_category['image']) && !empty($arr_sub_category['image']) && File::exists($sub_category_image_base_path.$arr_sub_category['image']))
													<img src="{{$sub_category_image_public_path.$arr_sub_category['image']}}"  style="max-width: 100%; max-height: 100%; line-height: 20px;" class="fileupload-preview">
													@php 
													$prev_image_url = $sub_category_image_public_path.$arr_sub_category['image']; 
													$image_required = false; 
													@endphp
													@else
													<img src="{{url('/').'/uploads/sub_category/no_image.png' }}"  style="max-width: 100%; max-height: 100%; line-height: 20px;" class="fileupload-preview">
													@php 
													$image_required = true;
													$prev_image_url = url('/').'/uploads/sub_category/no_image.png';
													@endphp
													@endif
												</div>

												<div>
													<span class="btn btn-default btn-file" style="height:32px;">
														<span class="fileupload-new">Select Image</span>
														<input type="file"  data-validation-allowing="jpg, png, gif" class="file-input news-image validate-image" name="image" id="image" {{$image_required == true ? 'data-rule-required=true' : ''}} data-msg-required="Please select card image."><br>
														<input type="hidden" name="oldimage" id="oldimage"  
														value="{{ $sub_category['image']  or ''}}"/>

														<input type="hidden" name="prev_image_url" id="prev_image_url"  
														value="{{$prev_image_url or ''}}"/>
													</span>

													<a href="javascript:void(0)" id="remove" class="btn btn-default fileupload-exists" data-dismiss="fileupload" style="display: none">Remove</a>
												</div>

												<i class="red"> {!! image_validate_note(80,100,'account_setting') !!} </i>
												<div id="file-upload-error" class="err_image"></div>
												<span for="image" id="err-image" class="help-block error">{{ $errors->first('image') }}</span>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="col-sm-6 col-lg-5 control-label help-block-red" style="color:#b94a48;" id="err_logo"></div>
										<div class="col-sm-6 col-lg-5 control-label help-block-green" style="color:#468847;" id="success_logo"></div>
									</div> --}}
					<div class="form-group text-center">
						<div class="col-lg-7">
							<button type="submit" class="btn btn-primary">Add</button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>

	<script>
		$(document).ready(function(){
			$('#frm_add_product_line').validate({
				ignore: [],
				highlight: function(element) { },
				errorPlacement: function(error, element) 
				{ 
					var name = $(element).attr("name");
					if (name === "product_type") 
					{
						error.insertAfter('.error_product_type');
					} 
					else
					{
						error.insertAfter(element);
					}
				} 
			});
		});

		function load_categories()
		{

			var product_type = $('#product_type').val();
			if(product_type)
			{
				{
					$.ajax({
						url:'{{$module_url_path}}/load_category',
						type:'get',
						data:{product_type:product_type},
						success:function(data)
						{
							$('#category_name').html(data);
						}
					});

				}
			}
		}

		function load_subcategories()
		{

			var cat_id = $('#category_name').val();
			if(cat_id)
			{
				{
					$.ajax({
						url:'{{$module_url_path}}/load_subcategory',
						type:'get',
						data:{category_id:cat_id},
						success:function(data)
						{
							$('#subcategory_name').html(data);
						}
					});

				}
			}
		}
		$(document).on("change",".validate-image", function()
	    {        
	        var file=this.files;
	        validateImage(this.files, 80,100);
	    });

	    $(document).on("click","#remove", function()
	    {   
	        removeFile();
	    });

		</script>

		@endsection


