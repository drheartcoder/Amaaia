
<!-- /dashboard content -->



<!-- Footer -->
<div class="footer text-muted" style="padding-left:20px;">
    &copy; {{date('Y')}}. <a href="{{ url('/') }}" target="_blank">{{config('app.project.name')}}</a> by <a href="http://www.webwingtechnologies.com/" target="_blank">Webwing Technologies</a>
</div>
<!-- /footer -->

<!-- Footer -->


</div>
<!-- /content area -->
</div>
<!-- /main content -->


</div>
<!-- /page content -->

</div>
<!-- /page container -->



<!-- Core JS files -->
<script src="{{url('/')}}/web_admin/assets/js/plugins/loaders/pace.min.js"></script>

<script type="text/javascript" src="{{url('/')}}/web_admin/assets/js/pages/jquery.validate.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/web_admin/assets/js/pages/additional-methods.js"></script>
<script src="{{url('/')}}/web_admin/assets/js/core/libraries/bootstrap.min.js"></script>
<script src="{{url('/')}}/web_admin/assets/js/plugins/loaders/blockui.min.js"></script>

<script type="text/javascript" src="{{url('/')}}/web_admin/assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/web_admin/assets/js/pages/datatables_basic.js"></script>
<!-- /core JS files -->


<!-- Theme JS files -->
<script src="{{url('/')}}/web_admin/assets/js/plugins/visualization/d3/d3.min.js"></script>
<script src="{{url('/')}}/web_admin/assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
<script src="{{url('/')}}/web_admin/assets/js/plugins/forms/styling/switchery.min.js"></script>
<script src="{{url('/')}}/web_admin/assets/js/plugins/forms/styling/uniform.min.js"></script>
<script src="{{url('/')}}/web_admin/assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
<script src="{{url('/')}}/web_admin/assets/js/pages/form_multiselect.js"></script>
<script src="{{url('/')}}/web_admin/assets/js/plugins/ui/moment/moment.min.js"></script>
<!-- <script src="{{url('/')}}/web_admin/assets/js/plugins/pickers/daterangepicker.js"></script> -->
<script type="text/javascript" src="{{url('/')}}/web_admin/assets/js/pages/sweetalert.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/web_admin/assets/js/pages/sweetalert_msg.js"></script>
<script type="text/javascript" src="{{url('/')}}/web_admin/assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="{{url('/')}}/web_admin/assets/js/core/app.js"></script>

<script type="text/javascript" src="{{url('/')}}/web_admin/assets/js/plugins/ui/moment/moment.min.js"></script>
<!-- <script type="text/javascript" src="{{url('/')}}/web_admin/assets/js/plugins/pickers/daterangepicker.js"></script>
<script type="text/javascript" src="{{url('/')}}/web_admin/assets/js/plugins/pickers/pickadate/picker.js"></script>
<script type="text/javascript" src="{{url('/')}}/web_admin/assets/js/plugins/pickers/pickadate/picker.date.js"></script>
<script type="text/javascript" src="{{url('/')}}/web_admin/assets/js/plugins/pickers/pickadate/picker.time.js"></script>
<script type="text/javascript" src="{{url('/')}}/web_admin/assets/js/pages/picker_date.js"></script> -->

<script type="text/javascript">

    function chk_all(field)
    {
        if($(field).prop('checked') == true){
            $('input[type="checkbox"]').prop('checked',true);
        }
        else
        {
            $('input[type="checkbox"]').prop('checked',false);
        }

    }

</script>

<script>
    $(document).ready(function(){
        $(document).on('change','input[name="checked_record[]"]',function(){
            if($(this).prop('checked') == false)
            {
                $('input[name="selectall"]').prop('checked',false);
            }

            var unselected_count = 0;

            $('input[name="checked_record[]').each(function(){
                if($(this).prop('checked') == false)
                {
                    unselected_count ++;
                }
                if(unselected_count > 0)
                {
                    $('input[name="selectall"]').prop('checked',false);
                }
                else
                {
                    $('input[name="selectall"]').prop('checked',true);
                }
            });

        });

    });
</script>

</body>
</html>
