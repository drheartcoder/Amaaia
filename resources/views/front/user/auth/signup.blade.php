@extends('front.layout.master')   
@section('main_content')
<style type="text/css">

.g-recaptcha {
 transform:scale(0.84);
    transform-origin:0 0;
}
.box-form.mobilenumber-error .error-smg{line-height: 12px;    bottom: -27px;}
</style>
<div class="login-page-main min-hieght-class">
    <form id="frm_signup" name="frm_signup" method="post" action="{{url('/')}}/signup_store">
        {{csrf_field()}}
        <div class="container">

            <div class="login-bg-inner-s signup-page">
                @include('front.layout._operation_status')
                <div class="signup-pg-new">
                    Sign Up
                    <p>Create a New Account</p>
                </div>

                <div class="row">

                    <div class="col-xs-12 col-md-6">
                        <div class="box-form">
                            <label for="first_name">First Name</label>
                            <input  placeholder="Enter your First name" type="text" name="first_name" id="first_name" data-rule-required="true" onkeyup="chk_validation(this)" data-rule-maxlength="60" value="{{old('first_name')}}" />
                            <span class="error-smg">{{ $errors->first('first_name') }} </span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="box-form">
                            <label for="last_name">Last Name</label>
                            <input placeholder="Enter your First name" type="text"  name="last_name" id="last_name" data-rule-required="true" data-rule-maxlength="60" onkeyup="chk_validation(this)"  type="text"  value="{{old('last_name')}}" />
                            <span class="error-smg">{{ $errors->first('last_name') }} </span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="box-form">
                            <label for="email">Email</label>
                            <input  placeholder="Enter your Email Address" type="text"  name="email" id="email" data-rule-required="true"  value="{{old('email')}}" data-rule-email />
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                       <div class="box-form">
                        <label for="address">Address</label>
                        <input type="text" placeholder="Enter your Address"  name="address" id="address"  data-rule-required="true"  data-rule-maxlength="550" value="{{old('address')}}">
                    </div>
                </div>

                <div class="col-xs-12 col-md-6">
                    <div class="box-form">
                        <label for="phonecode">Country Code</label>
                        <select class="form-control" id="sel1" name="phonecode" data-rule-required="true" data-msg-required="Select the country code.">
                            <option value="">Select Country Code</option>
                            @if(isset($arr_phonecode) && is_array($arr_phonecode) && sizeof($arr_phonecode)>0)
                            @foreach($arr_phonecode as $phonecode)
                            <option value="{{isset($phonecode['id'])? base64_encode($phonecode['id']):''}}" {{!empty(old('phonecode')) && isset($phonecode['id']) && base64_decode(old('phonecode')) == $phonecode['id'] ? 'selected' : '' }}>
                                +{{$phonecode['phonecode'] or ''}} ({{$phonecode['CountryCode'] or ''}})
                            </option>
                            @endforeach
                            @endif
                        </select>
                        <span class="error-smg">{{ $errors->first('phonecode') }} </span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="box-form">
                        <label for="mobile_number">Mobile No</label>
                        <input placeholder="Enter your Mobile No" type="text"  name="mobile_number" id="mobile_number" data-rule-required="true" data-rule-pattern="[- +()0-9]+" data-rule-minlength="7" data-rule-maxlength="16" data-msg-minlength="Mobile number should be atleast 7 numbers" data-msg-maxlength="Mobile number should not be more than 16 numbers." value="{{old('mobile_number')}}"/>
                        <span class="error-smg">{{ $errors->first('mobile_no') }} </span>
                    </div>
                </div>

                <div class="col-xs-12 col-md-6">
                    <div class="box-form mobilenumber-error" >
                        <label for="password">Password</label>
                        <input placeholder="Enter your Password" type="password" name="password" id="password"  data-rule-required="true" data-rule-minlength="6" data-rule-maxlength="16" data-rule-pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])(?=.*\d).*" data-msg-pattern="Password must be 8 character,one number,special chars and one capital letter." />
                        <span class="clearfix"></span>
                        <span class="error-smg">{{ $errors->first('password') }} </span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="box-form">
                        <label for="repeat_password">Confirm Password</label>
                        <input placeholder="Retype your Password" type="password" name="repeat_password" id="repeat_password" data-rule-required="true" data-rule-minlength="6" data-rule-maxlength="16" data-rule-pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])(?=.*\d).*" data-msg-pattern="Password must be 8 character,one number,special chars and one capital letter."  data-rule-equalto="#password" />
                        <span class="clearfix"></span>
                        <span class="error-smg">{{ $errors->first('repeat_password') }} </span>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12">
                    <div class="box-form">
                        <div class="g-recaptcha" 
                                   data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}" data-callback="recaptchaCallback">
                        </div>
                        <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
                        <span class="error-smg">{{ $errors->first('g-recaptcha-response') }} </span>
                    </div>
                </div>
            </div>
            <div class="box-form">
                <div class="check-box inline-checkboxs">
                    <input id="filled-in-box2" class="filled-in"  type="checkbox" name="terms_and_conditions" value="terms_and_conditions"  data-rule-required="true" data-msg-required="Please accept terms and conditions to proceed." {{!empty(old('terms_and_conditions')) ? 'checked' : ''}} />
                    <label for="filled-in-box2">Accept <a href="{{url('/')}}/info/terms-of-use" target="_blank">Terms &amp; Conditions</a></label>
                    <span class="error-smg err_terms_and_conditions">{{ $errors->first('terms_and_conditions') }} </span>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="full-button">
                <button type="submit" name="btn_signup" id="btn_signup" class="button-shop">Signup</button>
            </div>
        </div>
    </div>
</form>
</div>

<script src='https://www.google.com/recaptcha/api.js'></script>

<script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY&libraries=places"></script>

<script src="{{ url('/') }}/web_admin/assets/js/pages/jquery.geocomplete.js"></script>

<script>
	$(document).ready(function(){
		$("#address").geocomplete();
		jQuery('#frm_signup').validate({
            ignore: ".ignore",
            errorClass: "error-smg",
			highlight: function(element) { },
			errorElement: "span",
			rules: {
				email: {
					required: true,
					email: true,
					pattern: /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/
				},
                hiddenRecaptcha: {
                    required: function () {
                        if (grecaptcha.getResponse() == '') {
                            return true;
                        } else {
                            return false;
                        }
                    }
                }
			},
            errorPlacement: function(error, element) 
            { 
                var name = $(element).attr("name");
                if (name === "terms_and_conditions") 
                {
                    error.insertAfter('.err_terms_and_conditions');
                } 
                else
                {
                    error.insertAfter(element);
                }
            },
            messages: {
                email: {
                   pattern: "Please enter a valid email address.",

               },
               hiddenRecaptcha: {
                   required: "To confirm registration, please check the box to let us know you are human.",

               },
           }

       });
		
	});


    function recaptchaCallback() {
      $('#hiddenRecaptcha').valid();
    };
    $('#frm_signup').on('submit',function()
    { 
    var form = $("#frm_signup");
        if(form.valid())
        {
            showProcessingOverlay();
            return true;
        }
    });

</script>


@endsection