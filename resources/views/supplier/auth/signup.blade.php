<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ isset($page_title)?$page_title:"" }} - {{ config('app.project.name') }}</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/web_supplier/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/web_supplier/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/web_supplier/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/web_supplier/assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/web_supplier/assets/css/colors.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/web_admin/assets/css/custom.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="{{url('/')}}/web_supplier/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="{{url('/')}}/web_supplier/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="{{url('/')}}/web_supplier/assets/js/pages/jquery.validate.min.js"></script>
	<script type="text/javascript" src="{{url('/')}}/web_supplier/assets/js/pages/additional-methods.min.js"></script>

	<script type="text/javascript" src="{{url('/')}}/web_supplier/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{url('/')}}/web_supplier/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="{{url('/')}}/web_supplier/assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script type="text/javascript" src="{{url('/')}}/web_supplier/assets/js/core/app.js"></script>
	<script type="text/javascript" src="{{url('/')}}/web_supplier/assets/js/pages/login.js"></script>
	<link rel="shortcut icon" type="image/png" href="{{ url('/web_supplier/assets/images/fav_icon.png') }}"/>
	
</head>

<body class="login-container">

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="{{url('/')}}"><img src="{{url('/').config('app.project.img_path.website_logo')}}" alt=""></a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->

	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">


					<!-- Registration form -->
					<form action="{{$module_url_path}}/signup/store" method="post" name="frm_supplier_signup" id="frm_supplier_signup">
						<div class="row">
							{{csrf_field()}}
							<div class="col-lg-6 col-lg-offset-3">
								<div class="panel registration-form">
									<div class="panel-body">
										@include('supplier.layout._operation_status')
										<div class="text-center">
											<div class="icon-object border-success text-success"><i class="icon-plus3"></i></div>
											<h5 class="content-group-lg">Create account <small class="display-block">All fields are required</small></h5>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group has-feedback">
													<input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" data-rule-required="true" onkeyup="chk_validation(this)" data-rule-maxlength="60" value="{{old('first_name')}}">
													<div class="form-control-feedback">
														<i class="icon-user-check text-muted"></i>
													</div>
													<span class="error">{{$errors->first('first_name')}}</span>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group has-feedback">
													<input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name" data-rule-required="true" data-rule-maxlength="60" onkeyup="chk_validation(this)"  type="text"  value="{{old('last_name')}}">
													<div class="form-control-feedback">
														<i class="icon-user-check text-muted"></i>
													</div>
													<span class="error">{{$errors->first('last_name')}}</span>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group has-feedback">
													<select class="form-control" id="sel1" name="phonecode" data-rule-required="true" data-msg-required="Select the country phone code.">
														<option value="">select Country Phone Code</option>
														@if(isset($arr_phonecode) && is_array($arr_phonecode) && sizeof($arr_phonecode)>0)
														@foreach($arr_phonecode as $phonecode)
															<option value="{{isset($phonecode['id'])? base64_encode($phonecode['id']):''}}" {{!empty(old('phonecode')) && isset($phonecode['id']) && base64_decode(old('phonecode')) == $phonecode['id'] ? 'selected' : '' }}>
																+{{$phonecode['phonecode'] or ''}} ({{$phonecode['CountryCode'] or ''}})
															</option>
														@endforeach
														@endif
													</select>
													<div class="form-control-feedback">
														<i class="icon-phone-minus text-muted"></i>
													</div>
													<span class="error">{{$errors->first('email')}}</span>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group has-feedback">
													<input type="text" class="form-control" placeholder="Mobile No." name="mobile_number" id="mobile_number" data-rule-required="true" data-rule-pattern="[- +()0-9]+" data-rule-minlength="7" data-rule-maxlength="16" data-msg-minlength="Mobile number should be atleast 7 numbers" data-msg-maxlength="Mobile number should not be more than 16 numbers." value="{{old('mobile_number')}}">
													<div class="form-control-feedback">
														<i class="icon-mobile text-muted"></i>
													</div>
													<span class="error">{{$errors->first('mobile_number')}}</span>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group has-feedback">
													<input type="text" class="form-control" placeholder="Email" name="email" id="email" data-rule-required="true"  value="{{old('email')}}" data-rule-email>
													<div class="form-control-feedback">
														<i class="icon-mention text-muted"></i>
													</div>
													<span class="error">{{$errors->first('email')}}</span>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group has-feedback">
													<input type="text" class="form-control" placeholder="Address" name="address" id="address"  data-rule-required="true"  data-rule-maxlength="550" value="{{old('address')}}">
											<div class="form-control-feedback">
												<i class="icon-address-book2 text-muted"></i>
											</div>
											<span class="error">{{$errors->first('address')}}</span>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group has-feedback">
													<input type="password" class="form-control" name="password" id="password" placeholder="Password" data-rule-required="true" data-rule-minlength="6" data-rule-maxlength="16" data-rule-pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])(?=.*\d).*" data-msg-pattern="Password must contain at least (1) lowercase, (1) uppercase, (1) special character, (1) letter.">
													<div class="form-control-feedback">
														<i class="icon-user-lock text-muted"></i>
													</div>
													<span class="error">{{$errors->first('password')}}</span>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group has-feedback">
													<input type="password" class="form-control" name="repeat_password" id="repeat_password" placeholder="Repeat password" data-rule-required="true" data-rule-minlength="6" data-rule-maxlength="16" data-rule-pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])(?=.*\d).*" data-msg-pattern="Password must contain at least (1) lowercase, (1) uppercase, (1) special character, (1) letter."  data-rule-equalto="#password">
													<div class="form-control-feedback">
														<i class="icon-user-lock text-muted"></i>
													</div>
													<span class="error">{{$errors->first('repeat_password')}}</span>
												</div>
											</div>
										</div>
										
										<div class="form-group">
											<div class="checkbox">
												<label>
													<input type="checkbox" class="styled" name="terms_and_conditions" id="terms_and_conditions" value="terms_and_conditions"  data-rule-required="true" data-msg-required="Please accept terms and conditions to proceed." {{!empty(old('terms_and_conditions')) ? 'checked' : ''}}>
													Accept <a href="{{url('/')}}/info/terms-of-use" target="_blank">Terms & Conditions</a>
													<span class="clearfix"></span>
													<span class="err_terms_and_conditions"></span>
													<span class="error">{{$errors->first('terms_and_conditions')}}</span>
												</label>
											</div>
										</div>

										<div class="text-right">
											<a href="{{$module_url_path}}" class="btn btn-link"><i class="icon-arrow-left13 position-left"></i> Back to login form</a>
											<button type="submit" class="btn bg-black btn-labeled btn-labeled-right ml-10"><b><i class="icon-plus3"></i></b> Create account</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
					<!-- /registration form -->


					<!-- Footer -->
					<div class="footer text-muted text-center">
						&copy; {{date('Y')}}. <a href="#">{{config('app.project.name')}}</a> by <a href="http://www.webwingtechnologies.com/" target="_blank">Webwing Technologies</a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>

<script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY&libraries=places"></script>

<script src="{{ url('/') }}/web_admin/assets/js/pages/jquery.geocomplete.js"></script>

<script>

	$(document).ready(function(){
      
      $("#address").geocomplete();

      $('#frm_supplier_signup').validate({
			highlight: function(element) { },
			errorElement: "span",
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

</html>
