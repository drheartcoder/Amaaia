
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
			<form class="form-horizontal" id="frm_site_setting" name="frm_site_setting" action="{{url($admin_panel_slug.'/site_setting/update')}}" method="post">
				{{csrf_field()}}
				<fieldset class="content-group">	

					<div class="form-group">
						<label class="control-label col-lg-2" for="site_name">Site Name<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="site_name" id="site_name" onkeyup="chk_validation(this)" class="form-control" placeholder="Site Name" data-rule-required="true" data-rule-maxlength="100" value="{{$arr_site_settings['site_name'] or ''}}">
							<span class="error">{{ $errors->first('site_name') }} </span>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2" for="site_address">Address<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="site_address" id="site_address"  class="form-control" placeholder="Address" data-rule-required="true" data-rule-maxlength="500" value="{{$arr_site_settings['site_address'] or ''}}">
							<span class="error">{{ $errors->first('site_address') }} </span>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2" for="site_email_address">Email<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="site_email_address" id="site_email_address" class="form-control" placeholder="Email" data-rule-required="true" data-rule-email="true" data-rule-maxlength="100" value="{{$arr_site_settings['site_email_address'] or ''}}">
							<span class="error">{{ $errors->first('site_email_address') }} </span>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2" for="site_contact_number">Contact Number<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="site_contact_number" id="site_contact_number" class="form-control" placeholder="Contact Number" data-rule-required="true" data-rule-number="true" data-rule-minlength="8" data-rule-maxlength="12" value="{{$arr_site_settings['site_contact_number'] or ''}}">
							<span class="error">{{ $errors->first('site_contact_number') }} </span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 col-lg-2 control-label">Site Status<i class="red">*</i></label>
						<div class="col-sm-9 col-lg-10 controls">
							<label class="radio-inline">
								<input name="site_status" class="styled" required="" value="1" type="radio" @if(isset($arr_site_settings['site_status']) && $arr_site_settings['site_status']==1) checked="" @endif> Online
							</label>
							<label class="radio-inline">
								<input name="site_status" class="styled" value="0" type="radio" @if(isset($arr_site_settings['site_status']) && $arr_site_settings['site_status']==0) checked="" @endif> Offline
							</label>
							<div class="error err_site_status" id="siteStatusErrorDiv"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2" for="currency_rate">INR To USD Rate<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="currency_rate" id="currency_rate" class="form-control" placeholder="INR per USD" class="form-control" data-rule-required="true" data-rule-maxlength="255" data-rule-pattern="\d+(\.\d{1,2})?" data-msg-pattern="Please enter valid price." value="{{number_format($arr_site_settings['currency_rate'],2)}}">
							<span class="error">{{ $errors->first('currency_rate') }} </span>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2" for="transaction_charges">Transaction charges (in %)<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="transaction_charges" id="transaction_charges" class="form-control" placeholder="Transaction charges" class="form-control" data-rule-required="true"  data-rule-maxlength="5" data-rule-max="99" data-rule-pattern="\d+(\.\d{1,2})?" data-msg-pattern="Please enter valid charges." value="{{$arr_site_settings['transaction_charges'] or ''}}">
							<span class="error">{{ $errors->first('transaction_charges') }} </span>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-lg-2" for="gst">GST (in %)<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="gst" id="gst" class="form-control" placeholder="GST" class="form-control" data-rule-required="true" data-rule-maxlength="5" data-rule-max="99" data-rule-pattern="\d+(\.\d{1,2})?" data-msg-pattern="Please enter valid price." value="{{$arr_site_settings['gst'] or ''}}">
							<span class="error">{{ $errors->first('gst') }} </span>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2" for="product_return_days">Product Return Days<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="product_return_days" id="product_return_days" class="form-control" placeholder="Product Return Days" class="form-control" data-rule-required="true" data-rule-maxlength="5" data-msg-maxlength="Please enter no more than 5 digits." data-rule-pattern="\d+(\d{1,2})?" data-msg-pattern="Please enter valid days." value="{{$arr_site_settings['product_return_days'] or ''}}">
							<span class="error">{{ $errors->first('product_return_days') }} </span>
							<span class="clearfix"></span>
							<i class="red">Note : Maximum days for product available to return. </i>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-lg-2" for="meta_keyword">Meta Keyword<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="meta_keyword" id="meta_keyword" class="form-control" placeholder="Meta Keyword" class="form-control" data-rule-required="true" data-rule-maxlength="255" onkeyup="chk_validation(this)" value="{{$arr_site_settings['meta_keyword'] or ''}}">
							<span class="error">{{ $errors->first('meta_keyword') }} </span>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2" for="meta_description">Meta Description<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="meta_description" id="meta_description" class="form-control" placeholder="Meta Description" data-rule-required="true" data-rule-maxlength="255" value="{{$arr_site_settings['meta_desc'] or ''}}">
							<span class="error">{{ $errors->first('meta_description') }} </span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2" for="facebook_url">Facebook URL<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="facebook_url" id="facebook_url" class="form-control" data-rule-required="true" data-rule-url="true" data-rule-maxlength="500" placeholder="https://facebook.com/" value="{{$arr_site_settings['fb_url'] or ''}}">
							<span class="error">{{ $errors->first('facebook_url') }} </span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2" for="twitter_url">Twitter URL<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="twitter_url" id="twitter_url" class="form-control" data-rule-required="true" data-rule-url="true" data-rule-maxlength="500" placeholder="https://twitter.com/" value="{{$arr_site_settings['twitter_url'] or ''}}">
							<span class="error">{{ $errors->first('twitter_url') }} </span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2" for="google_plus_url">Google+ URL<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="google_plus_url" id="google_plus_url" class="form-control"data-rule-required="true" data-rule-url="true" data-rule-maxlength="500" placeholder="https://www.google.com/" value="{{$arr_site_settings['google_plus_url'] or ''}}">
							<span class="error">{{ $errors->first('google_plus_url') }} </span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2" for="linkedin_url">Linkedin URL<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="linkedin_url" id="linkedin_url" class="form-control" data-rule-required="true" data-rule-url="true" data-rule-maxlength="500" placeholder="https://www.linkedin.com/" value="{{$arr_site_settings['linkedin_url'] or ''}}">
							<span class="error">{{ $errors->first('linkedin_url') }} </span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2" for="instagram_url">Instagram URL<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="instagram_url" id="instagram_url" class="form-control" data-rule-required="true" data-rule-url="true" data-rule-maxlength="500" placeholder="https://www.instagram.com/" value="{{$arr_site_settings['instagram_url'] or ''}}">
							<span class="error">{{ $errors->first('instagram_url') }} </span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2" for="pintrest_url">Pinterest URL<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="pintrest_url" id="pintrest_url" class="form-control" data-rule-required="true" data-rule-url="true" data-rule-maxlength="500" placeholder="https://www.pinterest.com/" value="{{$arr_site_settings['pintrest_url'] or ''}}">
							<span class="error">{{ $errors->first('pintrest_url') }} </span>
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



	<script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY&libraries=places"></script>

	<script src="{{ url('/') }}/web_admin/assets/js/pages/jquery.geocomplete.js"></script>

	<script>

		$(document).ready(function(){
			$("#site_address").geocomplete();
		});


		$(document).ready(function(){
			$('#frm_site_setting').validate({
				ignore: [],
				errorPlacement: function(error, element) 
				{ 
					var name = $(element).attr("name");
					if (name === "site_status") 
					{
						error.insertAfter('.err_site_status');
					} 
					else
					{
						error.insertAfter(element);
					}

				} 
			});
		});

		function chk_validation(ref)
		{
			var yourInput = $(ref).val();
			re = /[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
			var isSplChar = re.test(yourInput);
			if(isSplChar)
			{
				var no_spl_char = yourInput.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
				$(ref).val(no_spl_char);
			}
		}

	</script>

	@endsection


