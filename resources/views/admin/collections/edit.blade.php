
@extends('admin.layout.master')    
@section('main_content')
@include('admin.layout.breadcrumb')  

<style type="text/css">
	.upload-pic {
		border              : 2px solid #dddfe2;/*border-radius: 4px;*/
		height              : 150px;width: 150px;}
		.backclass{
			background-color    : black;
		}
		.loc_add_pht {
			margin              : 5px !important;
		}
		.add_pht {
			background-repeat   : no-repeat;
			background-position : top 15px center;
			background-size     : 50px;
			border              : 1px solid #ccc;
			color               : #ccc;
			margin              : 0px;
			padding             : 0;
			text-align          : center;
			cursor              : pointer;
			float               : left;
			height              : 150px;
			width               : 150px;
		}
		.photo_view1 { 
			overflow            : hidden;
			cursor              : pointer;
			float               : left;
			margin              : 4px;
		}
		.overlay1 { 
			background          : rgba(0, 0, 0, 0.75);
			bottom              : 0;
			left                : 0;
			opacity             : 0;
			padding             : 0;
			position            : absolute;
			right               : 0;
			text-align          : center;
			top                 : 0;
			transition          : opacity 0.25s ease 0s;
		}
		.photo_view1: hover .overlay1 {
			opacity             : 0.5;
		}
		.plus2 {
			font-family         : Helvetica;
			font-weight         : 900;
			color               : rgba(255,255,255,.85);
			font-size           : 65px;
		}
		.overlay2 { 
			background          : rgba(0, 0, 0, 0.75);
			bottom              : 0;
			left                : 0;
			opacity             : 0;
			padding             : 0;
			position            : absolute;
			right               : 0;
			text-align          : center;
			top                 : 0;
			transition          : opacity 0.25s ease 0s;
		}
		.photo_view2: hover .overlay2 {
			opacity             : 1.5
		}
		.photo_view2{
			margin              : 5px;
			float               : left;
		}
		.plus1 {
			font-family         : Helvetica;
			font-weight         : 900;
			color               : rgb(68, 45, 85);
			font-size           : 14px;
			background-color    : #ccc;
			width               : 30px;
			height              : 30px;cursor: pointer;
			display             : block;
			border-radius       : 50%;
			line-height         : 30px;
			margin-left         : 5px;
			margin-top          : 5px;
		}
	</style>
	<div class="content">

		<div class="panel panel-flat">
			@include('admin.layout._operation_status')
			<div class="panel-heading">
				<h5 class="panel-name">{{$sub_module_name or ''}}</h5>
			</div>

			<div class="panel-body">

				<form class="form-horizontal" id="frm_add_categogry" name="frm_add_categogry" action="{{$form_url_path}}/update/{{$id}}" method="post" enctype="multipart/form-data">
					{{csrf_field()}}
					<fieldset class="content-group">

						<div class="form-group">
							<label class="control-label col-lg-2" for="category_id">Collection name<i class="red">*</i></label>
							<div class="col-lg-5">
								<input type="text" name="name" value="{{$collection['name'] or ''}}" id="name" class="form-control" placeholder="Collection Name" data-rule-required="true"  data-rule-maxlength="60" value="">
								<span class="error">{{ $errors->first('name') }} </span>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2" for="description">Description<i class="red">*</i></label>
							<div class="col-lg-5">
								<textarea class="form-control" data-rule-required='true' data-rule-maxlength="500" placeholder="collection Description" name="description" id="description">{{$collection['description'] or ''}}</textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-lg-2" for="description">Collection Image<i class="red">*</i></label>
							<div class="col-lg-5">
								<div class="lab_img" id="lab_1">
									<div class="col-sm-12 col-lg-12 col-lg-12" style="float:right;"> 
										<span>
											<a href="javascript:void(0);" id='remove_project' class="remove_project" style="display:none;" >
												<span class="glyphicon glyphicon-minus-sign" style="font-size: 20px;"></span>
											</a>
										</span>
									</div>
									<div class="" id="add_lab_div">
										<div class="add_pht upload-pic loc_add_pht" id="div_blank" onclick="return add_image(this)" style="height: 150px;width: 150px; float: left;"> 
											<img src="{{url('/web_admin/assets/images/upload.svg')}}" alt="plus-image" style="width:100%;height:100%;" /></div>
											<div class="show_photos" id="show_photos" style="width: auto; display: initial;float: none;">
												<div class='photo_view2' style='width:150px;height:150px;position:relative;display: inline-block;'>


													<img src="{{$image_path.$collection['image']}}" class='add_pht' id='add_pht upload-pic' style='float: left; padding: 0px ! important; margin:0' width='120' height='120'>
													<div class='overlay2'>
														<span class='plus2'>X</span>
													</div>
												</div>
											</div>
											<div id="div_hidden_photo_list" class="div_hidden_photo_list">
												<input type="file" name="image" id="image" class="image" style="display:none" @if($collection['image']=='') data-rule-required="true" @endif />
											</div>
										</div>

									</div>

								</div>
								<div class="col-lg-10 col-lg-offset-2">
									<i class="note col-lg-12"><b>NOTE:</b> Only jpg, png, gif, jpeg type images are allowed</i>
								</div>
							</div>

							<div class="form-group text-center">
								<div class="col-lg-7">
									<button type="submit" class="btn btn-primary">Update</button>
									<a href="{{$module_url}}" class="btn btn-primary">Cancel</a>

								</div>
							</div>
							<div>

							</fieldset>
						</form>
					</div>
				</div>

				<script>

					$(document).ready(function(){
						$('#frm_add_categogry').validate({
							ignore: [],
							highlight: function(element) { },
							errorPlacement: function(error, element) 
							{ 
								var name = $(element).attr("name");
								if (name === "product_type") 
								{
									error.insertAfter('.error_product_type');
								} 
								else
								{
									error.insertAfter(element);
								}

								if (name === "image")
								{
									error.insertBefore('.note');	
								} 
							} 
						});
					});



				function add_image(ref) { 

					var image_id = $(ref).closest('.lab_img').attr('id');
					var length = $('.lab_img').length;
					var view_photo_cnt = jQuery('#'+image_id).find('.photo_view').length

					jQuery('#'+image_id).last().find( ".div_hidden_photo_list" ).last().find( "input[name='blog_image']:last" ).click();
					jQuery('#'+image_id).last().find( ".div_hidden_photo_list" ).last().find( "input[name='blog_image']:last" ).change(function() {
						var files    = this.files;
						var prjct_id = image_id.split('_');
						jQuery('#'+image_id).find('#image'+prjct_id[1]+'_'+(view_photo_cnt+1)).attr('value',files[0]['name']);
						var img, reader;
						var image_ext = files[0]['name'].split('.').pop();

						if(image_ext=="jpg" || image_ext=="png" || image_ext=="gif" || image_ext=="jpeg" || image_ext=="JPG" || image_ext=="PNG" || image_ext=="JPEG" || image_ext=="GIF"){
							file = files[0];
							img  = document.createElement("img");
							img  = new Image();

							if(file.size > 2097152)
				             {
				             	 swal('','Image size should be upto 2 MB only.','error');
				             	$("#"+image_id).find(".show_photos").find(".photo_view2").last().remove();
								//$("#"+image_id).find(".div_hidden_photo_list").find("#blog_image").last().remove();
								jQuery('#'+image_id).find('#image'+prjct_id[1]+'_'+(view_photo_cnt+1)).val('');
								return false;
				             }

							img.onload = function() {

								if(this.width > 4000 && this.height > 4000 ) {
									swal('Please select image of 800 x 800 pixels or below');
									$("#"+image_id).find(".show_photos").find(".photo_view2").last().remove();
									$("#"+image_id).find(".div_hidden_photo_list").find("#blog_image").last().remove();
									jQuery('#'+image_id).find('#image'+prjct_id[1]+'_'+(view_photo_cnt+1)).val('');
									return false;
								}
							}
						} else {
							swal('Only jpg, png, gif, jpeg type images are allowed');
							jQuery('#'+image_id).last().find( ".div_hidden_photo_list" ).last().find( "input[name='blog_image']:last" ).unbind('change');
							jQuery('#'+image_id).last().find( ".div_hidden_photo_list" ).last().find( "input[name='blog_image']:last" ).val('');

							return false;
						}
						reader        = new FileReader();
						reader.onload = (function (theImg) {

							return function (evt) {

								tag_src    = evt.target.result;
								theImg.src = evt.target.result;
								var html   = "<div class='photo_view2' onclick='remove_image(this);' style='width:150px;height:150px;position:relative;display: inline-block;'><img src="+ tag_src +" class='add_pht' id='add_pht upload-pic' style='float: left; padding: 0px ! important; margin:0' width='120' height='120'><div class='overlay2'><span class='plus2'>X</span></div></div>";
								jQuery('#'+image_id).last().find('.show_photos').html(html);
							};
						}(img));
						reader.readAsDataURL(file);
					}); 
				} 

				function remove_image(elm) {
					console.log(elm);
					var this_index = jQuery(elm).index();
					$( "input[name='blog_image']" ).val('');
					jQuery(elm).remove();
				}

				function remove_image_code(){
					$( ".div_hidden_photo_list" ).last().find( "input[name='blog_image']:last" ).remove();
				}

				</script>

				@endsection


