
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

			<form class="form-horizontal" id="frm_add_categogry" name="frm_add_categogry" action="{{$module_url_path}}/reply/{{$id}}" method="post">
				{{csrf_field()}}
				<fieldset class="content-group">
					<div class="form-group">
						<label class="control-label col-lg-2" for="occasion_name">Name</label>
						<div class="col-lg-5">
							{{$arr_contact_enquiry['first_name'] or 'NA'}} {{$arr_contact_enquiry['last_name'] or ''}}
						</div>
					</div>	
					<div class="form-group">
						<label class="control-label col-lg-2" for="occasion_name">Email</label>
						<div class="col-lg-5">
							{{$arr_contact_enquiry['email'] or 'NA'}}
						</div>
					</div>	
					<div class="form-group">
						<label class="control-label col-lg-2" for="occasion_name">Contact No</label>
						<div class="col-lg-5">
							{{isset($arr_contact_enquiry['contact_no']) && !empty($arr_contact_enquiry['contact_no']) ? $arr_contact_enquiry['contact_no'] : '-'}}
						</div>
					</div>	
					<div class="form-group">
						<label class="control-label col-lg-2" for="occasion_name">Enquiry message</label>
						<div class="col-lg-5">
							{{$arr_contact_enquiry['message'] or 'NA'}}
						</div>
					</div>	
					<div class="form-group">
						<label class="control-label col-lg-2" for="admin_reply">Reply</label>
						<div class="col-lg-5">
							@if(isset($arr_contact_enquiry['status']) && $arr_contact_enquiry['status'] == '0')
								<textarea name="admin_reply" id="admin_reply" class="form-control" placeholder="Message" data-rule-required="true"  data-rule-maxlength="550"></textarea>
								<span class="error">{{ $errors->first('admin_reply') }} </span>
							@else
								{{$arr_contact_enquiry['admin_reply'] or ''}}
							@endif
						</div>
					</div>
					<div class="form-group text-center">
						<div class="col-lg-7">
							@if(isset($arr_contact_enquiry['status']) && $arr_contact_enquiry['status'] == '0')
								<button type="submit" class="btn btn-primary">Reply</button>
							@endif
							<a href="{{$module_url_path}}" class="btn btn-primary">Back</a>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>

	<script>

		$(document).ready(function(){
			$('#frm_add_categogry').validate({
				ignore: [],
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


