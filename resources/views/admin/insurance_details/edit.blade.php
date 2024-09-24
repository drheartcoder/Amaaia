
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

		<form class="form-horizontal" id="frm_add_categogry" name="frm_add_categogry" action="{{$form_url_path}}/update/{{$id}}" method="post">
				{{csrf_field()}}
				<fieldset class="content-group">	
					<div class="form-group">
						<label class="control-label col-lg-2" for="company_name">Company Name<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="company_name" value="{{$arr_company['company_name'] or ''}}" id="company_name" class="form-control" placeholder="Company Name" data-rule-required="true"  data-rule-maxlength="60" value="">
							<span class="error">{{ $errors->first('company_name') }} </span>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2" for="insurance_amount">Insurance Amount (%)<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="insurance_amount" id="insurance_amount" value="{{$arr_company['price'] or ''}}" class="form-control" placeholder="Insurance Amount" data-rule-required="true" data-rule-required="true"  data-rule-maxlength="5" data-rule-max="99" data-rule-pattern="\d+(\.\d{1,2})?" data-msg-pattern="Please enter valid percentage." data-msg-maxlength="Please enter no more than 5 digits.">
							<span class="error">{{ $errors->first('insurance_amount') }} </span>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2" for="description">Insurance Details{{-- <i class="red">*</i> --}}</label>
						<div class="col-lg-5">
							<textarea class="form-control" placeholder="Insurance Details" name="description" id="description">{{$arr_company['description'] or ''}}</textarea>
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
			$('#frm_add_categogry').validate({
				highlight: function(element) { },
			});
		});


	</script>
	<script src="{{url('web_admin/assets\tinymce\js\tinymce/jquery.tinymce.min.js')}}"></script>
<script src="{{url('web_admin/assets\tinymce\js\tinymce/tinymce.min.js')}}"></script>
<script>tinymce.init({ selector:'#description' });</script>
	@endsection


