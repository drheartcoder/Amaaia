<div id="products_compare_list">
    @if(count(Session::get('arr_compare')) > 0)
        <div class="compare-sticky" style="">
            <div class="responsive-btn-compare hidden-lg hidden-md">
                <a class="cmpare-bt" href="JavaScript:Void(0);">
                    <i class="fa fa-balance-scale"></i>
                </a>
                <a href="JavaScript:Void(0);">
                    <i class="fa fa-times"></i>
                </a>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="compare-txt-prodct">Compare Products <span>({{ count(Session::get('arr_compare')) }} Products)</span></div>
            </div>

            <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4">

                @foreach(Session::get('arr_compare') as $compare)
                    <div class="border-boxs-ab">
                        <a href="JavaScript:Void(0);">
                            <img src="{{ $compare['product_img'] }}" class="img-responsive" alt="">
                        </a>
                    </div>
                @endforeach

            </div>
            <div class="col-xs-12 col-sm-3 col-md-4 col-lg-4 hidden-xs hidden-sm">
                <a href="{{ url('/') }}/compare_list/clear_all" class="clear-all-txt" id="clear_all" >Clear All</a>
                <a href="{{ url('/') }}/compare_list/view" class="comparebtns button-comp" id="redirect_compare_list"> Let's Compare!</a>
            </div>

        </div>
    @endif
</div>

<script type="text/javascript">
    $('.btn_compare_product').click(function(){
        var enc_product_id = $(this).attr('data-compare-product-id');
        var product_img    = $(this).attr('data-img');

        if(enc_product_id != '')
        {
            var _token = "{{ csrf_token() }}";
            $.ajax({
                url:'{{url("/")}}/compare_list/add',
                type:'post',
                data: { _token:_token, enc_product_id:enc_product_id, product_img:product_img },
                success:function(data){
                    if(data)
                    {

                        if(data.status == 'other_type_product_exist')
                        {
                            swal({
                                title: "Are you sure ?",
                                text: data.msg,
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Proceed",
                                cancelButtonText: "No",
                                closeOnConfirm: false,
                                closeOnCancel: true
                            },
                            function(isConfirm)
                            {
                                if(isConfirm==true)
                                {
                                    remove_products = 'remove_other_products'; 
                                    $.ajax({
                                        url:'{{url('/')}}/compare_list/add/'+enc_product_id+'/'+remove_products,
                                        type:'get',
                                        success:function(response){
                                            swal('',response.msg,response.status);
                                        }
                                    });
                                }
                            });
                        }
                        else
                        {
                            if(data.status == 'success')
                            {
                                /*$('#add_to_compare_block').load(location.href+" #add_to_compare_block>*","");*/
                                $('#products_compare_list').load(location.href+" #products_compare_list>*","");
                            }
                            swal('',data.msg,data.status);
                        }

                    }
                    else
                    {
                        swal('','Something went to wrong! Please try again later.','error');
                    }

                }
            });
        }
        else
        {
            swal('','Something went to wrong! Please try again later.','error');
        }
    });
</script>