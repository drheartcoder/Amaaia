
@extends('admin.layout.master')    
@section('main_content')
<!-- Page header -->
@include('admin.layout.breadcrumb')  
<!-- /page header -->

<!-- BEGIN Main Content -->

<!-- Content area -->
<div class="content">

	@include('admin.layout._operation_status')

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-white">
				<div class="panel-heading">
					<h6 class="panel-title"><i class="icon-cog3 position-left"></i> Gift Card Details</h6>
				</div>

				<div class="panel-body">
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Card Image</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							<div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
								@if(isset($arr_gift_cards['image']) && !empty($arr_gift_cards['image']) && File::exists($gift_card_image_base_path.$arr_gift_cards['image']))
								<img src="{{$gift_card_image_public_path.$arr_gift_cards['image']}}"  style="max-width: 100%;max-height: 100%; line-height: 20px;" class="fileupload-preview">
								@else
								<img src="{{url('/').'/uploads/supplier/default_image/default-profile.png' }}"  style="max-width: 100%; max-height: 100%; line-height: 20px;" class="fileupload-preview">
								@endif
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Title</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_gift_cards['title'] or 'NA'}}
						</div>
					</div>
					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Amount (In RS)</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_gift_cards['amount'] or 'NA'}}
						</div>
					</div>

					<span class="clearfix"></span>
					<div class="form-group">
						<label class="control-label col-lg-4 col-md-4 col-md-4 col-xs-4">Description</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							{{$arr_gift_cards['description'] or 'NA'}}
						</div>
					</div>
					<span class="clearfix"></span>

				</div>

			</div>

		</div>
	</div>
	
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Used By</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li>
						<a href="{{ $module_view_path }}" class="btn btn-default btn-rounded show-tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
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
									Send From
									<input type="text" name="q_user_name" placeholder="Search" class="search-block-new-table column_filter" />
								</div>
							</th>
							<th>
								<div class="dataTables_filter">
									Received by
									<input type="text" name="q_email" placeholder="Search" class="search-block-new-table column_filter" />
								</div>
							</th>
							<th>
								<div class="dataTables_filter">
									Amount
								</div>
							</th>
							<th>
								<div class="dataTables_filter">
									Send on
								</div>
							</th>
							<th>
								<div class="dataTables_filter">
									Status
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
						'url':'{{ $module_url_path}}/load_card/{{ $id }}',
						'data': function(d)
						{
							d['column_filter[q_user_name]'] = $("input[name='q_user_name']").val(),
							d['column_filter[q_email]']     = $("input[name='q_email']").val()
						}
					},

					columns: [
					{data : 'send_by',     "orderable":false, "searchable":true, name:'send_by'},
					{data : 'received_by', "orderable":false, "searchable":true, name:'received_by'},
					{data : 'amount',      "orderable":true,  "searchable":true, name:'amount'},
					{data : 'created_at',  "orderable":true,  "searchable":true, name:'created_at'},
					{
						render : function(data, type, row, meta) 
						{
							return row.build_status_check;
						},
						"orderable": true, "searchable":false
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
			table_module.draw();
		}

	</script>

	@endsection


