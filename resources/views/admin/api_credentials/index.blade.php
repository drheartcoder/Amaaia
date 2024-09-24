
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
			<div class="col-md-12">
				
				<form id="frm_api_credetials" action="{{$module_url_path.'/update'}}" method="post">
				{{csrf_field()}}

					<div class="panel panel-flat">

						<div class="tabbable">
							<ul class="nav nav-tabs nav-tabs-component">
								<li class="active"><a href="#highlighted-justified-tab1" data-toggle="tab" aria-expanded="true"> <i class="fa fa-diamond" aria-hidden="true"></i> Dimond Api</a></li>
								<li class=""><a href="#highlighted-justified-tab2" data-toggle="tab" aria-expanded="false"> <i class="fa fa-credit-card" aria-hidden="true"></i> CCAvenue</a></li>
								<li class=""><a href="#highlighted-justified-tab3" data-toggle="tab" aria-expanded="false"> <i class="fa fa-envelope" aria-hidden="true"></i> SMS Getway</a></li>
							</ul>

							<div class="tab-content">
								<div class="tab-pane active" id="highlighted-justified-tab1">

									<fieldset class="content-group">

										<div class="form-group col-lg-6">
											<label class="control-label col-lg-3" for="dimond_api_key">Api Key<i class="red">*</i></label>
											<div class="col-lg-8">
												<input type="text" name="dimond_api_key" id="dimond_api_key"  class="form-control" placeholder="Api Key" data-rule-required="true" data-rule-maxlength="60" value="{{$arr_data['dimond_api_key'] or ''}}">
												<span class="error">{{ $errors->first('dimond_api_key') }} </span>
											</div>
										</div>

										<div class="form-group col-lg-6">
											<label class="control-label col-lg-3" for="dimond_api_secret">Api Secret<i class="red">*</i></label>
											<div class="col-lg-8">
												<input type="text" name="dimond_api_secret" id="dimond_api_secret"  class="form-control" placeholder="Api Secret" data-rule-required="true" data-rule-maxlength="60" value="{{$arr_data['dimond_api_secret'] or ''}}">
												<span class="error">{{ $errors->first('dimond_api_secret') }} </span>
											</div>
										</div>

									</fieldset>
								</div>

								<div class="tab-pane" id="highlighted-justified-tab2">
									<fieldset class="content-group">

										<div class="form-group col-lg-6">
											<label class="control-label col-lg-3" for="ccavenue_api_key">Api Key<i class="red">*</i></label>
											<div class="col-lg-8">
												<input type="text" name="ccavenue_api_key" id="ccavenue_api_key"  class="form-control" placeholder="Api Key" data-rule-required="true" data-rule-maxlength="60" value="{{$arr_data['ccavenue_api_key'] or ''}}">
												<span class="error">{{ $errors->first('ccavenue_api_key') }} </span>
											</div>
										</div>

										<div class="form-group col-lg-6">
											<label class="control-label col-lg-3" for="ccavenue_api_secret">Api Secret<i class="red">*</i></label>
											<div class="col-lg-8">
												<input type="text" name="ccavenue_api_secret" id="ccavenue_api_secret"  class="form-control" placeholder="Api Secret" data-rule-required="true" data-rule-maxlength="60" value="{{$arr_data['ccavenue_api_secret'] or ''}}">
												<span class="error">{{ $errors->first('ccavenue_api_secret') }} </span>
											</div>
										</div>

									</fieldset>

								</div>

								<div class="tab-pane" id="highlighted-justified-tab3">

									<fieldset class="content-group">

										<div class="form-group col-lg-6">
											<label class="control-label col-lg-3" for="sms_api_key">Api Key<i class="red">*</i></label>
											<div class="col-lg-8">
												<input type="text" name="sms_api_key" id="sms_api_key"  class="form-control" placeholder="Api Key" data-rule-required="true" data-rule-maxlength="60" value="{{$arr_data['sms_api_key'] or ''}}">
												<span class="error">{{ $errors->first('sms_api_key') }} </span>
											</div>
										</div>

										<div class="form-group col-lg-6">
											<label class="control-label col-lg-3" for="sms_api_secret">Api Secret<i class="red">*</i></label>
											<div class="col-lg-8">
												<input type="text" name="sms_api_secret" id="sms_api_secret"  class="form-control" placeholder="Api Secret" data-rule-required="true" data-rule-maxlength="60" value="{{$arr_data['sms_api_secret'] or ''}}">
												<span class="error">{{ $errors->first('sms_api_secret') }} </span>
											</div>
										</div>

									</fieldset>

								</div>


							</div>
						</div>
						{{-- </div> --}}
					</div>
					<div class="col-lg-offset-4">
						<button type="submit" class="btn btn-primary">Update <i class="icon-arrow-right14 position-right"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function()
		{
			$('#frm_api_credetials').validate({
				ignore : []
			});
		});
	</script>

	@endsection


