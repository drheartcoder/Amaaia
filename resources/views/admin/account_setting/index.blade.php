
@extends('admin.layout.master')    
@section('main_content')
 <!-- Page header -->
         @include('admin.layout.breadcrumb')  
<!-- /page header -->

<!-- BEGIN Main Content -->

	<!-- Content area -->
	<div class="content">
		<div class="row">
			
			@include('admin.layout._operation_status')

			<div class="col-md-7">

				<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title">{{$module_title or ''}}</h5>
				</div>

				<div class="panel-body">
					<form class="form-horizontal" id="frm_account_setting" name="frm_account_setting" action="{{url($admin_panel_slug.'/account_setting/update')}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
						<fieldset class="content-group">
						  	<div class="form-group">
			                	<label class="col-sm-3 col-lg-2 control-label">Profile Image<i class="red">*</i></label>
				                <div class="col-sm-9 col-lg-10 controls">
				                    <div class="fileupload fileupload-new" data-provides="fileupload">
				                    	@php $is_profile_image_required = $prev_image_url = ""; @endphp
				                        <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
					                        @if(isset($arr_admin_details['profile_image']) && !empty($arr_admin_details['profile_image']) && File::exists($profile_image_base_img_path.$arr_admin_details['profile_image']))
					                            <img src="{{$profile_image_public_img_path.$arr_admin_details['profile_image']}}"  style="max-width: 100%; max-height: 100%; line-height: 20px;" class="fileupload-preview">
					                            @php 
					                            	$prev_image_url = $profile_image_public_img_path.$arr_admin_details['profile_image']; 
					                            	$is_profile_image_required = false; 
					                            @endphp
					                        @else
					                            <img src="{{url('/').'/uploads/admin/default_image/default-profile.png' }}"  style="max-width: 100%; max-height: 100% line-height: 20px;" class="fileupload-preview">
					                            @php 
					                            	$is_profile_image_required = true;
					                            	$prev_image_url = url('/').'/uploads/admin/default_image/default-profile.png';
					                            @endphp
					                        @endif
				                        </div>
					                    <div style="padding-top: 10px;">
				                            <span class="btn btn-default btn-file" style="height:32px;">
					                            <span class="fileupload-new">Select Image</span>
					                            <input type="file"  data-validation-allowing="jpg, png, gif" class="file-input news-image validate-image" name="profile_image" id="image"  {{$is_profile_image_required == true ? 'data-rule-required=true' : ''}} data-msg-required="Please select profile image."><br>
						                        <input type="hidden" name="oldimage" id="oldimage"  
						                            value="{{ $arr_admin_details['profile_image']  or ''}}"/>
						                       
						                        <input type="hidden" name="prev_image_url" id="prev_image_url"  
						                            value="{{$prev_image_url or ''}}"/>
					                        </span>

					                        <a href="javascript:void(0)" id="remove" class="btn btn-default fileupload-exists" data-dismiss="fileupload" style="display: none">Remove</a>
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
									<input type="text" name="first_name" id="first_name"  class="form-control" placeholder="First Name" data-rule-required="true" data-rule-maxlength="60" value="{{$arr_admin_details['first_name'] or ''}}">
									<span class="error">{{ $errors->first('first_name') }} </span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-2" for="last_name">Last Name<i class="red">*</i></label>
								<div class="col-lg-5">
									<input type="text" name="last_name" id="last_name"  class="form-control" placeholder="Last Name" data-rule-required="true" data-rule-maxlength="60" value="{{$arr_admin_details['last_name'] or ''}}">
									<span class="error">{{ $errors->first('last_name') }} </span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-2" for="user_name">Username<i class="red">*</i></label>
								<div class="col-lg-5">
									<input type="text" name="user_name" id="user_name" class="form-control" placeholder="Username" class="form-control" data-rule-required="true" data-rule-alphanumeric="true" data-rule-maxlength="60" value="{{$arr_admin_details['user_name'] or ''}}">
									<span class="error">{{ $errors->first('user_name') }} </span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-2" for="email">Email<i class="red">*</i></label>
								<div class="col-lg-5">
									<input type="text" name="email" id="email" class="form-control" placeholder="Email" data-rule-required="true" data-rule-email value="{{$arr_admin_details['email'] or ''}}">
									<span class="error">{{ $errors->first('email') }} </span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-2" for="contact">Contact Number<i class="red">*</i></label>
								<div class="col-lg-5">
									<input type="text" name="contact" id="contact" class="form-control" data-rule-required="true" data-rule-pattern="[- +()0-9]+" data-rule-minlength="7" data-rule-maxlength="16" data-msg-minlength="Contact no should be atleast 7 numbers" data-msg-maxlength="Contact no should not be more than 16 numbers" placeholder="Contact Number" value="{{$arr_admin_details['contact'] or ''}}">
									<span class="error">{{ $errors->first('contact') }} </span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-2" for="address">Address<i class="red">*</i></label>
								<div class="col-lg-5">
									<input type="text" name="address" id="address" class="form-control" data-rule-required="true" data-rule-maxlength="255" placeholder="Address" value="{{$arr_admin_details['address'] or ''}}">
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

		</div>


		<div class="col-md-5">
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title"><i class="fa fa-university"></i> Financial Details</h6>
				</div>

				<div class="panel-body">

					<form class="form-horizontal" id="frm_bank_account" name="frm_bank_account" action="{{url($admin_panel_slug.'/account_setting/bank/update')}}" method="post">
						{{csrf_field()}}

						<span class="clearfix"></span>

						<div class="form-group">
							<label class="control-label col-lg-6 col-md-6 col-md-6 col-xs-6">Bank Name</label>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<input type="text" name="bank_name" id="bank_name" placeholder="Bank Name" value="{{$arr_bank_details['bank_name'] or ''}}" class="form-control" data-rule-maxlength="60" data-rule-required="true" />
								<span class="error">{{ $errors->first('bank_name') }} </span>
							</div>
						</div>

						<span class="clearfix"></span>
						<div class="form-group">
							<label class="control-label col-lg-6 col-md-6 col-md-6 col-xs-6">Branch</label>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<input type="text" name="branch" id="branch" placeholder="Branch" value="{{$arr_bank_details['branch'] or ''}}" class="form-control" data-rule-maxlength="60" data-rule-required="true" />
								<span class="error">{{ $errors->first('branch') }} </span>
							</div>
						</div>

						<span class="clearfix"></span>
						<div class="form-group">
							<label class="control-label col-lg-6 col-md-6 col-md-6 col-xs-6">Account Holder Name</label>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<input type="text" name="account_holder_name" id="account_holder_name" placeholder="Account Holder Name" value="{{$arr_bank_details['account_holder_name'] or ''}}" class="form-control" data-rule-maxlength="60" data-rule-required="true" />
								<span class="error">{{ $errors->first('account_holder_name') }} </span>
							</div>
						</div>
						<span class="clearfix"></span>

						<div class="form-group">
							<label class="control-label col-lg-6 col-md-6 col-md-6 col-xs-6">Account No.</label>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<input type="text" name="account_number" id="account_number" placeholder="Account No." value="{{$arr_bank_details['account_number'] or ''}}" class="form-control" data-rule-maxlength="20" data-msg-maxlength="Please enter no more than 20 digits." data-rule-required="true" />
							<span class="error">{{ $errors->first('account_number') }} </span>
							</div>
						</div>
						<span class="clearfix"></span>
						<div class="form-group">
							<label class="control-label col-lg-6 col-md-6 col-md-6 col-xs-6">IFSC Code</label>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<input type="text" name="ifsc_code" id="ifsc_code" placeholder="IFSC Code" value="{{$arr_bank_details['ifsc_code'] or ''}}" class="form-control" data-rule-maxlength="60" data-rule-required="true" />
								<span class="error">{{ $errors->first('ifsc_code') }} </span>
							</div>
						</div>

						<button type="submit" class="btn btn-primary">Update</button>

					</form>

				</div>
			</div>

		</div>

	</div>



<script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY&libraries=places"></script>

<script src="{{ url('/') }}/web_admin/assets/js/pages/jquery.geocomplete.js"></script>

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
    	$('#frm_bank_account').validate({
    		ignore: [],
    		highlight: function(element) { },
    		rules: { },
			messages: { },
			errorPlacement: function(error, element) 
			{ 
				var name = $(element).attr("name");
				error.insertAfter(element);
			} 
    	});

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


			