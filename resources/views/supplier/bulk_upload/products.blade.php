
@extends('supplier.layout.master')    
@section('main_content')
<!-- Page header -->
@include('supplier.layout.breadcrumb')  
<!-- /page header -->
<link href="{{url('/')}}/web_supplier/assets/css/loading_animate.css" rel="stylesheet" type="text/css">
<!-- BEGIN Main Content -->

<!-- Content area -->
<div class="content">

	<div class="panel panel-flat">
		{{-- @include('supplier.layout._operation_status') --}}
		@if(Session::has('data'))
		
		@php $data = Session::get('data');@endphp

		@if(isset($data['status'])&& $data['status'] =='success')
		<div class="alert alert-success alert-dismissible">
			<a href="#" class="close close-btn" data-dismiss="alert" aria-label="close">&times;</a>
			{{ isset($data['msg'])? $data['msg']:''}} {{isset($data['line'])? ' at line '.$data['line']:''}}
		</div>
		@endif  

		@if(isset($data['status'])&& $data['status'] =='error')
		<div class="alert alert-danger alert-dismissible">
			<a href="#" class="close close-btn" data-dismiss="alert" aria-label="close">&times;</a>
			{{ isset($data['msg'])? $data['msg']:''}} {{isset($data['line'])? ' at line '.$data['line'].'.':''}}
		</div>
		@endif
		@endif

		<div class="panel-heading">
			<h5 class="panel-title">{{$sub_module_title or ''}}</h5>
		</div>

		<div class="panel-body">
		<div class="pull-right">
			<a class="btn btn-primary" href="{{url($module_url_path.'/products/template')}}"><i class="fa fa-download"></i> Download Template</a>
			<a class="btn btn-primary" href="{{url($module_url_path.'/products/suggetion')}}"><i class="fa fa-download"></i> Download Latest Suggetion Sheet</a>
		</div>
			<form class="form-horizontal" id="frm_upload" name="frm_upload" action="{{url($module_url_path.'/products/upload')}}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}

				<fieldset class="content-group">	

					<div class="form-group">
						<label class="control-label col-lg-2">File (Excel)</label>
						<div class="col-lg-7">
							<input type="file" class="file-input" name="file" id="file" style="display: none;">
							<button type="button" id="btn-upload" class="btn"> <i class="fa fa-file"></i>&nbsp; <span id="file-name">Select File</span></button>
							<br/><span class="error" id="error"></i></span>
						</div>
					</div>
					<span class="error">NOTE: <i>You can upload 100 products at a time.</i></span><br/>
					<span class="error"><i>Download template to add your products.</i></span><br/>
					<span class="error"><i>Download latest instruction sheet for help.</i></span>
					<div class="form-group text-center">
						<div class="col-lg-7">
							<button type="submit" class="btn btn-primary">Upload</button>
						</div>
					</div>
				</fieldset>

			</form>
		</div>
	</div>
	<script type="text/javascript" src="{{url('/')}}/web_supplier/assets/js/pages/loader.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			$("#btn-upload").click(function(){
				$(this).prev().trigger('click');
			});

			$('#file').change(function(e){
				var fileName = e.target.files[0].name;
				var ext = fileName.split('.').pop();

				if(ext!='xls')
				{
					$('#file').val('');
					$('#error').html('Please select valid excel file');
				}
				else
				{
					if(fileName=='')
					{
						$('#file-name').html('Select File');
						$('#error').html('this filed is required');
					}
					else
					{
						$('#file-name').html(fileName);
						$('#error').html('');
					}
				}

			});
			$('#frm_upload').submit(function(){
				var file_name=$('#file').val();
				if(file_name=='')
				{
					$('#error').html('Please select excel file');
					return false;
				}
				else
				{
					$('#error').html('');
					showProcessingOverlay();
					return true;
				}
			});
		});
	</script>
	@endsection