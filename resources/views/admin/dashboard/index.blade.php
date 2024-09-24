
@extends('admin.layout.master')    
@section('main_content')
<!-- Page header -->
@include('admin.layout.breadcrumb')  
<style type="text/css">
	.temp_text
	{
		text-align: center;
		font-size: 75px!important;
		padding-top: 150px!important;
		color: #b4a3a2;
	}
</style>

<!-- /page header -->
<!-- BEGIN Main Content -->

<!-- Content area -->
<div class="content">


	<!-- Dashboard content -->
	<div class="row">
		<div class="col-lg-12">

			<!-- Quick stats boxes -->
			<div class="row">

				<div class="col-lg-3">

					<a href="{{ url('/admin/products') }}">
						<div class="panel bg-blue-600">
							<div class="panel-body">
								<div class="heading-elements">
									<span class="badge bg-teal-800"></span>
								</div>

								<h2 class="no-margin">{{ isset($products_count) ? $products_count : '0' }}</h2>
								<h1 class="no-margin">Own Products</h1>
							</div>

							<div class="container-fluid">
								<div id="members-online"></div>
							</div>
						</div>
					</a>

				</div>

				<div class="col-lg-3">

					<a href="{{ url('/admin/orders/new') }}">
						<div class="panel bg-pink-600">
							<div class="panel-body">
								<div class="heading-elements">
									<span class="badge bg-teal-800"></span>
								</div>

								<h2 class="no-margin">{{ isset($orders_count) ? $orders_count : '0' }}</h2>
								<h1 class="no-margin">New Orders</h1>
							</div>

							<div class="container-fluid">
								<div id="members-online"></div>
							</div>
						</div>
					</a>

				</div>

				<div class="col-lg-3">

					<a href="{{ url('/admin/user/customers') }}">
						<div class="panel bg-indigo-600">
							<div class="panel-body">
								<div class="heading-elements">
									<span class="badge bg-teal-800"></span>
								</div>

								<h2 class="no-margin">{{ isset($user_count) ? $user_count : '0' }}</h2>
								<h1 class="no-margin">Total Users</h1>
							</div>

							<div class="container-fluid">
								<div id="members-online"></div>
							</div>
						</div>
					</a>

				</div>

				<div class="col-lg-3">

					<a href="{{ url('/admin/user/suppliers') }}">
						<div class="panel bg-violet-600">
							<div class="panel-body">
								<div class="heading-elements">
									<span class="badge bg-teal-800"></span>
								</div>

								<h2 class="no-margin">{{ isset($supplier_count) ? $supplier_count : '0' }}</h2>
								<h1 class="no-margin">Total Suppliers</h1>
							</div>

							<div class="container-fluid">
								<div id="members-online"></div>
							</div>
						</div>
					</a>

				</div>

				<div class="col-lg-3">

					<a href="{{ url('/admin/return_product') }}">
						<div class="panel bg-purple-600">
							<div class="panel-body">
								<div class="heading-elements">
									<span class="badge bg-teal-800"></span>
								</div>

								<h2 class="no-margin">{{ isset($return_count) ? $return_count : '0' }}</h2>
								<h1 class="no-margin">Return Request</h1>
							</div>

							<div class="container-fluid">
								<div id="members-online"></div>
							</div>
						</div>
					</a>

				</div>

				<div class="col-lg-3">

					<a href="{{ url('/admin/replacement_products') }}">
						<div class="panel bg-brown-600">
							<div class="panel-body">
								<div class="heading-elements">
									<span class="badge bg-teal-800"></span>
								</div>

								<h2 class="no-margin">{{ isset($replacement_count) ? $replacement_count : '0' }}</h2>
								<h1 class="no-margin">Replacement Request</h1>
							</div>

							<div class="container-fluid">
								<div id="members-online"></div>
							</div>
						</div>
					</a>

				</div>

				<div class="col-lg-3">

					<a href="{{ url('/admin/valuation') }}">
						<div class="panel bg-green-600">
							<div class="panel-body">
								<div class="heading-elements">
									<span class="badge bg-teal-800"></span>
								</div>

								<h2 class="no-margin">{{ isset($valuation_count) ? $valuation_count : '0' }}</h2>
								<h1 class="no-margin">Valuation Request</h1>
							</div>

							<div class="container-fluid">
								<div id="members-online"></div>
							</div>
						</div>
					</a>

				</div>

				<div class="col-lg-3">

					<a href="{{ url('/admin/notifications') }}">
						<div class="panel bg-orange-600">
							<div class="panel-body">
								<div class="heading-elements">
									<span class="badge bg-teal-800"></span>
								</div>

								<h2 class="no-margin">{{ isset($notification_count) ? $notification_count : '0' }}</h2>
								<h1 class="no-margin">New Notification</h1>
							</div>

							<div class="container-fluid">
								<div id="members-online"></div>
							</div>
						</div>
					</a>

				</div>
				<div class="col-sm-12" style="border:1px solid">

					<div class="col-sm-6">
						<canvas id="order_counts" width="1154" height="800" class="chartjs-render-monitor"></canvas>
					</div>

					<div class="col-sm-6">
						<canvas id="user_counts" width="1154" height="800" class="chartjs-render-monitor"></canvas>
					</div>
				</div>

			</div>
			<!-- /quick stats boxes -->

		</div>

	</div>
	<!-- /dashboard content -->


