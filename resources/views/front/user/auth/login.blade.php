@extends('front.layout.master')   
@section('main_content')

<div class="login-page-main min-hieght-class">
	
	<div class="container">

		<form id="frm_login" name="frm_login" action="{{url('/')}}/validate_login" method="post">
			{{csrf_field()}}
			<div class="login-bg-inner-s">
				@include('front.layout._operation_status') 
				<div class="profile-login-avtar">
					
				</div>
				<div class="title-logins">Sign in your Account</div>
				<div class="box-form">
					<label for="email">Email</label>
					<input id="email" name="email" type="text" placeholder="Enter your email" type="email" data-rule-required="true" data-rule-email="true" value="<?php if(!empty($_COOKIE['remember_me_email'])) { echo $_COOKIE['remember_me_email']; } ?>" />
					<span class="error-smg" style="color:red;">{{ $errors->first('email') }} </span>
				</div>
				<div class="box-form">
					<label for="password">Password</label>
					<input placeholder="Enter your Password" type="password" id="password" name="password" data-rule-required="true" data-rule-minlength="6" data-rule-maxlength="16" value="<?php if(!empty($_COOKIE['remember_me_password'])) { echo $_COOKIE['remember_me_password']; } ?>" />
					<span class='error-smg'>{{ $errors->first('password') }}</span>
				</div>
				<div class="box-form">
					<div class="check-box inline-checkboxs">
						<input id="filled-in-box2" name="remember_me" class="filled-in" {{-- checked="checked" --}} type="checkbox" @if(!empty($_COOKIE['remember_me_email'])) ? checked : '' @endif name="remember_me" id="remember_me"/>
						<label for="filled-in-box2">Remember me</label>
					</div>
					<div class="forget-pass"><a href="{{url('/forget_password')}}" class="forgetpwd">Forgot password?</a></div>
					<div class="clearfix"></div>
				</div>
				
				<div class="box-form">
					<div class="full-button">
						<a class="button-shop" href="javascript:void(0)" id="btn_login"><span>Login</span></a>
					</div>
				</div>
				<div class="login-link-register">
					Not Yet Registered? <a href="{{url('/')}}/signup">Register Now!</a>
				</div>
				
				{{-- <div class="line-login">
					<span>Or</span>
				</div>
				
				<div class="socail-btns-login">
					<a href="javascript:void(0)" class="facebookicn"></a>
					<a href="javascript:void(0)" class="googleplusicn"></a>
				</div> --}}
				
			</div>
		</form>
		
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#btn_login').click(function(){
			$('#frm_login').submit();	
		});

		$("#email,#password").keypress(function (e) {
			if (e.which == 13) {
				$('#frm_login').submit();
				return false;
			}
		});
		
		jQuery('#frm_login').validate({
			errorClass: "error-smg",
			highlight: function(element) { },
			errorElement: "span",
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
			}

		});
		
	});
</script>


@endsection