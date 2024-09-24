
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
							<h5 class="panel-title">{{$module_title or ''}}</h5>
						</div>

						<div class="panel-body">

							<form class="form-horizontal" id="frm_edit_categogry" name="frm_edit_categogry" action="{{url($admin_panel_slug.'/categories/update/'.base64_encode( $category["id"]))}}" method="post">
								{{csrf_field()}}
								<fieldset class="content-group">	
									<div class="form-group">
										<label class="control-label col-lg-2" for="site_name">Product Type<i class="red">*</i></label>
										<div class="col-lg-5">
											<select class="form-control" id="product_type" name="product_type" data-rule-required="true" data-msg-required="Please select the product type.">
													<option value="">Select product type</option>
													<option value="1" {{isset($category['product_type']) && $category['product_type'] == 1 ? 'selected' : ''}} >Classic</option>
													<option value="2" {{isset($category['product_type']) && $category['product_type'] == 2 ? 'selected' : ''}} >Luxure</option>
											</select>
											<span class="error_product_type">{{ $errors->first('product_type') }} </span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2" for="category_name">Category Name<i class="red">*</i></label>
										<div class="col-lg-5">
											<input type="text" name="category_name" id="category_name" class="form-control" placeholder="Category Name" data-rule-required="true"  data-rule-maxlength="60" value="{{$category['category_name'] or ''}}">
											<span class="error">{{ $errors->first('category_name') }} </span>
										</div>
									</div>
									
									
									<div class="form-group text-center">
										<div class="col-lg-7">
											<button type="submit" class="btn btn-primary">Update</button>
										</div>
									</div>
								</fieldset>
								
							</form>
						</div>
					</div>

<script>

    $(document).ready(function(){
    	$('#frm_edit_categogry').validate({
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

  

</script>

@endsection


			