</div>


<script type="text/javascript" src="{{url('/')}}/web_admin/assets/js/pages/Chart.bundle.js"></script>
<script type="text/javascript" src="{{url('/')}}/web_admin/assets/js/pages/utils.js"></script>

@php
$label_order = '[';
$data_order = '[';

if(isset($order_data) && is_array($order_data) && sizeof($order_data)>0)
{
	foreach($order_data as $key => $order)
	{
		// array_push($label_order, $order['product_name']);
		if($key == 0){
			$label_order .= "'".$order['month_name']."'";
			$data_order .= "'".$order['count']."'";
		}
		else
		{
			$data_order .= ",'".$order['count']."'";
			$label_order .= ",'".$order['month_name']."'";
		}
	}
}

$label_order .= ']';
$data_order .= ']';

@endphp

@php
$label_user = '[';
$data_user = '[';

if(isset($user_data) && is_array($user_data) && sizeof($user_data)>0)
{
	foreach($user_data as $key => $user)
	{
		// array_push($label_user, $user['product_name']);
		if($key == 0){
			$label_user .= "'".$user['month_name']."'";
			$data_user .= "'".$user['count']."'";
		}
		else
		{
			$data_user .= ",'".$user['count']."'";
			$label_user .= ",'".$user['month_name']."'";
		}
	}
}

$label_user .= ']';
$data_user .= ']';



@endphp
<script type="text/javascript">
</script>
<script>
	var config1 = {
		type: 'line',
		responsive: true,
		data: {
			labels: <?php echo $label_order?>,
			datasets: [{
				label: 'Order Per Month',
				fill: false,
				backgroundColor: window.chartColors.blue,
				borderColor: window.chartColors.blue,
				data: 
				<?php echo $data_order ?>,
			}, ]
		},
		options: {
			responsive: true,
			title: {
				display: true,
				text: 'Orders By Month'
			},
			tooltips: {
				mode: 'index',
				intersect: false,
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			scales: {
				xAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Month Name'
					},
					ticks: {
						stepSize: 1,
						min: 0,
						autoSkip: false
					}
				}],
				yAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Order Counts'
					},
					ticks: {
						stepSize: 1,
						min: 0,
						autoSkip: false
					}
				}]
			}
		}
	};

	window.onload = function() {
		var ctx1      = document.getElementById('order_counts').getContext('2d');
		window.myLine = new Chart(ctx1, config1);

		var ctx2      = document.getElementById('user_counts').getContext('2d');
		var myChart = new Chart(ctx2, {
			type: 'pie',
			data: {
				labels: <?php echo $label_user ?>,
				datasets: [{

					label: 'Users Per Month',
					data: <?php echo $data_user; ?>,
					backgroundColor: [
					'#8D98B3',
					'#E5CF0D',
					'#97B552',
					'#95706D',
					'#DC69AA',
					'#DC69AA',
					'#AE98DA',
					'#2EC7C1',
					'#5AB1E4',
					'#FFC799'
					],
					borderWidth: 1
        }]
    },options: {
    	responsive: true,
    	title: {
    		display: true,
    		text: 'Users Per Month'
    	},
    	tooltips: {
    		mode: 'index',
    		intersect: false,
    	},
    	hover: {
    		mode: 'nearest',
    		intersect: true
    	}
    }
});
	};
</script>
@endsection


