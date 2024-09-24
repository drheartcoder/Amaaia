<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="author" content="" />
  <title>{{config('app.project.name')}}</title>
  <style type="text/css">
   /* .listed-btn a {border: 1px solid #f6929b; color: #f6929b; display: block; font-size: 15px; letter-spacing: 0.4px; margin: 0 auto; max-width: 204px; padding: 9px 4px; height: initial; text-align: center; text-transform: uppercase; text-decoration: none;width: 100%;}*/
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
                <td style="background-image: url('images/login-bg.jpg');background-position: center center;background-repeat: no-repeat;    color: #333;    font-size: 15px;    padding: 20px 25px;    text-align: center;">
                  <table style="margin-bottom: 0;" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td style="text-align:center;"><a href="#">{{-- <img src="{{ url('/') }}"> --}}<img src="{{url('/').config('app.project.img_path.website_logo')}}"  alt="logo" style="width: 180px;" /></a></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td height="20"></td>
              </tr>
              <tr><td style="color: rgb(51, 51, 51); text-align: center; font-size: 19px; line-height: 35px; padding-top: 3px;">Welcome To {{config('app.project.name')}} </td>
              </tr>
              <tr>
                <td>
                  
              {!! $content or '' !!}

                </td>
              </tr>
                <td height="40"></td>
              </tr>
              <tr>
                <td style="color: #333333; font-size: 16px; padding: 0 30px;">
                  Thanks &amp; Regards,
                </td>
              </tr>
              <tr>
                <td style="color: #f6929b; font-size: 15px; padding: 0 30px;">
                  {{config('app.project.name')}}
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