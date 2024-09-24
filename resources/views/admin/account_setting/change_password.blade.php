
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
							<form class="form-horizontal" id="frm_change_password" name="frm_change_password" action="{{url($admin_panel_slug.'/password/update')}}" method="post">
								{{csrf_field()}}
								<fieldset class="content-group">	
									<div class="form-group">
										<label class="control-label col-lg-2" for="current_password">Current Password<i class="red">*</i></label>
										<div class="col-lg-5">
											<input type="password" name="current_password" id="current_password" class="form-control" placeholder="Current Password" data-rule-required="true" data-rule-minlength="6" data-rule-maxlength="16" data-rule-pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])(?=.*\d).*" data-msg-pattern="Password must contain at least (1) lowercase, (1) uppercase, (1) special character, (1) letter.">
											<span class="error">{{ $errors->first('current_password') }} </span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2" for="new_password">New Password<i class="red">*</i></label>
										<div class="col-lg-5">
											<input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" data-rule-required="true" data-rule-minlength="6" data-rule-maxlength="16" data-rule-pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])(?=.*\d).*" data-msg-pattern="Password must contain at least (1) lowercase, (1) uppercase, (1) special character, (1) letter.">
											<span class="error">{{ $errors->first('new_password') }} </span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2" for="confirm_password">Confirm New Password<i class="red">*</i></label>
										<div class="col-lg-5">
											<input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm New Password" data-rule-required="true" data-rule-equalto="#new_password" data-rule-maxlength="16" data-rule-pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])(?=.*\d).*" data-msg-pattern="Password must contain at least (1) lowercase, (1) uppercase, (1) special character, (1) letter.">
											<span class="error">{{ $errors->first('confirm_password') }} </span>
										</div>
									</div>

									<div class="form-group text-center">
										<div class="col-lg-7">
											<button type="submit" class="btn btn-primary">Save</button>
										</div>
									</div>
								</fieldset>
								
							</form>
						</div>
					</div>




<script>
    $(document).ready(function(){
    	$('#frm_change_password').validate({
    		highlight: function(element) { }
    	});
    });
</script>

@endsection


			