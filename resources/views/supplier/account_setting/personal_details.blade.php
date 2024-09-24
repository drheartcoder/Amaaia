
@extends('supplier.layout.master')    
@section('main_content')
<!-- Page header -->
@include('supplier.layout.breadcrumb')  
<!-- /page header -->

<!-- BEGIN Main Content -->

<!-- Content area -->
<div class="content">

	<div class="panel panel-flat">
		@include('supplier.layout._operation_status')
		<div class="panel-heading">
			<h5 class="panel-title">{{$sub_module_title or ''}}</h5>
		</div>

		<div class="panel-body">
			<form class="form-horizontal" id="frm_account_setting" name="frm_account_setting" action="{{url($supplier_panel_slug.'/account_setting/personal/update/'.base64_encode($shared_supplier_details['id']))}}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
				<fieldset class="content-group">
					<div class="form-group">
						<label class="col-sm-3 col-lg-2 control-label">Profile Image<i class="red">*</i></label>
						<div class="col-sm-9 col-lg-10 controls">
							<div class="fileupload fileupload-new" data-provides="fileupload">
								@php $is_profile_image_required = $prev_image_url = ""; @endphp
								<div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
									@if(isset($shared_supplier_details['profile_image']) && !empty($shared_supplier_details['profile_image']) && File::exists($profile_image_base_img_path.$shared_supplier_details['profile_image']))
									<img src="{{$profile_image_public_img_path.$shared_supplier_details['profile_image']}}"  style="max-width: 100%;max-height: 100%; line-height: 20px;" class="fileupload-preview">
									@php 
									$prev_image_url = $profile_image_public_img_path.$shared_supplier_details['profile_image']; 
									$is_profile_image_required = false; 
									@endphp
									@else
									<img src="{{url('/').'/uploads/supplier/default_image/default-profile.png' }}"  style="max-width: 100%; max-height: 100%; line-height: 20px;" class="fileupload-preview">
									@php 
									$is_profile_image_required = true;
									$prev_image_url = url('/').'/uploads/supplier/default_image/default-profile.png';
									@endphp
									@endif
								</div>
								<div>
									<span class="btn btn-default btn-file" style="margin-top: 10px;height:32px;">
										<span class="fileupload-new">Select Image</span>
										<input type="file"  data-validation-allowing="jpg, png, gif" class="file-input news-image validate-image" name="profile_image" id="image"  {{$is_profile_image_required == true ? 'data-rule-required=true' : ''}} data-msg-required="Please select profile image."><br>
										<input type="hidden" name="oldimage" id="oldimage"  
										value="{{ $shared_supplier_details['profile_image']  or ''}}"/>

										<input type="hidden" name="prev_image_url" id="prev_image_url"  
										value="{{$prev_image_url or ''}}"/>
									</span>

									<a href="javascript:void(0)" id="remove" class="btn btn-default fileupload-exists" data-dismiss="fileupload" style="display: none; margin-top: 10px;height:32px;">Remove</a>
								</div>
								<i class="red"> {!! image_validate_note(250,250,'account_setting') !!} </i>
								<div id="file-upload-error" class="err_image"></div>
								<span for="image" id="err-image" class="help-block">{{ $errors->first('image') }}</span>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-sm-6 col-lg-5 control-label help-block-red" style="color:#b94a48;" id="err_logo"></div>
						<br/>
						<div class="col-sm-6 col-lg-5 control-label help-block-green" style="color:#468847;" id="success_logo"></div>
					</div>
				</fieldset>
				<fieldset class="content-group">	
					<div class="form-group">
						<label class="control-label col-lg-2" for="first_name">First Name<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="first_name" id="first_name"  class="form-control" placeholder="First Name" data-rule-required="true" data-rule-maxlength="60" data-rule-pattern="^[a-zA-Z]+$" value="{{$shared_supplier_details['first_name'] or ''}}">
							<span class="error">{{ $errors->first('first_name') }} </span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2" for="last_name">Last Name<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="last_name" id="last_name"  class="form-control" placeholder="Last Name" data-rule-required="true" data-rule-maxlength="60" data-rule-pattern="^[a-zA-Z]+$" value="{{$shared_supplier_details['last_name'] or ''}}">
							<span class="error">{{ $errors->first('last_name') }} </span>
						</div>
					</div>
					 
					<div class="form-group">
						<label class="control-label col-lg-2" for="email">Email<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="email" id="email" class="form-control" placeholder="Email" data-rule-required="true" data-rule-email="true" value="{{$shared_supplier_details['email'] or ''}}">
							<span class="error">{{ $errors->first('email') }} </span>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2" for="contact">Contact Number<i class="red">*</i></label>
						<div class="col-lg-2 col-sm-2" >
							<select class="form-control" id="sel1" name="phonecode" style=" padding: 8px;">
								@if(isset($arr_phonecode) && is_array($arr_phonecode) && sizeof($arr_phonecode)>0)
								@foreach($arr_phonecode as $phonecode)

								<option value="{{isset($phonecode['id'])? base64_encode($phonecode['id']):''}}" @if($phonecode['id'] == $shared_supplier_details['country_phone_code_id']) selected="selected" @endif>+{{$phonecode['phonecode'] or ''}} ({{$phonecode['CountryCode'] or ''}})</option>

								@endforeach
								@endif
							</select>
						</div>
						<div class="col-lg-3 col-sm-3">
							<input type="text" name="contact" id="contact" class="form-control" data-rule-required="true" data-rule-pattern="[- +()0-9]+" data-rule-minlength="7" data-rule-maxlength="16" data-msg-minlength="Contact no should be atleast 7 numbers" data-msg-maxlength="Contact no should not be more than 16 numbers" placeholder="Contact Number" value="{{$shared_supplier_details['mobile_number'] or ''}}">
						</div>

					</div>
					<div class="form-group">
						<label class="control-label col-lg-2" for="address">Address<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="address" id="address" class="form-control" data-rule-required="true" data-rule-maxlength="255" placeholder="Address" value="{{$shared_supplier_details['address'] or ''}}">
							<span class="error">{{ $errors->first('address') }} </span>
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

	<script src="{{ url('/') }}/web_supplier/assets/js/pages/jquery.geocomplete.js"></script>

	<script>

		$(document).ready(function(){
			$("#address").geocomplete();
		});

		$(document).on("change",".validate-image", function()
		{        
			var file=this.files;
			validateImage(this.files, 250,250);
		});

		$(document).on("click","#remove", function()
		{   
			removeFile();
		});



		$(document).ready(function(){
			$('#frm_account_setting').validate({
				ignore: [],
				highlight: function(element) { },
				rules: {
					email: {
						required: true,
						email: true,
						pattern: /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/
					}
				},
				messages: {
					email: {
						pattern: "Please enter a valid email address.",

					},
				},
				errorPlacement: function(error, element) 
				{ 
					var name = $(element).attr("name");
					if (name === "profile_image") 
					{
						error.insertAfter('.err_image');
					} 
					else if(name ==="contact")
					{
						error.insertAfter(element);
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




