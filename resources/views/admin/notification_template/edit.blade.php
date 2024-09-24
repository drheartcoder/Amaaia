
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

							<form class="form-horizontal" id="frm_edit_email_template" name="frm_edit_email_template" action="{{$module_url_path}}/update/{{$id}}" method="post">
								{{csrf_field()}}
								<fieldset class="content-group">	
									<div class="form-group">
										<label class="control-label col-lg-2" for="template_name"> Template Name<i class="red">*</i></label>
										<div class="col-lg-5">
											<input type="text" name="template_name" value="{{$arr_notification_template['template_name'] or ''}}" id="template_name" class="form-control" placeholder="Template Name" data-rule-required="true"  data-rule-maxlength="60" value="">
											<span class="error">{{ $errors->first('template_name') }} </span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2" for="template_html"> Template Body<i class="red">*</i></label>
										<div class="col-lg-6">
											<textarea  name="template_html" id="template_html" class="form-control" data-rule-required="true" rows="15">{{$arr_notification_template['template_html'] or ''}}</textarea>
											<span class="error err_email_content">{{ $errors->first('template_html') }} </span>

											  @if(isset($arr_variables) && sizeof($arr_variables)>0 && !empty($arr_variables))
				                                <br>
				                                  <i class="red"><span>Please don't change the following variables in the notification template body.</span></i>
				                                  <br>
				                                  <span> Variables: </span>
				                                
				                                  @foreach($arr_variables as $variable)
				                                      <br> <label> {{ $variable }} </label> 
				                                  @endforeach
				                                @endif
										</div>
									</div>
									
									<div class="form-group text-center">
										<div class="col-lg-7">
											<button type="submit" class="btn btn-primary" id="btn_update_email_template">Update</button>
										</div>
									</div>
								</fieldset>
							</form>
						</div>
					</div>

<script src="{{url('web_admin/assets\tinymce\js\tinymce/jquery.tinymce.min.js')}}"></script>
<script src="{{url('web_admin/assets\tinymce\js\tinymce/tinymce.min.js')}}"></script>

<script>tinymce.init({ selector:'#template_html' });</script>

<script>

    $(document).ready(function(){
    	$('#frm_edit_email_template').validate({
    		highlight: function(element) { },
    		ignore: [],
    	});


      	$('#btn_update_email_template').click(function(){
      		tinyMCE.triggerSave();
      	});

    });


</script>

@endsection


			