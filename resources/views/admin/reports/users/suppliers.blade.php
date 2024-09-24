
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
						<a href="{{$module_url_path}}/suppliers" class="btn btn-default btn-rounded show-tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
					</li>
				</ul>
			</div>
		</div>
		<hr class="horizotal-line">

		<br/>
			
			<form id="export_form" action="{{$module_url_path}}/suppliers/export" method="post" >
			{{csrf_field()}}
            <div class="btn-group">
              <div class="col-sm-4">
                <input type="text" name="start_date" class="form-control" data-rule-maxlength="255"  placeholder="Start Date" id="start_date" readonly="readonly" style="cursor: pointer;">
                <div class="error" id="err_start_date"></div>
              </div>

              <div class="col-sm-4">
                <input type="text" name="end_date" class="form-control end_date" data-rule-maxlength="255"  placeholder="End Date" id="end_date" readonly="readonly" style="cursor: pointer;">
                <div class="error" id="err_end_date"></div>
              </div>

              <div class="col-sm-4">
                <input type="button" id="btn_apply_filter" value="Result" class="btn btn-primary btn_submit">
                <input type="reset" name="btn_clear" id="btn_clear" value="Reset" class="btn btn_clear btn-primary"/>
              </div>
            </div>

            <div class="btn-group">
            	<div class="col-sm-12">
                	<input type="button" id="btn_export_csv" value="Export CSV" class="btn btn-primary">
              	</div>
            </div>
            </form>


		<form name="frm_manage" id="frm_manage" method="POST" class="form-horizontal" action="{{url($module_url_path)}}/multi_action">
			{{ csrf_field() }}
			<input type="hidden" name="multi_action" value="" />
			<div class="table-responsive">
				<table class="table dataTable no-footer" id="table_module">
					<thead>
						<tr class="border-solid">
							<th width="25%">
								<div class="dataTables_filter">
									First Name
									<input type="text" name="q_first_name" placeholder="Search" class="search-block-new-table column_filter" />
								</div>
							</th>
							<th width="25%">
								<div class="dataTables_filter">
									Last Name
									<input type="text" name="q_last_name" placeholder="Search" class="search-block-new-table column_filter" />
								</div>
							</th>

							<th width="25%">
								<div class="dataTables_filter">
									Email
									<!-- <input type="text" name="q_email" placeholder="Search" class="search-block-new-table column_filter" /> -->
								</div>
							</th>
							
							<th width="25%">
								<div class="dataTables_filter">
									Registration Date
								</div>
							</th>
							<!-- <th>Status</th>
							<th>Actions</th> -->
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</form>

	</div>

	<script src="{{url('/')}}/web_admin/assets/js/plugins/pickers/bootstrap_datepicker.js"></script>
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
						'url':'{{ $module_url_path}}/suppliers/load',
						'data': function(d)
						{
							d['column_filter[q_first_name]']   = $("input[name='q_first_name']").val();
							d['column_filter[q_last_name]']    = $("input[name='q_last_name']").val();
							d['column_filter[q_email]']    	   = $("input[name='q_email']").val();

							d['column_filter[start_date]']     = $("input[name='start_date']").val();
                            d['column_filter[end_date]']       = $("input[name='end_date']").val();
						}
					},

					columns: [
						{data : 'first_name',"orderable":false,"searchable":true,name:'first_name'},
						{data : 'last_name',"orderable":false,"searchable":true,name:'last_name'},
						{data : 'email',"orderable":false,"searchable":true,name:'email'},
						{data : 'created_at',"orderable":true,"searchable":true,name:'created_at'}
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

		$('.btn_submit').click( 'keyup', function () 
		{
			filterData();
		});

		$('.btn_clear').click( 'keyup', function () 
		{
			$('#start_date').val('');
			$('#end_date').val('');

			$('#end_date').datepicker('remove');

			filterData();
		});
		function filterData()
		{
			table_module.draw();
		}
      	
      	$('#start_date').datepicker({todayHighlight: true, autoclose: true});
      	
      	$('#start_date').change(function(){
      		$('#end_date').val('');
      		$('#end_date').datepicker('remove');

      		var start_date = new Date($('#start_date').val());
			start_date.setDate(start_date.getDate() + 1);


      		$('#end_date').datepicker({
      			autoclose: true,
      			todayHighlight: true,
      			startDate: start_date
      		});
      		
      	});

      	$('#end_date').change(function(){
      		var start_date = $('#start_date').val();
      		var end_date = $('#end_date').val();

      		if(start_date > end_date)
      		{
      			$("#err_end_date").html("End date can't be smaller than Start date");
      			$("#err_end_date").focus();
      			$("#err_end_date").fadeOut(8000);
      			$('#end_date').val("");
      		}
      	});

      	$("#btn_export_csv").click(function(){
      		var start_date = $('#start_date').val();
      		var end_date = $('#end_date').val();

      		if(start_date > end_date)
      		{
      			$("#err_end_date").html("End date can't be smaller than Start date");
      			$("#err_end_date").focus();
      			$("#err_end_date").fadeOut(8000);
      			$('#end_date').val("");
      		}
      		else
      		{

	      		if(start_date == '' && end_date == '')
	      		{
	      			swal({
						title: "Are you sure ?",
						text: 'Do you want to export all records?',
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Yes",
						cancelButtonText: "No",
						closeOnConfirm: true,
						closeOnCancel: true
			        },
			        function(isConfirm)
			        {
						if(isConfirm)
						{
				            $('#export_start_date').val(start_date);
				            $('#export_end_date').val(end_date);
				            $('#export_form').submit();
			        	}
			        });
	      		}
	      		else
	      		{
	      			$('#export_form').submit();
	      		}
	      	}
      	});
	</script>
	@endsection

