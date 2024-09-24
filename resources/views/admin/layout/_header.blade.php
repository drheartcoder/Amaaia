    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ isset($page_title)?$page_title:"" }} - {{ config('app.project.name') }}</title>

        <!-- Global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        <link href="{{url('/')}}/web_admin/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
        <link href="{{url('/')}}/web_admin/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
        <link href="{{url('/')}}/web_admin/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="{{url('/')}}/web_admin/assets/css/core.css" rel="stylesheet" type="text/css">
        <link href="{{url('/')}}/web_admin/assets/css/components.css" rel="stylesheet" type="text/css">
        <link href="{{url('/')}}/web_admin/assets/css/colors.css" rel="stylesheet" type="text/css">
        <link href="{{url('/')}}/web_admin/assets/css/custom.css" rel="stylesheet" type="text/css">
        <link href="{{url('/')}}/web_admin/assets/css/sweetalert.css" rel="stylesheet" type="text/css">
        <link href="{{url('/')}}/web_admin/assets/css/icons/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- /global stylesheets -->
        <script src="{{url('/')}}/web_admin/assets/js/core/libraries/jquery.min.js"></script>
        <script type="text/javascript" src="{{url('/')}}/web_admin/assets/js/pages/image_validation.js"></script>
        <script type="text/javascript" src="{{url('/')}}/web_admin/assets/js/pages/multiple_image_upload.js"></script>
        <link rel="shortcut icon" type="image/png" href="{{ url('/web_admin/assets/images/fav_icon.png') }}"/>
        <style type="text/css">
        .dataTables_length{
            float: left;
            padding-top: 10px;
        }
        .dataTables_info{
            padding: 15px!important;
        }
        td {
            padding: 5px 20px!important;
        }
        .filled-in{    width: 16px;
            height: 16px;

        }

        .dataTables_paginate {
            margin: 20px!important;
            
        }

        .navbar-brand > img {
        background: transparent;
        margin: -25px;
        height: 60px;
        }
        .dataTables_filter {
            margin: 0;
        }
        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
            padding: 5px 20px!important;
        }
        .btn-file
        {
margin-top: 5px;
    height: 32px;
        }
    </style>

    </head>

    <body class="{{ theme_body_color() }}">
        <!-- Main navbar -->
        @php
        $admin_path = config('app.project.admin_panel_slug');
        @endphp
        <div class="navbar {{ theme_navbar_color() }}">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{url('/')}}/admin/dashboard"><img src="{{url('/').config('app.project.img_path.website_logo')}}" alt="Profile Image"></a>

                <ul class="nav navbar-nav visible-xs-block">
                    <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                    <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
                </ul>
            </div>

            <div class="navbar-collapse collapse" id="navbar-mobile">
                <ul class="nav navbar-nav">
                    <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
                </ul>

                <p class="navbar-text"><span class="label bg-success">Online</span></p>

                <ul class="nav navbar-nav navbar-right">
                   @php
                   $arr_unread_notifications = [];
                   $arr_unread_notifications = get_admin_unread_notifications();
                   @endphp
                   <li class="dropdown manage_notification">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-bubbles4"></i>
                        <span class="visible-xs-inline-block position-right">Notifications</span>
                        @if(isset($arr_unread_notifications) && !empty($arr_unread_notifications))
                        <span class="badge bg-warning-400">
                            {{ sizeof($arr_unread_notifications)}}
                        </span>
                        @endif
                    </a>
                    
                    <div class="dropdown-menu dropdown-content width-350">
                        <div class="dropdown-content-heading">
                            Notifications
                        </div>

                        <ul class="media-list dropdown-content-body">
                         
                            @if(isset($arr_unread_notifications) && !empty($arr_unread_notifications) && is_array($arr_unread_notifications))
                            @foreach($arr_unread_notifications as $val)
                            <li class="media">
                                <div class="media-left">
                                    <img src="{{url('/web_admin/assets/images/placeholder.jpg')}}" class="img-circle img-sm" alt="Profile Image">
                                    <span class="badge bg-danger-400 media-badge"><i class="fa fa-comment"></i></span>
                                </div>

                                <div class="media-body">
                                    <span class="media-annotation pull-right">
                                        {{isset($val['created_at']) && !empty($val['created_at']) ? date('H:m a',strtotime($val['created_at'])) : ''}}
                                    </span>
                                    <span class="text-muted">
                                        @php
                                           $notification_url = isset($val['notification_url']) ? $val['notification_url'] :'javascript:void(0)';
                                        @endphp
                                        <a href="javascript:void(0)" class="view_notification" data-notification-id="{{isset($val['id']) ? base64_encode($val['id']) : 0}}" data-notification-url="{{url('/').'/admin/'.$notification_url }}"><?php echo isset($val['notification_message']) ? htmlspecialchars_decode($val['notification_message']) : '' ?> </a>
                                    </span>
                                </div>
                            </li>
                            @endforeach
                            @else
                            <li class="media">
                                <div class="media-body text-center">
                                    <span class="text-muted">No new notifications found.</span>
                                </div>
                            </li>
                            @endif
                        </ul>

                        <div class="dropdown-content-footer">
                            <a href="{{url('/')}}/admin/notifications" data-popup="tooltip" title="All Notifications"><i class="icon-menu display-block"></i></a>
                        </div>
                    </div>
                </li>
                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">

                        @php 
                                // dump($shared_admin_details);
                        $admin_profile_img =  isset($shared_admin_details['profile_image'])  ? $shared_admin_details['profile_image'] : "";
                        $profile_image_src = ""; 
                        @endphp
                        @if(isset($admin_profile_img) &&  $admin_profile_img!="" && file_exists($profile_image_base_img_path.$admin_profile_img))
                        @php
                        $profile_image_src = $profile_image_public_img_path.$admin_profile_img;
                        @endphp
                        @else
                        @php
                        $profile_image_src =url('/')."/uploads/admin/default_image/default-profile.png";
                        @endphp
                        @endif
                        <img src="{{$profile_image_src}}" alt="Profile Image" class="img-circle img-sm">
                        <span>{{$shared_admin_details['first_name'] or ''}}</span>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="{{url('')}}/admin/account_setting"><i class="icon-user-plus"></i> Account Setting</a></li>
                        <li><a href="{{url('')}}/admin/password/change"><i class="icon-key"></i> Change Password</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ url('/').'/'.$admin_path }}/logout "><i class="icon-switch2"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

     <script>
        $(document).ready(function(){
            $(document).on('click','.view_notification',function(){
                notification_id = $(this).attr('data-notification-id');
                notification_url = $(this).attr('data-notification-url');
                
                $.ajax({
                    url:'{{url('/')}}/admin/notifications/read/'+notification_id,
                    type:'get',
                    data:{notification_id:notification_id},
                    success:function(data){
                        if(data['status'] == 'success')
                        {
                            window.location = notification_url;
                        }
                    }
                });
            });

            /*setInterval(function(){ 
                $('.manage_notification').load(location.href+" .manage_notification>*","");

            }, 5000);*/


        });
    </script>
        <!-- /main navbar -->