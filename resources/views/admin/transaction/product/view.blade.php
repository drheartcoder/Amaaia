
@extends('admin.layout.master')    
@section('main_content')
<!-- Page header -->
@include('admin.layout.breadcrumb')  
<!-- /page header -->

<!-- BEGIN Main Content -->

<!-- Content area -->
<div class="content">

	@include('admin.layout._operation_status')

	<?php
		$arr_customer = $arr_product['user_details'];

		if(isset($arr_customer['country_phone_code_id']) && !empty($arr_customer['country_phone_code_id']))
		{
			$arr_phone_code = get_phonecode($arr_customer['country_phone_code_id']);
			$phone_code = isset($arr_phone_code['phonecode']) ? '+'.$arr_phone_code['phonecode'] : '';
		}

	?>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-white">
				<div class="panel-heading">
					<h6 class="panel-title"><i class="icon-cog3 position-left"></i> Customer Details</h6>
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
							{{ $phone_code }}{{ $arr_customer['mobile_number'] or 'NA' }}
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
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Total Amount</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{isset($arr_product['amount'])?$arr_product['amount']:0}}
						</div>
					</div>
					<span class="clearfix"></span>

				</div>

			</div>

		</div>
	</div>
	

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-white">
				<div class="panel-heading">
					<h6 class="panel-title"><i class="icon-cog3 position-left"></i> Transaction Details</h6>
				</div>

				<div class="panel-body">
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Transaction Id</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_product['transaction_id'] or 'NA'}}
						</div>
					</div>
					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Tracking Id</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_product['tracking_id'] or 'NA'}}
						</div>
					</div>

					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Order Id</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_product['order_id'] or 'NA'}}
						</div>
					</div>
					<span class="clearfix"></span>

					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Payment Status</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{ $arr_product['order_status'] or 'NA' }}
						</div>
					</div>
					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Amount</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_product['amount'] or 'NA'}}
						</div>
					</div>
					<span class="clearfix"></span>
				</div>

			</div>

		</div>
	</div>	

	<div class="form-group text-left">
		<a href="javascript:history.back(1)" class="btn btn-primary">Back</a>
	</div>


	@endsection


