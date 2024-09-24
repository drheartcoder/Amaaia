<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="author" content="" />
  <title>Vacation Home Rental</title>
  <!-- ======================================================================== -->
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!--font-awesome-css-start-here-->
  <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!--Custom Css-->
  <link href="css/vacationhomerental.css" rel="stylesheet" type="text/css" />
  <!-- Datepicker-->
  <link rel="stylesheet" href="css/kendo.common-material.min.css" />
  <link rel="stylesheet" href="css/kendo.material.min.css" />
  <!--Main JS-->
  <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
  <!-- Datepicker-->
  <script src="js/kendo.all.min.js"></script>
  <!--common header footer script start -->
  <!--common header footer script end-->
  <style type="text/css">
   .listed-btn a {border: 1px solid #ff4747; color: #ffffff; display: block; font-size: 18px; letter-spacing: 0.4px; background-color: #ff4747;
    margin: 0 auto; max-width: 204px; padding: 9px 4px; height: initial; text-align: center; text-transform: capitalize; text-decoration: none; width: 100%;
    border-radius: 3px;}
    .listed-btn a:hover{/*background-color: transparent;*/ order: 1px solid #f50001; color: #f50001;}
    .logo-bg{margin-top: 30px;}
  </style>
</head>


<body style="background:#f1f1f1; margin:0px; padding:0px; font-size:12px; font-family:'roboto', sans-serif; line-height:21px; color:#666; text-align:justify;">
  <div style="max-width:630px;width:100%;margin:0 auto;">
    <div style="padding:0px 15px;">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
       <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" style="border:1px solid #e5e5e5;">
         <table style="margin-bottom: 0;" width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr >
           <td style=" color: #333;font-size: 15px; text-align: center;">
            <table style="margin-bottom: 0;" width="100%" border="0" cellspacing="0" cellpadding="0">
             <tr>
              <td style="text-align:center;"><a href="{{url('/')}}"><img src="{{url('/').config('app.project.img_path.website_logo')}}" class="logo-bg"  alt="logo"/></a></td>
              
            </tr>
          </table>
        </td>
      </tr>
      <tr>
       <td height="20"></td>
     </tr>
     <tr><td style="color: rgb(51, 51, 51); text-align: center; font-size: 19px; line-height: 24px; padding-top: 3px;">Welcome To Vacation Home Rental</td></tr>
     <tr><td style="color: #333333;font-size: 15px;padding-top: 3px;text-align: center;">Reset you account password</td></tr>
     
     <tr>
       <td height="40"></td>
     </tr>
     <tr>
      
       <td style="color: #333333; font-size: 16px; padding: 0 30px;">
         Hello <span style="color:#f50001;font-family: 'Latomedium',sans-serif;">Admin,</span>
       </td>
     </tr>
     <tr>
       <td style="color: #545454;font-size: 15px;padding: 12px 30px;">
        You recently requested a password reset,Please click below to reset your account password,
      </td>
    </tr>
    
    <tr>
     <td height="20"></td>
   </tr>
   
   <tr><td class="listed-btn"><a target='_blank'  class='link2' style='color:#ffffff;'>Reset Your Password</a></td></tr>
   <tr>
     <td height="40"></td>
   </tr>
   <tr>
     <td style="color: #333333; font-size: 16px; padding: 0 30px;">
       Thanks &amp; Regards,
     </td>
   </tr>
   
   <tr>
    <td style="color: #f50001;  font-size: 15px; padding: 0 30px;">
     <span style='color:#222222;'>Team {{config('app.project.name')}}</span>
   </td>
 </tr>
 <tr>
   <td>&nbsp;</td>
 </tr>                                    
 <tr>
  <td>
   <table style="margin-bottom: 0;" width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td style="font-size:13px;background:#f6929b; text-align: center; color: rgb(255, 255, 255); padding: 12px;">
      Copyright &copy; {{date('Y')}} <a href="{{url('/')}}" style="color:#fff;">{{config('app.project.name')}}</a>. All Right Reserved.  <a href="{{url('/')}}/info/terms-of-use" style="color:#fff;">Terms &amp; Conditions</a>
      </td>
    
  </tr>
</table>
</td>						 
</tr>
</table>
</td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
</table>
</div>      
</div>       
</body>
</html>