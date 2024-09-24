
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
							<form class="form-horizontal" id="frm_add_front_page" name="frm_add_front_page" action="{{$module_url_path}}/store" method="post">
								{{csrf_field()}}
								<fieldset class="content-group">	
									<div class="form-group">
										<label class="control-label col-lg-2" for="page_title">Page Title<i class="red">*</i></label>
										<div class="col-lg-5">
											<input type="text" name="page_title" id="page_title" onkeyup="chk_validation(this)" class="form-control" placeholder="Page Title" data-rule-required="true"  data-rule-maxlength="100">
											<span class="error">{{ $errors->first('page_title') }} </span>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-lg-2" for="meta_title">Meta Title<i class="red">*</i></label>
										<div class="col-lg-5">
											<input type="text" name="meta_title" id="meta_title" onkeyup="chk_validation(this)" class="form-control" placeholder="Meta Title" data-rule-required="true"  data-rule-maxlength="100">
											<span class="error">{{ $errors->first('meta_title') }} </span>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-lg-2" for="meta_keyword">Meta Keyword<i class="red">*</i></label>
										<div class="col-lg-5">
											<input type="text" name="meta_keyword" id="meta_keyword"  onkeyup="chk_validation(this)" class="form-control" placeholder="Meta Keyword" data-rule-required="true"  data-rule-maxlength="100">
											<span class="error">{{ $errors->first('meta_keyword') }} </span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2" for="meta_description">Meta Description<i class="red">*</i></label>
										<div class="col-lg-5">
											<input type="text" name="meta_description" id="meta_description" class="form-control" placeholder="Meta Description" class="form-control" data-rule-required="true" data-rule-maxlength="150">
											<span class="error">{{ $errors->first('meta_description') }} </span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2" for="page_description">Page Description<i class="red">*</i></label>
										<div class="col-lg-6">
											<textarea  name="page_description" id="page_description" class="form-control" data-rule-required="true" rows="15"></textarea>
											<span class="error">{{ $errors->first('page_description') }} </span>
										</div>
									</div>
									
									<div class="form-group text-center">
										<div class="col-lg-7">
											<button type="submit" class="btn btn-primary" id="btn_add_front_page">Add</button>
										</div>
									</div>
								</fieldset>
								
							</form>
						</div>
					</div>

 <script src="{{url('web_admin/assets\tinymce\js\tinymce/jquery.tinymce.min.js')}}"></script>
 <script src="{{url('web_admin/assets\tinymce\js\tinymce/tinymce.min.js')}}"></script>

 
 <script>tinymce.init({ selector:'#page_description' });</script>

<script>

    $(document).ready(function(){
    	$('#frm_add_front_page').validate({
    		highlight: function(element) { },
    		ignore: [] 
    	});

    	$('#btn_add_front_page').click(function(){
      		tinyMCE.triggerSave();
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


			