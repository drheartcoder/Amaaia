
@extends('admin.layout.master')    
@section('main_content')
<!-- Page header -->
@include('admin.layout.breadcrumb')  
<!-- /page header -->

<!-- BEGIN Main Content -->

<!-- Content area -->
<div class="content">

	@include('admin.layout._operation_status')

	<?php
		$arr_customer = $arr_cart['cart']['user_details'];

		if(isset($arr_customer['country_phone_code_id']) && !empty($arr_customer['country_phone_code_id']))
		{
			$arr_phone_code = get_phonecode($arr_customer['country_phone_code_id']);
			$phone_code = isset($arr_phone_code['phonecode']) ? '+'.$arr_phone_code['phonecode'] : '';
		}
	?>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-white">
				<div class="panel-heading">
					<h6 class="panel-title"><i class="icon-cog3 position-left"></i> Customer Details</h6>
				</div>

				<div class="panel-body">
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Profile Picture</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							<div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
								@if(isset($arr_customer['profile_image']) && !empty($arr_customer['profile_image']) && File::exists($user_profile_image_base_path.$arr_customer['profile_image']))
								<img src="{{$user_profile_image_public_path.$arr_customer['profile_image']}}"  style="max-width: 100%;max-height: 100%; line-height: 20px;" class="fileupload-preview">
								@else
								<img src="{{url('/').'/uploads/supplier/default_image/default-profile.png' }}"  style="max-width: 100%; max-height: 100%; line-height: 20px;" class="fileupload-preview">
								@endif
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">First Name</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_customer['first_name'] or 'NA'}}
						</div>
					</div>
					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Last Name</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_customer['last_name'] or 'NA'}}
						</div>
					</div>

					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Email</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_customer['email'] or 'NA'}}
						</div>
					</div>
					<span class="clearfix"></span>

					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Mobile Number</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{ $phone_code }}{{ $arr_customer['mobile_number'] or 'NA' }}
						</div>
					</div>
					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Address</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_customer['address'] or 'NA'}}
						</div>
					</div>

				</div>

			</div>

		</div>
	</div>
	
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Products Details</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li>
						<a href="{{ $module_view_path }}/view/{{ $enc_id }}" class="btn btn-default btn-rounded show-tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
					</li>
				</ul>
			</div>
		</div>
		<hr class="horizotal-line">
		<form name="frm_manage" id="frm_manage" method="POST" class="form-horizontal" action="{{url($module_url_path)}}/multi_action">
			{{ csrf_field() }}
			<input type="hidden" name="multi_action" value="" />
			<div class="table-responsive">
				<table class="table dataTable no-footer" id="table_module">
					<thead>
						<tr class="border-solid">
							<th>
								<div class="dataTables_filter">
									Product
									<input type="text" name="q_product_name" placeholder="Search" class="search-block-new-table column_filter" />
								</div>
							</th>
							<th>
								<div class="dataTables_filter">
									Category
									<input type="text" name="q_category" placeholder="Search" class="search-block-new-table column_filter" />
								</div>
							</th>
							<th>
								<div class="dataTables_filter">
									Sub-Category
									<input type="text" name="q_subcategory" placeholder="Search" class="search-block-new-table column_filter" />
								</div>
							</th>
							<th>
								<div class="dataTables_filter">
									Quantity
								</div>
							</th>
							<th>
								<div class="dataTables_filter">
									Date
								</div>
							</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</form>
	</div>	

	<div class="form-group text-left">
		<a href="javascript:history.back(1)" class="btn btn-primary">Back</a>
	</div>

	<script>

		$(document).ready(function(){
			$('#frm_commission').validate({
				ignore: [],
				highlight: function(element) { }
			});


			table_module = $('#table_module').DataTable({
				processing: true, 
				serverSide: true, 
				"autoWidth": false,
				bFilter: false,
				'columnDefs': [{
					'targets': 0,
					'searchable': false,
					'orderable': false,
					'className': 'dt-body-center',}],
					ajax: {
						'url':'{{ $module_url_path}}/load_details/{{ $id }}',
						'data': function(d)
						{
							d['column_filter[q_product_name]'] = $("input[name='q_product_name']").val(),
							d['column_filter[q_category]']     = $("input[name='q_category']").val(),
							d['column_filter[q_subcategory]']  = $("input[name='q_subcategory']").val()
						}
					},

					columns: [
					{data : 'product_name',     "orderable":false, "searchable":true, name:'product_name'},
					{data : 'category_name',    "orderable":false, "searchable":true, name:'category_name'},
					{data : 'subcategory_name', "orderable":false, "searchable":true, name:'subcategory_name'},
					{data : 'quantity',         "orderable":false, "searchable":true, name:'quantity'},
					{data : 'created_at',       "orderable":true,  "searchable":true, name:'created_at'}
					],

					"order": [[ 3, "desc" ]]

				});
		});

		$('input.column_filter').on( 'keyup', function () 
		{
			filterData();
		});

		$('select.column_filter').on( 'keyup', function () 
		{
			filterData();
		});

		function filterData()
		{
			table_module.draw();
		}

	</script>

	@endsection


