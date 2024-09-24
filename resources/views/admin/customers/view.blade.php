
@extends('admin.layout.master')    
@section('main_content')
<!-- Page header -->
@include('admin.layout.breadcrumb')  
<!-- /page header -->

<!-- BEGIN Main Content -->

<!-- Content area -->
<div class="content">

	@include('admin.layout._operation_status')

	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-white">
				<div class="panel-heading">
					<h6 class="panel-title"><i class="icon-cog3 position-left"></i> Personal Details</h6>
				</div>

				<div class="panel-body">
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Profile Picture</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							<div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
								@if(isset($arr_customer['profile_image']) && !empty($arr_customer['profile_image']) && File::exists($user_profile_image_base_path.$arr_customer['profile_image']))
								<img src="{{$user_profile_image_public_path.$arr_customer['profile_image']}}"  style="max-width: 100%;max-height: 100%; line-height: 20px;" class="fileupload-preview">
								@else
								<img src="{{url('/').'/uploads/supplier/default_image/default-profile.png' }}"  style="max-width: 100%; max-height: 100%; line-height: 20px;" class="fileupload-preview">
								@endif
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">First Name</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_customer['first_name'] or 'NA'}}
						</div>
					</div>
					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Last Name</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_customer['last_name'] or 'NA'}}
						</div>
					</div>

					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Email</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_customer['email'] or 'NA'}}
						</div>
					</div>
					<span class="clearfix"></span>

					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Mobile Number</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{ isset($phone_code) && !empty($phone_code) ? '+'.$phone_code : '' }}{{$arr_customer['mobile_number'] or 'NA'}}
						</div>
					</div>
					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Address</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_customer['address'] or 'NA'}}
						</div>
					</div>

					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Account Status</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							@if(isset($arr_customer['status'])  && $arr_customer['status'] == "0")
							Inactive
							@elseif(isset($arr_customer['status'])  && $arr_customer['status'] == "1")
							Active
							@endif
						</div>
					</div>

					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Is Email Verified?</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							@if(isset($arr_customer['is_email_verified'])  && $arr_customer['is_email_verified'] == "0")
							No
							@elseif(isset($arr_customer['is_email_verified'])  && $arr_customer['is_email_verified'] == "1")
							Yes
							@endif
						</div>
					</div>

					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Registration Date</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{isset($arr_customer['created_at']) ? get_formated_created_date($arr_customer['created_at']) : 'NA'}}
						</div>
					</div>
				</div>

			</div>

		</div>

		<div class="col-md-4">
			<div class="panel panel-white">
				<div class="panel-heading">
					<h6 class="panel-title"><i class="fa fa-university"></i> Financial Details</h6>
				</div>

				<div class="panel-body">

					<span class="clearfix"></span>

					<div class="form-group">
						<label class="control-label col-lg-6 col-md-6 col-md-6 col-xs-6">Bank Name</label>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							{{$arr_bank_details['bank_name'] or 'NA'}}
						</div>
					</div>

					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-6 col-md-6 col-md-6 col-xs-6">Branch</label>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							{{$arr_bank_details['branch'] or 'NA'}}
						</div>
					</div>

					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-6 col-md-6 col-md-6 col-xs-6">Account Holder Name</label>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							{{$arr_bank_details['account_holder_name'] or 'NA'}}
						</div>
					</div>
					<span class="clearfix"></span>

					<div class="form-group">
						<label class="control-label col-lg-6 col-md-6 col-md-6 col-xs-6">Account No.</label>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						{{$arr_bank_details['account_number'] or 'NA'}}
						</div>
					</div>
					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-6 col-md-6 col-md-6 col-xs-6">IFSC Code</label>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							{{$arr_bank_details['ifsc_code'] or 'NA'}}
						</div>
					</div>

				</div>
			</div>

		</div>

		
	</div>
	<div class="form-group text-left">
		<a href="javascript:history.back(1)" class="btn btn-primary">Back</a>
	</div>

	


	<script>

		$(document).ready(function(){
			$('#frm_commission').validate({
				ignore: [],
				highlight: function(element) { }
			});
		});


	</script>

	@endsection


