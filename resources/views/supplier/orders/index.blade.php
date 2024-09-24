
@extends('supplier.layout.master')    
@section('main_content')

<!-- Page header -->
@include('supplier.layout.breadcrumb')  
<!-- /page header -->

<!-- BEGIN Main Content -->

<!-- Content area -->
<div class="content">

		@include('supplier.layout._operation_status')
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title">{{$module_title or ''}}</h5>
					<div class="heading-elements">
						<ul class="icons-list">
							
							{{-- <li>
								<a href="{{$module_url_path.'/create'}}" class="btn btn-default btn-rounded show-tooltip" title="Add New"><i class="fa fa-plus"></i></a>
							</li>

							<li>
								<a href="javascript:void(0)" class="btn btn-default btn-rounded show-tooltip" title="Block Multiple" onclick="check_multi_action('frm_manage','deactivate')"><i class="fa fa-lock"></i></a>
							</li>
							<li>
								<a href="javascript:void(0)" class="btn btn-default btn-rounded show-tooltip" title="Unblock Multiple" onclick="check_multi_action('frm_manage','activate')"><i class="fa fa-unlock"></i></a>
							</li>
							<li>
								<a href="javascript:void(0)" class="btn btn-default btn-rounded show-tooltip" title="Delete Multiple" onclick="check_multi_action('frm_manage','delete')"><i class="fa fa-trash"></i></a>
							</li> --}}
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
									{{-- <th width="5%">
										<div class="check-box">
											<input type="checkbox" class="filled-in" name="selectall" id="select_all" onchange="chk_all(this)" />
											<label for="selectall"></label>
										</div>
									</th> --}}
									<th width="13%">
										<div class="dataTables_filter">
											Order ID
										</div>
									</th>
									<th width="13%">
										<div class="dataTables_filter">
											Customer Name
										</div>
									</th>
									{{-- <th width="13%">
										<div class="dataTables_filter">
											Supplier Name
										</div>
									</th> --}}
									
									<th width="13%">
										<div class="dataTables_filter">
											Payment Method
										</div>
									</th>
									<th>
										<div class="dataTables_filter">
											Total(In Rs)
										</div>
									</th>
									<th>
										<div class="dataTables_filter">
											Order Status
										</div>
									</th>
									<th>
										<div class="dataTables_filter">
											Date
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
								d['column_filter[q_occasion_name]']   = $("input[name='q_occasion_name']").val()
							}
						},

						columns: [
						/*{
							render : function(data, type, row, meta) 
							{
								return '<div class="check-box"><input type="checkbox" class="filled-in case" name="checked_record[]"  d="mult_change_'+row.id+'" value="'+row.id+'" /><label for="mult_change_'+row.id+'"></label></div>';


							},"orderable": false, "searchable":false           
						},*/
						{data : 'order_id',"orderable":false,"searchable":true,name:'order_id'},
						{data : 'order_by_name',"orderable":false,"searchable":false,name:'order_by_name'},
						/*{data : 'supplier_name',"orderable":false,"searchable":false,name:'supplier_name'},*/
						{data : 'payment_method',"orderable":false,"searchable":false,name:'payment_method'},
						{data : 'total',"orderable":false,"searchable":false,name:'total'},
						
						{
							render : function(data, type, row, meta) 
							{
								return row.build_status_check;
							},
							"orderable": true, "searchable":false
						},
						{data : 'created_at',"orderable":true,"searchable":true,name:'created_at'},
						{
							render : function(data, type, row, meta) 
							{
								return row.built_action_button;
							},
							"orderable": false, "searchable":false

						}
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
				tbl_faq.draw();
			}

		</script>
		@endsection


