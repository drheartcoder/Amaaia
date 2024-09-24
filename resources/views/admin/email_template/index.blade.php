
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
					<table class="table dataTable no-footer" id="table_module">
						<thead>
							<tr class="border-solid">
								<th width="5%">
									<div class="check-box">
										<input type="checkbox" class="filled-in" name="selectall" id="select_all" onchange="chk_all(this)" />
										<label for="selectall"></label>
									</div>
								</th>
								<th width="28%">
									<div class="dataTables_filter">
										Name
										<input type="text" name="q_template_name" placeholder="Search" class="search-block-new-table column_filter" />
									</div>
								</th>
								<th width="28%">
									<div class="dataTables_filter">
										Subject
									</div>
								</th>
								<th width="28%">
									<div class="dataTables_filter">
										From
									</div>
								</th>
								<th width="28%">
									<div class="dataTables_filter">
										From Email
									</div>
								</th>
								<th width="28%">
									<div class="dataTables_filter">
										Added On
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
							d['column_filter[q_template_name]']   = $("input[name='q_template_name']").val()
						}
					},

					columns: [
					{
						render : function(data, type, row, meta) 
						{
							return '<div class="check-box"><input type="checkbox" class="filled-in case" name="checked_record[]"  d="mult_change_'+row.id+'" value="'+row.id+'" /><label for="mult_change_'+row.id+'"></label></div>';


						},"orderable": false, "searchable":false           
					},
					{data : 'template_name',"orderable":false,"searchable":true,name:'template_name'},
					{data : 'template_subject',"orderable":true,"searchable":true,name:'template_subject'},
					{data : 'template_from',"orderable":true,"searchable":true,name:'template_from'},
					{data : 'template_from_mail',"orderable":true,"searchable":true,name:'template_from_mail'},
					{data : 'created_at',"orderable":true,"searchable":true,name:'created_at'},
					{
						render : function(data, type, row, meta) 
						{
							return row.built_action_button;
						},
						"orderable": false, "searchable":false

					}
					],

					"order": [[ 2, "desc" ]]

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


