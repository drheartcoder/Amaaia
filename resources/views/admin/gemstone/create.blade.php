
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

							<form class="form-horizontal" id="frm_add_gemstone" name="frm_add_gemstone" action="{{$module_url_path}}/store" method="post">
								{{csrf_field()}}
								<fieldset class="content-group">	
									<div class="form-group">
										<label class="control-label col-lg-2" for="type">Type<i class="red">*</i></label>
										<div class="col-lg-5">
											<input type="text" name="type" id="type" class="form-control" placeholder="Type" data-rule-required="true"  data-rule-maxlength="60" value="{{old('type')}}">
											<span class="error">{{ $errors->first('type') }} </span>
										</div>
									</div>
									
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
    	$('#frm_add_gemstone').validate({
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


			