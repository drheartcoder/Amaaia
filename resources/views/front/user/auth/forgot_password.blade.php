@extends('front.layout.master')   
@section('main_content')

<div class="login-page-main min-hieght-class">
	
	<div class="container">

		<div class="login-bg-inner-s">
				@include('front.layout._operation_status') 
			{{-- <div class="profile-login-avtar">
			</div> --}}
			<div class="title-logins">Forget Password</div>
			
			<form id="form_forget" action="{{url('/postEmail')}}" method="post">
				{{csrf_field()}}
				<div class="box-form">
					<label for="email">Email</label>
					<input id="email" name="email" placeholder="Enter Registerd Email Address" type="text" data-rule-required="true" >
					<div class="error-smg"></div>
				</div>
			</form>

				<div class="box-form">
					<div class="full-button">
						<a class="button-shop btn_reset_link" href="javascript:void(0)"><span>Send Reset Link</span></a>
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

$('#form_forget').on('submit',function()
    { 
        var form = $( "#form_forget");
        if(form.valid())
        {
            showProcessingOverlay();
            return true;
        }
    });
	jQuery('#form_forget').validate({
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

