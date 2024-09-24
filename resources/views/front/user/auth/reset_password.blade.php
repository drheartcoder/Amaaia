@extends('front.layout.master')   
@section('main_content')

<div class="login-page-main min-hieght-class">
	
	<div class="container">

		<div class="login-bg-inner-s">
			@include('front.layout._operation_status') 
			<div class="profile-login-avtar">
			</div>
			<div class="title-logins">Reset Password</div>
			
			<form id="form_forget" action="{{url('/postReset')}}" method="post">
				{{csrf_field()}}
				<input type="hidden" name="email" value="{{ $password_reset['email'] or ''}}" />
				<input type="hidden" name="token" value="{{ $token or ''}}" />
				<div class="box-form">
					<label for="password">New Password</label>
					<input id="password" name="password" placeholder="Enter New Password" type="password">
					<div class="error-smg">{{ $errors->first('password') }} </div>
				</div>
				<div class="box-form">
					<label for="password_confirmation">Confirm Password</label>
					<input id="password_confirmation" name="password_confirmation" placeholder="Re-Enter New Password" type="password">
					<div class="error-smg">{{ $errors->first('password') }} </div>
				</div>
			</form>

			<div class="box-form">
				<div class="full-button">
					<a class="button-shop btn_reset_link" href="javascript:void(0)"><span>Submit</span></a>
				</div>

			</div>

			<div class="login-link-register"> <a href="{{url('/login')}}"><i class="fa fa-angle-double-left"></i> Back to Login Now!</a>
			</div>
		</div>            
	</div>

</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.btn_reset_link').click(function()
		{
			$('#form_forget').submit();
		});

		jQuery('#form_forget').validate({
			errorClass: "error-smg",
			highlight: function(element) { },
			errorElement: "span",
			rules: {
				'password': {
					pattern: /(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])(?=.*\d).*/,
					required: true,
					minlength:6,
				},
				'password_confirmation': {
					required: true,
					equalTo: "#password"
				}
			},
			messages: {
				password_confirmation: {
					equalTo: "Please enter same password again"

				},
				password: {
					pattern: "Password must contain at least (1) lowercase, (1) uppercase, (1) special character, (1) letter."
				},

			}
		});

	});
</script>



@endsection

