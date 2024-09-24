
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
			<form class="form-horizontal" id="frm_business_details" name="frm_business_details" action="{{url($supplier_panel_slug.'/account_setting/business/update/'.base64_encode($supplier_id))}}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
				
				<fieldset class="content-group">	
					<div class="form-group">
						<label class="control-label col-lg-2" for="business_name">Unique Business name<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="business_name" id="business_name"  class="form-control" placeholder="Unique Business name" data-rule-required="true" data-rule-maxlength="60" value="{{$arr_business_details['business_name'] or ''}}">
							<span class="error">{{ $errors->first('business_name') }} </span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2" for="business_reg_no">Business Registration No.<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="business_reg_no" id="business_reg_no"  class="form-control" placeholder="Business Registration No." data-rule-required="true" data-rule-maxlength="20" data-rule-pattern="^[a-zA-Z\d]+$" data-rule-minlength="6" value="{{$arr_business_details['business_reg_no'] or ''}}">
							<span class="error">{{ $errors->first('business_reg_no') }} </span>
						</div>
					</div>
					 
					<div class="form-group">
						<label class="control-label col-lg-2" for="pan_no">Pan Card No.<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="pan_no" id="pan_no" class="form-control" placeholder="Pan Card No." data-rule-required="true" data-rule-pattern="^[a-zA-Z\d]+$" data-rule-minlength="10" data-rule-maxlength="10" data-msg-minlength="Pan card number must be of 10 digits." data-msg-maxlength="Pan card number must be of 10 digits only." value="{{$arr_business_details['pan_no'] or ''}}">
							<span class="error">{{ $errors->first('pan_no') }} </span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2" for="email">Business Email<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="email" id="email" class="form-control" placeholder="Business Email" data-rule-required="true" data-rule-email value="{{$arr_business_details['email'] or ''}}">
							<span class="error">{{ $errors->first('email') }} </span>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2" for="contact">Business Mobile No.<i class="red">*</i></label>
						<div class="col-lg-2 col-sm-2" >
							<select class="form-control" id="sel1" name="phonecode" data-rule-required="true" data-msg-required="Select the country phone code.">
								@if(isset($arr_phonecode) && is_array($arr_phonecode) && sizeof($arr_phonecode)>0)
								<option value="">Select Phone Code</option>
								@foreach($arr_phonecode as $phonecode)

								<option value="{{isset($phonecode['id'])? base64_encode($phonecode['id']):''}}" @if(isset($arr_business_details['country_phone_code_id']) && $phonecode['id'] == $arr_business_details['country_phone_code_id']) selected="selected" @endif> +{{$phonecode['phonecode'] or ''}} ({{$phonecode['CountryCode'] or ''}})</option>

								@endforeach
								@endif
							</select>
						</div>
						<div class="col-lg-3 col-sm-3">
							<input type="text" name="mobile_number" id="mobile_number" class="form-control" data-rule-required="true" data-rule-pattern="[- +()0-9]+" data-rule-minlength="7" data-rule-maxlength="16" data-msg-minlength="Contact no should be atleast 7 numbers" data-msg-maxlength="Contact no should not be more than 16 numbers" placeholder="Business Mobile No." value="{{$arr_business_details['mobile_number'] or ''}}">
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
			$('#frm_business_details').validate({
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
				}/*,
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

				} */
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


