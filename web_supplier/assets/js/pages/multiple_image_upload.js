 function add_image(ref,total_images,count,file_size) { 
   if(count >= total_images){
     swal('Only '+total_images+' files are allowed to upload.');
     return false; 
   }
   var image_id = $(ref).closest('.lab_img').attr('id');
   var length = $('.lab_img').length;
   var view_photo_cnt = jQuery('#'+image_id).find('.photo_view').length
   
   jQuery('#'+image_id).last().find( ".div_hidden_photo_list" ).last().find( "input[name='product_image[]']:last" ).click();
   jQuery('#'+image_id).last().find( ".div_hidden_photo_list" ).last().find( "input[name='product_image[]']:last" ).change(function() {
     var files    = this.files;
     var prjct_id = image_id.split('_');
     jQuery('#'+image_id).find('#image'+prjct_id[1]+'_'+(view_photo_cnt+1)).attr('value',files[0]['name']);
     var img, reader;
     var image_ext = files[0]['name'].split('.').pop();

     if(image_ext=="jpg" || image_ext=="png"  || image_ext=="jpeg" || image_ext=="JPG" || image_ext=="PNG" || image_ext=="JPEG" || image_ext=="GIF"){
       file = files[0];
       img  = document.createElement("img");
       img  = new Image();

       img.onload = function() {

         if(this.width > 4000 && this.height > 4000 ) {
           swal('Please select image of 800 x 800 pixels or below');
           $("#"+image_id).find(".show_photos").find(".photo_view2").last().remove();
           $("#"+image_id).find(".div_hidden_photo_list").find("#product_image").last().remove();
           jQuery('#'+image_id).find('#image'+prjct_id[1]+'_'+(view_photo_cnt+1)).val('');
           return false;
         }
       }
     } else {
       swal('Only jpg, png, jpeg type images are allowed.');
       jQuery('#'+image_id).last().find( ".div_hidden_photo_list" ).last().find( "input[name='product_image[]']:last" ).unbind('change');
       jQuery('#'+image_id).last().find( ".div_hidden_photo_list" ).last().find( "input[name='product_image[]']:last" ).val('');
   count = count-1;

       return false;
     }
     reader        = new FileReader();
     reader.onload = (function (theImg) {

       return function (evt) {

         tag_src    = evt.target.result;
         theImg.src = evt.target.result;
         var html   = "<div class='photo_view2' onclick='remove_image(this);' style='width:120px;height:120px;position:relative;display: inline-block;'><img src="+ tag_src +" class='add_pht' id='add_pht upload-pic' style='float: left; padding: 0px ! important; margin:0' width='120' height='120'><div class='overlay2'><span class='plus2'>X</span></div></div>";
         jQuery('#'+image_id).last().find('.show_photos').append(html);
         jQuery('#'+image_id).last().find('.div_hidden_photo_list').append('<input type="file" name="product_image[]" id="product_image" class="product_image" style="display:none" />');
         $('#file_name_lab').val('');
         exist_img_count = parseInt($("#total_images").val());
         total_count = exist_img_count +=1;
         $("#total_images").val(total_count);
       };
     }(img));
     reader.readAsDataURL(file);
   }); 
   count = count+1;
 } 

 function remove_image(elm) {
   var this_index = jQuery(elm).index();
   count          = count - 1;
   jQuery('.lab_img').find(".div_hidden_photo_list").find("input").eq(this_index).remove();
   jQuery(elm).remove();

   exist_img_count = parseInt($("#total_images").val());
   total_count = exist_img_count - 1;
   $("#total_images").val(total_count);
 }

 function remove_image_code(){
   $( ".div_hidden_photo_list" ).last().find( "input[name='product_image[]']:last" ).remove();
 }