<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <title>{{config('app.project.name')}}</title>
    <!-- ======================================================================== -->
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <!-- Bootstrap CSS -->
    
     <style type="text/css">
       .emailer-bg{max-width:630px; width:100%; margin:60px auto 30px; background: #FFFFFF; }
       .emailer-inner table{width:100%;} 
       .listed-btn a {border: 1px solid #5cb100; color: #ffffff; display: block; font-size: 18px; letter-spacing: 0.4px; background-color: #5cb100;
    margin: 0 auto; max-width: 204px; padding: 9px 4px; height: initial; text-align: center; text-transform: lowercase; text-decoration: none; width: 100%;
       border-radius: 25px; margin: 13px auto 30px;}
           .listed-btn a:hover{background-color: transparent; border: 1px solid #5cb100; color: #5cb100;}
           .logo-bg{ margin-top: 30px;}
       </style>
</head>
   
   
   <body style="background:#f1f1f1; margin:0px; padding:0px; font-size:12px; font-family:'roboto', sans-serif; line-height:21px; color:#666; text-align:justify;
      padding: 0 20px;">
      <div class="emailer-bg">
        <div class="emailer-inner">
          <table>
             <tr>
                <td>&nbsp;</td>
             </tr>
             <tr>
                <td>
                   <table>
                      <tr>
                         <td style="background-image: url('images/login-bg.jpg');background-position: center center;background-repeat: no-repeat; color: #333;                             font-size: 15px; text-align: center;">
                            <table>
                               <tr>
                                  <td style="text-align:center;"><a href="{{ url('/') }}"><img src="{{url('/').config('app.project.img_path.website_logo')}}" class="logo-bg"  alt="logo"/></a></td>
                               </tr>
                            </table>
                         </td>
                      </tr>
                      <!-- <tr><td style="color: rgb(51, 51, 51); text-align: center; font-size: 19px; line-height: 35px; padding-top: 3px; margin-top: 20px; display: block;">Welcome To Mekongpro </td>
                      </tr> -->
                      <tr>
                             <td style="color: #545454;font-size: 15px;padding: 12px 30px;">
                                {!! $content or '' !!}
                             </td>
                      </tr>
                      <tr>
                        <td style="color: #333333; font-size: 16px; padding: 0 30px;">
                           Thanks &amp; Regards,
                        </td>
                      </tr>
                      
                      <tr>
                         <td style="color: #5cb100;  font-size: 15px; padding: 0 30px;">
                           {{config('app.project.name')}}
                         </td>
                      </tr>
                      <tr>
                         <td>&nbsp;</td>
                      </tr>                                    
                       <tr>
                         <td>
                           <table>
                             <tr>
                               <td style="font-size:13px;background:#333; text-align: center; color: rgb(255, 255, 255); padding: 12px;">
                               Copyright © {{date('Y')}}<a href="{{url('/')}}" style="color:#fff;">&nbsp;{{config('app.project.name')}}</a>. All Right Reserved.  <a href="{{url('/')}}/pages/terms-and-conditions" style="color:#fff;">Terms &amp; Conditions</a>
                               </td>
                               
                             </tr>
                           </table>
                         </td>             
                       </tr>
                  </table>
                </td>
             </tr>
          </table>
        </div>      
      </div>       
   </body>
</html>