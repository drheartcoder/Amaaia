
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
			<form class="form-horizontal" id="frm_financial_details" name="frm_financial_details" action="{{url($supplier_panel_slug.'/account_setting/financial/update/'.base64_encode($supplier_id))}}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
				
				<fieldset class="content-group">	
					<div class="form-group">
						<label class="control-label col-lg-2" for="bank_name">Bank Name<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="bank_name" id="bank_name"  class="form-control" placeholder="Bank Name" data-rule-required="true" data-rule-maxlength="250" value="{{$arr_financial_details['bank_name'] or ''}}">
							<span class="error">{{ $errors->first('bank_name') }} </span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2" for="branch_name">Branch Name<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="branch_name" id="branch_name"  class="form-control" placeholder="Branch Name" data-rule-required="true" data-rule-maxlength="60" value="{{$arr_financial_details['branch'] or ''}}">
							<span class="error">{{ $errors->first('branch_name') }} </span>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2" for="account_holder_name">Account Holder Name<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="account_holder_name" id="account_holder_name" class="form-control" placeholder="Account Holder Name" data-rule-required="true" data-rule-maxlength="250" value="{{$arr_financial_details['account_holder_name'] or ''}}">
							<span class="error">{{ $errors->first('account_holder_name') }} </span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2" for="account_no">Account No.<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="account_no" id="account_no" class="form-control" placeholder="Account No." data-rule-required="true" data-msg-number="Please enter valid account number." data-rule-minlength="6" data-rule-maxlength="20" data-msg-minlength="Account number should be atleast 6 digits." data-msg-maxlength="Account number should not be more than 20 digits."  data-rule-number value="{{$arr_financial_details['account_number'] or ''}}">
							<span class="error">{{ $errors->first('account_no') }} </span>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2" for="ifsc_code">IFSC Code<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="ifsc_code" id="ifsc_code" class="form-control" placeholder="IFSC Code" data-rule-required="true" data-rule-pattern="^[a-zA-Z\d]+$" data-rule-minlength="6" data-rule-maxlength="16" value="{{$arr_financial_details['ifsc_code'] or ''}}">
							<span class="error">{{ $errors->first('ifsc_code') }} </span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2" for="ifsc_code">Website Commission(In %)<i class="red">*</i></label>
						<div class="col-lg-5">
							{{$obj_commission->admin_commission or 'Not Set'}}
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
			$('#frm_financial_details').validate({
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


