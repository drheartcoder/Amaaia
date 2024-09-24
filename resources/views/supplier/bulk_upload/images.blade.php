@extends('supplier.layout.master')    
@section('main_content')
<!-- Page header -->
@include('supplier.layout.breadcrumb')  

<script type="text/javascript" src="{{url('/')}}/web_supplier/assets/css/style.css"></script>
<script type="text/javascript" src="{{url('/')}}/web_supplier/assets/css/dropzone.css"></script>
<link href="{{url('/')}}/web_supplier/assets/css/loading_animate.css" rel="stylesheet" type="text/css">
<!-- /page header -->
<style type="text/css">
	.text-center
	{
		padding-top: 25px;
	}
</style>
<!-- BEGIN Main Content -->

<!-- Content area -->
<div class="content">

	<div class="panel panel-flat">
		@include('supplier.layout._operation_status')
		<div class="panel-heading">
			<h5 class="panel-title">{{$sub_module_title or ''}}</h5>
		</div>

		<div class="panel-body">
			<div class="col-sm-12">
				<form action="{{url($module_url_path.'/images/upload')}}" class="dropzone" id="dropzonewidget">
					{{csrf_field()}}
				</form>
				<label id="basic-error" class="validation-error-label" for="basic"></label>
				<span class="error">NOTE:<i>Only jpg, png, jpeg images allowed with max size 2mb.</i></span><br/>
				<span class="error"><i>You can upload upto 100 images at a time.</i></span>
			</div>	

			<div class="col-sm-12">
				<div class="text-center">
					<button type="submit" class="btn btn-primary" id="submitButton">Upload <i class="fa fa-upload"></i></button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="{{url('/')}}/web_supplier/assets/js/dropzone.js"></script>
	<script type="text/javascript" src="{{url('/')}}/web_supplier/assets/js/pages/loader.js"></script>
	<script type="text/javascript">
		Dropzone.options.dropzonewidget = {
			addRemoveLinks: true,
			maxFiles: 100,
			parallelUploads: 100,
			uploadMultiple: true,
			maxFilesize: 2,
			autoProcessQueue: false,

			acceptedFiles: '.jpg, .JPG, .png, .PNG, .jpeg, .JPEG',
			success: function( file, response ) {
				if(response.status=='error')
				{
					file.status = Dropzone.QUEUED;
					$('#basic-error').html(response.msg);
				}
				else
				{
					swal(response.msg);
					this.removeFile(file);
				}
			},

			init: function() {
				var myDropzone = this;
				this.on("error", function(file, message) { 
					swal(message);
					this.removeFile(file); 

				});

				$('#submitButton').on("click", function() {
					myDropzone.processQueue();
						// showProcessingOverlay();
					$('#basic-error').html('');    
				});
				myDropzone.on("sending", function(file, xhr, data) {
					data.append("_token", $('meta[name="token"]').attr('content'));
				});
			}
		};
	</script>
	@endsection