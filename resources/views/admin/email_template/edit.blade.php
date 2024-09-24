
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
											<input type="text" name="template_name" value="{{$arr_email_template['template_name'] or ''}}" id="template_name" class="form-control" placeholder="Template Name" data-rule-required="true"  data-rule-maxlength="60" value="">
											<span class="error">{{ $errors->first('template_name') }} </span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2" for="template_from"> Template From<i class="red">*</i></label>
										<div class="col-lg-5">
											<input type="text" name="template_from" value="{{$arr_email_template['template_from'] or ''}}" id="template_from" class="form-control" placeholder="Template From" data-rule-required="true"  data-rule-maxlength="60" value="">
											<span class="error">{{ $errors->first('template_from') }} </span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2" for="template_from_mail"> Template From Email<i class="red">*</i></label>
										<div class="col-lg-5">
											<input type="text" name="template_from_mail" value="{{$arr_email_template['template_from_mail'] or ''}}" id="template_from_mail" class="form-control" placeholder="Template From Email" data-rule-required="true"  data-rule-email="true" value="">
											<span class="error">{{ $errors->first('template_from_mail') }} </span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2" for="template_subject"> Template Subject<i class="red">*</i></label>
										<div class="col-lg-5">
											<input type="text" name="template_subject" value="{{$arr_email_template['template_subject'] or ''}}" id="template_subject" class="form-control" placeholder="Template Subject" data-rule-required="true"  data-rule-maxlength="60" value="">
											<span class="error">{{ $errors->first('template_subject') }} </span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2" for="template_html"> Template Body<i class="red">*</i></label>
										<div class="col-lg-6">
											<textarea  name="template_html" id="template_html" class="form-control" data-rule-required="true" rows="15">{{$arr_email_template['template_html'] or ''}}</textarea>
											<span class="error err_email_content">{{ $errors->first('template_html') }} </span>

											  @if(isset($arr_variables) && sizeof($arr_variables)>0 && !empty($arr_variables))
				                                <br>
				                                  <i class="red"><span>Please don't change the following variables in the email template body.</span></i>
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
											<a href="javascript:void(0)" name="preview" id="preview"  class="btn btn-primary"><i class="fa fa-eye"></i> Preview</a>
										</div>
									</div>
								</fieldset>
							</form>
							<form id="preview_form"  method="POST" action="{{$module_url_path}}/preview" target="_blank">
								{{csrf_field()}}
				                <input type="hidden" name="preview_html" id="preview_html" required=""> 
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

    	$('#preview').click(function(){

			tinyMCE.triggerSave();

            $('#preview_html').val($('#template_html').val());

            $('#preview_form').submit();
                  
        });

        var preview_rules = new Object();

      	preview_rules['preview_html'] = { required: true };

    	$('#preview_form').validate({
	        ignore: [],
	        rules : preview_rules,
	        errorPlacement: function(error, element) 
	        {
	            $(".err_email_content").html("");
	           
	           	var name = $(element).attr("name");
	            if(name == 'template_html')
	            {
	                error.appendTo($(this).find(".err_email_content"));
	            }
	        }
	      
      	});

      	$('#btn_update_email_template').click(function(){
      		tinyMCE.triggerSave();
      	});

    });


</script>

@endsection


			