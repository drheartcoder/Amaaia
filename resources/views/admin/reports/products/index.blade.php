
@extends('admin.layout.master')    
@section('main_content')
@php
$label_sales = '[';
$data_sales = '[';

if(isset($arr_products_sales) && is_array($arr_products_sales) && sizeof($arr_products_sales)>0)
{
	foreach($arr_products_sales as $key => $sales)
	{
		// array_push($label_sales, $sales['product_name']);
		if($key == 0){
			$label_sales .= "'".$sales['product_name']."'";
			$data_sales .= "'".$sales['occurrences']."'";
		}
		else
		{
			$data_sales .= ",'".$sales['occurrences']."'";
			$label_sales .= ",'".$sales['product_name']."'";
		}
	}
}

$label_sales .= ']';
$data_sales .= ']';


$label_subcat = '[';
$data_subcat = '[';

if(isset($arr_products_subcategory) && is_array($arr_products_subcategory) && sizeof($arr_products_subcategory)>0)
{
	foreach($arr_products_subcategory as $key => $subcategory)
	{
		// array_push($label_subcat, $subcat['product_name']);
		if($key == 0){
			$label_subcat .= "'".$subcategory['product_category_name'].'-'.$subcategory['product_subcategory_name']."'";
			$data_subcat .= "'".$subcategory['occurrences']."'";
		}
		else
		{
			$data_subcat .= ",'".$subcategory['occurrences']."'";
			$label_subcat .= ",'".$subcategory['product_category_name'].'-'.$subcategory['product_subcategory_name']."'";
		}
	}
}

$label_subcat .= ']';
$data_subcat .= ']';
// dd($label_sales);
@endphp
<!-- Page header -->
@include('admin.layout.breadcrumb')  

<div class="content">
	<div class="panel panel-flat">
		@include('admin.layout._operation_status')
		<div class="row">
			
			<div class="col-sm-6">
				<canvas id="by_sale" width="1154" height="1000" class="chartjs-render-monitor"></canvas>
			</div>

			<div class="col-sm-6">
				<canvas id="by_category" width="1154" height="1000" class="chartjs-render-monitor"></canvas>
			</div>

		</div>
	</div>
</div>
<script type="text/javascript" src="{{url('/')}}/web_admin/assets/js/pages/Chart.bundle.js"></script>
<script type="text/javascript" src="{{url('/')}}/web_admin/assets/js/pages/utils.js"></script>
<script>
	var config1 = {
		type: 'line',
		responsive: true,
		data: {
			labels: <?php echo $label_sales?>,
			datasets: [{
				label: 'Products',
				fill: false,
				backgroundColor: window.chartColors.blue,
				borderColor: window.chartColors.blue,
				data: 
				<?php echo $data_sales ?>,
			}, ]
		},
		options: {
			responsive: true,
			title: {
				display: true,
				text: 'Product By Sales'
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
						labelString: 'Products'
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

	

	var config2 = {
		type: 'line',
		responsive: true,
		data: {
			labels: <?php echo $label_subcat?>,
			datasets: [{
				label: 'Categories-Subcategories',
				fill: false,
				backgroundColor: window.chartColors.blue,
				borderColor: window.chartColors.blue,
				data: 
				<?php echo $data_subcat ?>,
			}, ]
		},
		options: {
			responsive: true,
			title: {
				display: true,
				text: 'Product By Categories-Subcategories'
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
						labelString: 'Categories-Subcategories'
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
		var ctx2      = document.getElementById('by_category').getContext('2d');
		window.myLine = new Chart(ctx2, config2);
		var ctx1      = document.getElementById('by_sale').getContext('2d');
		window.myLine = new Chart(ctx1, config1);
	};

</script>
@endsection


