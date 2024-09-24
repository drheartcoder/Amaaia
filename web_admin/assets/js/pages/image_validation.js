function validateImage (files,height,width) 
{
  var image_height = height || "";
  var image_width = width || "";
  if (typeof files !== "undefined") 
  {
    for (var i=0, l=files.length; i<l; i++) 
    {


          var blnValid = false;
          var ext = files[0]['name'].substring(files[0]['name'].lastIndexOf('.') + 1);
          if(ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG")
          {
                      blnValid = true;
          }
          
          if(blnValid ==false) 
          { 
              swal("Invalid File","Sorry, " + files[0]['name'] + " is invalid, allowed extensions are: jpeg , jpg , png", "error");

              $(".fileupload-preview").html("");
              $(".fileupload").attr('class',"fileupload fileupload-new");
              $(".fileupload-preview").attr("src",$('#default_image').val());
              $('#remove').hide();
              $("#image").val('');
             
              return false;
          }
          else
          {   
           if(files[i].size > 2200000)
           {
            swal('','Image size should be upto 2 MB only.','error');
            $(".fileupload-preview").html("");
            $(".fileupload").attr('class',"fileupload fileupload-new");
            $(".fileupload-preview").attr("src",$('#default_image').val());
            $('#remove').hide();
            $("#image").val('');
             return false;
           }

                var reader = new FileReader();
                reader.readAsDataURL(files[0]);
                reader.onload = function (e) 
                {
                        $('.fileupload-preview').attr('src', e.target.result);
                        $('#remove').show();
                        var image = new Image();
                        image.src = e.target.result;
                           
                        image.onload = function () 
                        {
                            var height = this.height;
                            var width = this.width;

                            if (height < image_height || width < image_width ) 
                            {
                              file_url = "";
                                if($('#oldimage').val() != '')
                                {
                                    file_url = $('#prev_image_url').val();
                                }
                                else if($('#default_image').val() != '')
                                {
                                    file_url = $('#prev_image_url').val();
                                }
                                file_url = $('#prev_image_url').val();
                                swal("","Height and Width must be greater than or equal to "+image_height+" X "+image_width+"." ,"error");
                                $(".fileupload-preview").attr("src",file_url);
                                $(".fileupload").attr('class',"fileupload fileupload-new");
                                $("#image").val('');
                                $('#remove').hide();
                                return false;
                            }
                            else
                            {
                               //swal("Uploaded image has valid Height and Width.");
                               return true;
                            }
                        };
     
                }
              
          }                
     
      }
    
  }
  else
  {
    swal("","No support for the File API in this web browser" ,"error");
  } 
}

function removeFile()
{
  $('.fileupload-preview').attr('src',$('#prev_image_url').val());
  $("#image").val('');
  $('#remove').hide();
}

function validatePaymentReceipt (files,height,width) 
{
    
  var image_height = height || "";
  var image_width = width || "";
  if (typeof files !== "undefined") 
  {
    for (var i=0, l=files.length; i<l; i++) 
    {
          var blnValid = false;
          var ext = files[0]['name'].substring(files[0]['name'].lastIndexOf('.') + 1);
          if(ext == "JPEG" || ext == "jpeg" || ext == "pdf" || ext == "PDF" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG" || ext=="doc" || ext =="docx" || ext=="txt")
          {
                      blnValid = true;
          }
          
          if(blnValid ==false) 
          { 

              showAlert("Sorry, " + files[0]['name'] + " is invalid, allowed extensions are: jpeg, jpg, png, pdf","error");
              $(".fileupload-preview").html("");
              $(".fileupload").attr('class',"fileupload fileupload-new");
              $("#validate-document").val('');
             
              return false;
          }
          else
          {              
            
                var reader = new FileReader();
                reader.readAsDataURL(files[0]);
                reader.onload = function (e) 
                {
                        var image = new Image();
                        image.src = e.target.result;
                           
                        image.onload = function () 
                        {
                            var height = this.height;
                            var width = this.width;
                            // console.log("current height:"+height+"  validate height:"+image_height );

                            // console.log("current width:"+width+" validate width:"+image_width);

                            if (height < image_height || width < image_width ) 
                            {
                                showAlert("Height and Width must be greater than or equal to "+image_height+" X "+image_width+"." ,"error");
                                $(".fileupload-preview").html("");
                                $(".fileupload").attr('class',"fileupload fileupload-new");
                                $("#image").val('');
                                return false;
                            }
                            else
                            {
                               //swal("Uploaded image has valid Height and Width.");
                               return true;
                            }
                        };
     
                }
              
          }                
     
      }
    
  }
  else
  {
    showAlert("No support for the File API in this web browser" ,"error");
  } 
}

// Validate image with image height and width 

function validateImageWithSize (files,height,width) 
{
    
  var image_height = height || "";
  var image_width = width || "";
  if (typeof files !== "undefined") 
  {
    for (var i=0, l=files.length; i<l; i++) 
    {
          var blnValid = false;
          var ext = files[0]['name'].substring(files[0]['name'].lastIndexOf('.') + 1);
          if(ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG")
          {
                      blnValid = true;
          }
          
          if(blnValid ==false) 
          { 

              showAlert("Sorry, " + files[0]['name'] + " is invalid, allowed extensions are: jpeg , jpg , png","error");
              $(".fileupload-preview").html("");
              $(".fileupload").attr('class',"fileupload fileupload-new");
              $("#profile_image").val('');
             
              return false;
          }
          else
          {              
                var reader = new FileReader();
                reader.readAsDataURL(files[0]);
                reader.onload = function (e) 
                {
                        var image = new Image();
                        image.src = e.target.result;
                           
                        image.onload = function () 
                        {
                            var height = this.height;
                            var width = this.width;
                            console.log("current height:"+height+"  validate height:"+image_height );

                            console.log("current width:"+width+" validate width:"+image_width);

                            if(height > image_height/* || width > image_width */)
                            {
                              $('#logo').val('');
                                showAlert("Height and Width must be less than or equal to "+image_height+" X "+image_width+"." ,"error");
                                $(".fileupload-preview").html("");
                                $(".fileupload").attr('class',"fileupload fileupload-new");
                                $("#image").val('');
                                return false;     
                            }
                            else
                            {
                               //swal("Uploaded image has valid Height and Width.");
                               return true;
                            }
                        };
     
                }
              
          }                
     
      }
    
  }
  else
  {
    showAlert("No support for the File API in this web browser" ,"error");
  } 
}
