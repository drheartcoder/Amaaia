
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
		<div class="col-md-6">
			<div class="panel panel-white">
				<div class="panel-heading">
					<h6 class="panel-title"><i class="icon-cog3 position-left"></i> Personal Details</h6>
				</div>

				<div class="panel-body">
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Profile Picture</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							<div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
								@if(isset($arr_supplier['profile_image']) && !empty($arr_supplier['profile_image']) && File::exists($supplier_profile_image_base_img_path.$arr_supplier['profile_image']))
								<img src="{{$supplier_profile_image_public_img_path.$arr_supplier['profile_image']}}"  style="max-width: 100%;max-height: 100%; line-height: 20px;" class="fileupload-preview">
								@else
								<img src="{{url('/').'/uploads/supplier/default_image/default-profile.png' }}"  style="max-width: 100%; max-height: 100%; line-height: 20px;" class="fileupload-preview">
								@endif
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">First Name</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_supplier['first_name'] or 'NA'}}
						</div>
					</div>
					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Last Name</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_supplier['last_name'] or 'NA'}}
						</div>
					</div>

					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Email</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_supplier['email'] or 'NA'}}
						</div>
					</div>
					<span class="clearfix"></span>

					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Mobile Number</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{ isset($phone_code) && !empty($phone_code) ? '+'.$phone_code : '' }}{{$arr_supplier['mobile_number'] or 'NA'}}
						</div>
					</div>

					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Address</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_supplier['address'] or 'NA'}}
						</div>
					</div>

					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Account Status</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							@if(isset($arr_supplier['status'])  && $arr_supplier['status'] == "0")
							Inactive
							@elseif(isset($arr_supplier['status'])  && $arr_supplier['status'] == "1")
							Active
							@endif
						</div>
					</div>

					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Is Email Verified?</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							@if(isset($arr_supplier['is_email_verified'])  && $arr_supplier['is_email_verified'] == "0")
							No
							@elseif(isset($arr_supplier['is_email_verified'])  && $arr_supplier['is_email_verified'] == "1")
							Yes
							@endif
						</div>
					</div>

					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Admin Verification?</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							@if(isset($arr_supplier['is_admin_verified'])  && $arr_supplier['is_admin_verified'] == "0")
							No
							@elseif(isset($arr_supplier['is_admin_verified'])  && $arr_supplier['is_admin_verified'] == "1")
							Yes
							@endif
						</div>
					</div>

					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Registration Date</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{isset($arr_supplier['created_at']) ? get_formated_created_date($arr_supplier['created_at']) : 'NA'}}
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-white">
				<div class="panel-heading">
					<h6 class="panel-title"><i class="icon-cog3 position-left"></i> Business Details</h6>
				</div>

				<div class="panel-body">
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Business Name</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_supplier['business_details']['business_name'] or 'NA'}}
						</div>
					</div>
					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Business Registration No.</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_supplier['business_details']['business_reg_no'] or 'NA'}}
						</div>
					</div>

					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Business Email</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_supplier['business_details']['email'] or 'NA'}}
						</div>
					</div>
					
					<span class="clearfix"></span>

					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Pan No.</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_supplier['business_details']['pan_no'] or 'NA'}}
						</div>
					</div>

					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Business Mobile No.</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{ isset($business_phone_code) && !empty($business_phone_code) ? '+'.$business_phone_code : '' }}{{$arr_supplier['business_details']['mobile_number'] or 'NA'}}
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-white">
				<div class="panel-heading">
					<h6 class="panel-title"><i class="icon-cog3 position-left"></i> Financial Details</h6>
				</div>

				<div class="panel-body">
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Bank Name</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_supplier['financial_details']['bank_name'] or 'NA'}}
						</div>
					</div>
					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Branch Name</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_supplier['financial_details']['branch'] or 'NA'}}
						</div>
					</div>

					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Account Holder Name</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_supplier['financial_details']['account_holder_name'] or 'NA'}}
						</div>
					</div>
					<span class="clearfix"></span>

					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Account No.</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_supplier['financial_details']['account_number'] or 'NA'}}
						</div>
					</div>

					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">IFSC Code</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_supplier['financial_details']['ifsc_code'] or 'NA'}}
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-white">
				<div class="panel-heading">
					<h6 class="panel-title"><i class="icon-cog3 position-left"></i> Website Commission</h6>
				</div>

				<div class="panel-body">
					<form class="form-horizontal" id="frm_commission" name="frm_commission" action="{{$module_url_path}}/commission/store" method="post">
						{{csrf_field()}}
						<fieldset class="content-group">	
							<div class="form-group">
								<label class="control-label col-lg-3" for="commission">Commission (In %)<i class="red">*</i></label>
								<div class="col-lg-9">
									<input type="text" name="commission" id="commission" class="form-control" placeholder="Commission (In %)" data-rule-required="true"  data-rule-maxlength="10" data-rule-pattern="\d+(\.\d{1,2})?" value="{{$arr_supplier['admin_commission'] or ''}}">
									<span class="error">{{ $errors->first('commission') }} </span>
								</div>
							</div>
							<div class="form-group text-center">
								<div class="col-lg-7">
									<input type="hidden" name="enc_id" value="{{$enc_id or ''}}">
									<button type="submit" class="btn btn-primary">Save</button>
								</div>
							</div>
						</fieldset>
					</form>									
				</div>
			</div>

			<div class="form-group text-right">
				<a href="javascript:history.back(1)" class="btn btn-primary">Back</a>
			</div>


		</div>
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


