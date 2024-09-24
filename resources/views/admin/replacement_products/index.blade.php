
@extends('admin.layout.master')    
@section('main_content')

<!-- Page header -->
@include('admin.layout.breadcrumb')  
<!-- /page header -->

<!-- BEGIN Main Content -->

<!-- Content area -->
<div class="content">

		@include('admin.layout._operation_status')
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title">{{$module_title or ''}}</h5>
					<div class="heading-elements">
						<ul class="icons-list">
							<li>
								<a href="{{$module_url_path}}" class="btn btn-default btn-rounded show-tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
							</li>
						</ul>
					</div>
				</div>
				<hr class="horizotal-line">
				<form name="frm_manage" id="frm_manage" method="POST" class="form-horizontal" action="{{url($module_url_path)}}/multi_action">
					{{ csrf_field() }}
					<input type="hidden" name="multi_action" value="" />
					<div class="table-responsive">
						<table class="table dataTable no-footer" id="tbl_faq">
							<thead>
								<tr class="border-solid">
									<th width="13%">
										<div class="dataTables_filter">
											Order ID
											<input type="text" name="q_order_id" placeholder="Search" class="search-block-new-table column_filter" />
										</div>
									</th>
									<th width="13%">
										<div class="dataTables_filter">
											Product
											<input type="text" name="q_product_name" placeholder="Search" class="search-block-new-table column_filter" />
										</div>
									</th>
									<th width="13%">
										<div class="dataTables_filter">
											Customer Name
										</div>
									</th>
									
									<th width="13%">
										<div class="dataTables_filter">
											Reason
										</div>
									</th>
									<th>
										<div class="dataTables_filter">
											Price(In Rs.)
										</div>
									</th>
									<th>
										<div class="dataTables_filter">
											Date
										</div>
									</th>
									<th>
										<div class="dataTables_filter">
											Status
										</div>
									</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
				</form>
			</div>
			
		<script type="text/javascript">
			$(document).ready(function(){
				tbl_faq = $('#tbl_faq').DataTable({
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
							'url':'{{ $module_url_path}}/load',
							'data': function(d)
							{
								d['column_filter[q_product_name]']   = $("input[name='q_product_name']").val(),
								d['column_filter[q_order_id]']   = $("input[name='q_order_id']").val()
							}
						},

						columns: [
						
						{data : 'order_id',"orderable":false,"searchable":true,name:'order_id'},
						{data : 'product_name',"orderable":false,"searchable":false,name:'product_name'},
						{data : 'customer_name',"orderable":false,"searchable":false,name:'customer_name'},
						{data : 'reason',"orderable":false,"searchable":false,name:'reason'},
						{data : 'product_final_price',"orderable":false,"searchable":false,name:'product_final_price'},
						{data : 'created_at',"orderable":true,"searchable":true,name:'created_at'},
						{
							render : function(data, type, row, meta) 
							{
								return row.build_status_check;
							},
							"orderable": false, "searchable":false
						},
						{
							render : function(data, type, row, meta) 
							{
								return row.built_action_button;
							},
							"orderable": false, "searchable":false
						}
						],

						"order": [[ 5, "desc" ]]

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
				tbl_faq.draw();
			}

		</script>
		@endsection


