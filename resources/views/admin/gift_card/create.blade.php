
@extends('admin.layout.master')    
@section('main_content')
<!-- Page header -->
@include('admin.layout.breadcrumb')  
<!-- /page header -->

<!-- BEGIN Main Content -->
<style type="text/css">
	#remove {
    display: inline-block;
    padding: 5px;
    margin: 5px;
}
</style>
<!-- Content area -->
<div class="content">

	<div class="panel panel-flat">
		@include('admin.layout._operation_status')
		<div class="panel-heading">
			<h5 class="panel-title">{{$sub_module_title or ''}}</h5>
		</div>

		<div class="panel-body">

			<form class="form-horizontal" id="frm_add_gift_card" name="frm_add_gift_card" action="{{$module_url_path}}/store" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
				<fieldset class="content-group">
					<div class="form-group">
						<label class="col-sm-3 col-lg-2 control-label">Card Image<i class="red">*</i></label>
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
									<img src="{{url('/').'/uploads/admin/default_image/gift_card.png' }}"  style="max-width: 100%; max-height: 100%; line-height: 20px;" class="fileupload-preview">
									@php 
									$is_profile_image_required = true;
									$prev_image_url = url('/').'/uploads/admin/default_image/gift_card.png';
									@endphp
									@endif
								</div>
								<div>
									<span class="btn btn-default btn-file" style="height:32px;">
										<span class="fileupload-new">Select Image</span>
										<input type="file"  data-validation-allowing="jpg, png, gif" class="file-input news-image validate-image" name="gift_card_image" id="image"  {{$is_profile_image_required == true ? 'data-rule-required=true' : ''}} data-msg-required="Please select card image."><br>
										<input type="hidden" name="oldimage" id="oldimage"  
										value="{{ $arr_admin_details['profile_image']  or ''}}"/>

										<input type="hidden" name="prev_image_url" id="prev_image_url"  
										value="{{$prev_image_url or ''}}"/>
									</span>

									<a href="javascript:void(0)" id="remove" class="btn btn-default fileupload-exists" data-dismiss="fileupload" style="display: none">Remove</a>
								</div>
								<i class="red"> {!! image_validate_note(80,100,'account_setting') !!} </i>
								<div id="file-upload-error" class="err_image"></div>
								<span for="image" id="err-image" class="help-block error">{{ $errors->first('gift_card_image') }}</span>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-sm-6 col-lg-5 control-label help-block-red" style="color:#b94a48;" id="err_logo"></div>
						<br/>
						<div class="col-sm-6 col-lg-5 control-label help-block-green" style="color:#468847;" id="success_logo"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2" for="title">Title<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="title" id="title" class="form-control" placeholder="Title" data-rule-required="true"  data-rule-maxlength="60" value="">
							<span class="error">{{ $errors->first('title') }} </span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2" for="amount">Amount (In RS)<i class="red">*</i></label>
						<div class="col-lg-5">
							<input type="text" name="amount" id="amount" class="form-control" placeholder="Amount" data-rule-required="true"  data-rule-maxlength="10" value="" data-rule-digits="true" data-msg-maxlength="Amount should be upto 10 digits only">
							<span class="error">{{ $errors->first('amount') }} </span>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2" for="description">Description<i class="red">*</i></label>
						<div class="col-lg-5">
							<textarea name="description" id="description" class="form-control" placeholder="Description" data-rule-required="true"  data-rule-maxlength="555" rows="5"></textarea>
							<span class="error">{{ $errors->first('description') }} </span>
						</div>
					</div>

					<div class="form-group text-center">
						<div class="col-lg-7">
							<button type="submit" class="btn btn-primary">Add</button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>

	<script>

		$(document).ready(function(){
			$('#frm_add_gift_card').validate({
				ignore: [],
				highlight: function(element) { },
				errorPlacement: function(error, element) 
				{ 
					var name = $(element).attr("name");
					if (name === "gift_card_image") 
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

		$(document).on("change",".validate-image", function()
	    {        
	        var file=this.files;
	        validateImage(this.files, 80,100);
	    });

	    $(document).on("click","#remove", function()
	    {   
	        removeFile();
	    });



	</script>

	@endsection


