
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
							@if(isset($user_type) && $user_type != 'supplier')
								<li>
									<a href="{{$module_url_path.'/jewellery/create'}}" class="btn btn-default btn-rounded show-tooltip" title="Add New"><i class="fa fa-plus"></i></a>
								</li>
							@endif
							
							<li>
								<a href="javascript:void(0)" class="btn btn-default btn-rounded show-tooltip" title="Block Multiple" onclick="check_multi_action('frm_manage','deactivate')"><i class="fa fa-lock"></i></a>
							</li>
							<li>
								<a href="javascript:void(0)" class="btn btn-default btn-rounded show-tooltip" title="Unblock Multiple" onclick="check_multi_action('frm_manage','activate')"><i class="fa fa-unlock"></i></a>
							</li>
							<li>
								<a href="" class="btn btn-default btn-rounded show-tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
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
									<th width="1%">
										<div class="check-box">
											<input type="checkbox" class="filled-in" name="selectall" id="select_all" onchange="chk_all(this)" />
											<label for="selectall"></label>
										</div>
									</th>
									<th width="20%">
										<div class="dataTables_filter">
											Product Name
											<input type="text" name="q_product_name" placeholder="Search" class="search-block-new-table column_filter" />
										</div>
									</th>

									
									
									<th width=20%">
										<div class="dataTables_filter">
											Category
											<input type="text" name="q_category" placeholder="Search" class="search-block-new-table column_filter" />
										</div>
									</th>
									<th width="13%">
										<div class="dataTables_filter">
											Sub Category
										</div>
									</th>
									{{-- <th width="20%">
										<div class="dataTables_filter">
											Supplier Name
											<input type="text" name="q_supplier_name" placeholder="Search" class="search-block-new-table column_filter" />
										</div>
									</th> --}}
									<th width="13%">
										<div class="dataTables_filter">
											Type
										</div>
									</th>

									<th width="13%">
										<div class="dataTables_filter">
											Added On
										</div>
									</th>
									<th>Status</th>
									<th width="15%">Actions</th>
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
							'url':'{{ $module_url_path}}/load',
							'data': function(d)
							{
								d['column_filter[q_product_name]']   = $("input[name='q_product_name']").val();
								d['column_filter[q_category]']       = $("input[name='q_category']").val();
								d['column_filter[q_supplier_name]']  = $("input[name='q_supplier_name']").val();
								d['column_filter[user_type]']        = '{{$user_type or ''}}';
							}
						},

						columns: [
						{
							render : function(data, type, row, meta) 
							{
								return '<div class="check-box"><input type="checkbox" class="filled-in case" name="checked_record[]"  d="mult_change_'+row.id+'" value="'+row.id+'" /><label for="mult_change_'+row.id+'"></label></div>';


							},"orderable": false, "searchable":false           
						},
						{data : 'product_name',"orderable":false,"searchable":true,name:'product_name'},
						{data : 'category',"orderable":false,"searchable":true,name:'category'},
						{data : 'sub_category',"orderable":false,"searchable":true,name:'sub_category'},
						// {data : 'supplier_name',"orderable":false,"searchable":true,name:'supplier_name'},
						{data : 'product_type',"orderable":true,"searchable":true,name:'product_type'},
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
				table_module.draw();
			}
function approve(id)
{
swal({
          title: "Are you sure ?",
          text: 'Do you want to approve product?',
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: true
        },
        function(isConfirm)
        {
          if(isConfirm==true)
          {
            
             window.location = "{{$module_url_path.'/supplier/approve/'}}"+id;
          }
        });
}
function reject(id)
{
swal({
          title: "Are you sure ?",
          text: 'Do you want to reject product?',
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: true
        },
        function(isConfirm)
        {
          if(isConfirm==true)
          {
            
             window.location = "{{$module_url_path.'/supplier/reject/'}}"+id;
          }
        });
}
		</script>
		@endsection